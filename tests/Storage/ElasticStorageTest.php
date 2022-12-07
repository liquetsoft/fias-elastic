<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Storage\ElasticStorage;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Liquetsoft\Fias\Elastic\Tests\Mock\ElasticStorageMock;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Тест для хранилища, которое записывает данные в elastic search.
 *
 * @internal
 */
class ElasticStorageTest extends BaseCase
{
    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать сущность.
     *
     * @throws \Throwable
     */
    public function testSupports(): void
    {
        $entity = new \stdClass();
        $provider = $this->createClientProviderMock();
        $registry = $this->createIndexMapperMock();
        $registry->method('hasMapperForObject')->willReturnCallback(
            function (object $toTest) use ($entity) {
                return $toTest === $entity;
            }
        );

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->assertTrue($storage->supports($entity));
        $this->assertFalse($storage->supports($this));
    }

    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать тип сущности.
     *
     * @throws \Throwable
     */
    public function testSupportsClass(): void
    {
        $key = $this->createFakeData()->word;
        $provider = $this->createClientProviderMock();
        $registry = $this->createIndexMapperMock();
        $registry->method('hasMapperForKey')->willReturnCallback(
            function (string $toTest) use ($key) {
                return $toTest === $key;
            }
        );

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->assertTrue($storage->supportsClass($key));
        $this->assertFalse($storage->supportsClass($key . '_test'));
    }

    /**
     * Проверяет, что хранилище добавляет сущность.
     *
     * @throws \Throwable
     */
    public function testInsert(): void
    {
        $entity = new ElasticStorageMock();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageMock();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'index' => [
                        '_index' => 'ElasticStorageMock',
                        '_id' => $entity->getId(),
                    ],
                ],
                [
                    'id' => $entity->getId(),
                    'payload' => $entity->getPayload(),
                ],
                [
                    'index' => [
                        '_index' => 'ElasticStorageMock',
                        '_id' => $entity1->getId(),
                    ],
                ],
                [
                    'id' => $entity1->getId(),
                    'payload' => $entity1->getPayload(),
                ],
            ],
        ]));
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->insert($entity);
        $storage->insert($entity1);
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище добавляет сущность указанными партиями.
     *
     * @throws \Throwable
     */
    public function testInsertByOne(): void
    {
        $entity = new ElasticStorageMock();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageMock();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $insertedItems = [];
        $client->method('bulk')->willReturnCallback(
            function (array $request) use (&$insertedItems): void {
                $insertedItems[] = $request;
            }
        );

        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder, 1);
        $storage->start();
        $storage->insert($entity);
        $storage->insert($entity1);
        $storage->stop();

        $this->assertSame(
            [
                [
                    'body' => [
                        [
                            'index' => [
                                '_index' => 'ElasticStorageMock',
                                '_id' => $entity->getId(),
                            ],
                        ],
                        [
                            'id' => $entity->getId(),
                            'payload' => $entity->getPayload(),
                        ],
                    ],
                ],
                [
                    'body' => [
                        [
                            'index' => [
                                '_index' => 'ElasticStorageMock',
                                '_id' => $entity1->getId(),
                            ],
                        ],
                        [
                            'id' => $entity1->getId(),
                            'payload' => $entity1->getPayload(),
                        ],
                    ],
                ],
            ],
            $insertedItems
        );
    }

    /**
     * Проверяет, что замороженные индексы будут разморожены при вставке.
     *
     * @throws \Throwable
     */
    public function testInsertToFrozenIndex(): void
    {
        $entity = new ElasticStorageMock();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageMock();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'index' => [
                        '_index' => 'ElasticStorageMock',
                        '_id' => $entity->getId(),
                    ],
                ],
                [
                    'id' => $entity->getId(),
                    'payload' => $entity->getPayload(),
                ],
                [
                    'index' => [
                        '_index' => 'ElasticStorageMock',
                        '_id' => $entity1->getId(),
                    ],
                ],
                [
                    'id' => $entity1->getId(),
                    'payload' => $entity1->getPayload(),
                ],
            ],
        ]));
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock(true);
        $builder->expects($this->once())->method('unfreeze');
        $builder->expects($this->once())->method('freeze');

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->insert($entity);
        $storage->insert($entity1);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при добавлении документа будет перехвачено.
     *
     * @throws \Throwable
     */
    public function testInsertException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new \RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->insert(new ElasticStorageMock());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище удаляет сущность.
     *
     * @throws \Throwable
     */
    public function testDelete(): void
    {
        $entity = new ElasticStorageMock();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'delete' => [
                        '_index' => 'ElasticStorageMock',
                        '_id' => $entity->getId(),
                    ],
                ],
            ],
        ]));
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->delete($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при удалении документа будет перехвачено.
     *
     * @throws \Throwable
     */
    public function testDeleteException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new \RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->delete(new ElasticStorageMock());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище обновляет сущность.
     *
     * @throws \Throwable
     */
    public function testUpsert(): void
    {
        $entity = new ElasticStorageMock();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with(
            $this->equalTo(
                [
                    'body' => [
                        [
                            'index' => [
                                '_index' => 'ElasticStorageMock',
                                '_id' => $entity->getId(),
                            ],
                        ],
                        [
                            'id' => 'ElasticStorageMock_id',
                            'payload' => 'ElasticStorageMock_payload',
                        ],
                    ],
                ]
            )
        );

        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->upsert($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при обновлении документа будет перехвачено.
     *
     * @throws \Throwable
     */
    public function testUpsertException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new \RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->upsert(new ElasticStorageMock());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище очищает все данные по типу сущности.
     *
     * @throws \Throwable
     */
    public function testTruncate(): void
    {
        $client = $this->createClientMock();
        $client->expects($this->once())->method('deleteByQuery')->with(
            $this->equalTo(
                [
                    'index' => 'ElasticStorageMock',
                    'ignore_unavailable' => true,
                    'body' => [
                        'query' => [
                            'match_all' => (object) [],
                        ],
                    ],
                ]
            )
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->truncate('ElasticStorageMock');
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при очистке хранилища будет перехвачено.
     *
     * @throws \Throwable
     */
    public function testTruncateException(): void
    {
        $client = $this->createClientMock();
        $client->method('deleteByQuery')->will(
            $this->throwException(new \RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->createIndexBuilderMock();

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->truncate(ElasticStorageMock::class);
        $storage->stop();
    }

    /**
     * Создает мок для объекта, клоторый предоставляет клиента.
     *
     * @param Client|null $client
     *
     * @return ClientProvider&MockObject
     */
    private function createClientProviderMock(?Client $client = null): ClientProvider
    {
        if ($client === null) {
            $client = $this->createClientMock();
        }

        /** @var ClientProvider&MockObject */
        $provider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $provider->method('provide')->willReturn($client);

        return $provider;
    }

    /**
     * Создает мок для маппера.
     *
     * @return IndexMapperRegistry&MockObject
     */
    private function createIndexMapperMock(): IndexMapperRegistry
    {
        /** @var IndexMapperRegistry&MockObject */
        $mock = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();

        return $mock;
    }

    /**
     * Создает мок для обработчика индексов.
     *
     * @return IndexBuilder&MockObject
     */
    private function createIndexBuilderMock(bool $isFrozen = false): IndexBuilder
    {
        /** @var IndexBuilder&MockObject */
        $mock = $this->getMockBuilder(IndexBuilder::class)->getMock();

        $mock->method('isFrozen')->willReturn($isFrozen);

        return $mock;
    }

    /**
     * Создает мок для объекта клиента.
     *
     * @return Client&MockObject
     */
    private function createClientMock(): Client
    {
        /** @var Client&MockObject */
        $mock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }

    /**
     * Создает мок для объекта с описаниями индексов.
     *
     * @return IndexMapperRegistry&MockObject
     */
    private function createRegistryMock(): IndexMapperRegistry
    {
        /** @var IndexMapperInterface&MockObject */
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn(
            'ElasticStorageMock'
        );
        $mapper->method('extractPrimaryFromEntity')->willReturnCallback(
            function (object $entity) {
                return method_exists($entity, 'getId')
                    ? $entity->getId()
                    : null;
            }
        );
        $mapper->method('extractDataFromEntity')->willReturnCallback(
            function (object $entity) {
                return [
                    'id' => method_exists($entity, 'getId')
                        ? $entity->getId()
                        : null,
                    'payload' => method_exists($entity, 'getPayload')
                        ? $entity->getPayload()
                        : null,
                ];
            }
        );

        /** @var IndexMapperRegistry&MockObject */
        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('getMapperForObject')->willReturnCallback(
            function (object $toTest) use ($mapper) {
                if (!($toTest instanceof ElasticStorageMock)) {
                    throw new \RuntimeException("Can't find mapper.");
                }

                return $mapper;
            }
        );
        $registry->method('getMapperForKey')->willReturnCallback(
            function (string $toTest) use ($mapper) {
                if ($toTest !== 'ElasticStorageMock') {
                    throw new \RuntimeException("Can't find mapper.");
                }

                return $mapper;
            }
        );

        return $registry;
    }
}
