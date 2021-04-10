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
use PHPUnit\Framework\MockObject\MockObject;
use RuntimeException;
use stdClass;
use Throwable;

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
     * @throws Throwable
     */
    public function testSupports(): void
    {
        $entity = new stdClass();
        $provider = $this->createClientProviderMock();
        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('hasMapperForObject')->willReturnCallback(
                function ($toTest) use ($entity) {
                    return $toTest === $entity;
                }
        );

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->assertTrue($storage->supports($entity));
        $this->assertFalse($storage->supports($this));
    }

    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать тип сущности.
     *
     * @throws Throwable
     */
    public function testSupportsClass(): void
    {
        $key = $this->createFakeData()->word;
        $provider = $this->createClientProviderMock();
        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('hasMapperForKey')->willReturnCallback(
                function ($toTest) use ($key) {
                    return $toTest === $key;
                }
        );

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->assertTrue($storage->supportsClass($key));
        $this->assertFalse($storage->supportsClass($key . '_test'));
    }

    /**
     * Проверяет, что хранилище добавляет сущность.
     *
     * @throws Throwable
     */
    public function testInsert(): void
    {
        $entity = new ElasticStorageTestEntity();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageTestEntity();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'index' => [
                        '_index' => 'ElasticStorageTestEntity',
                        '_id' => $entity->getId(),
                    ],
                ],
                [
                    'id' => $entity->getId(),
                    'payload' => $entity->getPayload(),
                ],
                [
                    'index' => [
                        '_index' => 'ElasticStorageTestEntity',
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

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->insert($entity);
        $storage->insert($entity1);
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище добавляет сущность указанными партиями.
     *
     * @throws Throwable
     */
    public function testInsertByOne(): void
    {
        $entity = new ElasticStorageTestEntity();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageTestEntity();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $insertedItems = [];
        $client->method('bulk')->willReturnCallback(
            function ($request) use (&$insertedItems): void {
                $insertedItems[] = $request;
            }
        );

        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

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
                                '_index' => 'ElasticStorageTestEntity',
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
                                '_index' => 'ElasticStorageTestEntity',
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
     * @throws Throwable
     */
    public function testInsertToFrozenIndex(): void
    {
        $entity = new ElasticStorageTestEntity();
        $entity->setId($this->createFakeData()->word);
        $entity->setPayload($this->createFakeData()->word);

        $entity1 = new ElasticStorageTestEntity();
        $entity1->setId($this->createFakeData()->word);
        $entity1->setPayload($this->createFakeData()->word);

        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'index' => [
                        '_index' => 'ElasticStorageTestEntity',
                        '_id' => $entity->getId(),
                    ],
                ],
                [
                    'id' => $entity->getId(),
                    'payload' => $entity->getPayload(),
                ],
                [
                    'index' => [
                        '_index' => 'ElasticStorageTestEntity',
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

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->expects($this->once())->method('isFrozen')->willReturn(true);
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
     * @throws Throwable
     */
    public function testInsertException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->insert(new ElasticStorageTestEntity());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище удаляет сущность.
     *
     * @throws Throwable
     */
    public function testDelete(): void
    {
        $entity = new ElasticStorageTestEntity();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'delete' => [
                        '_index' => 'ElasticStorageTestEntity',
                        '_id' => $entity->getId(),
                    ],
                ],
            ],
        ]));
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->delete($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при удалении документа будет перехвачено.
     *
     * @throws Throwable
     */
    public function testDeleteException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->delete(new ElasticStorageTestEntity());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище обновляет сущность.
     *
     * @throws Throwable
     */
    public function testUpsert(): void
    {
        $entity = new ElasticStorageTestEntity();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                [
                    'index' => [
                        '_index' => 'ElasticStorageTestEntity',
                        '_id' => $entity->getId(),
                    ],
                ],
                [
                    'id' => 'ElasticStorageTestEntity_id',
                    'payload' => 'ElasticStorageTestEntity_payload',
                ],
            ],
        ]));

        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->upsert($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при обновлении документа будет перехвачено.
     *
     * @throws Throwable
     */
    public function testUpsertException(): void
    {
        $client = $this->createClientMock();
        $client->method('bulk')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->upsert(new ElasticStorageTestEntity());
        $storage->stop();
    }

    /**
     * Проверяет, что хранилище очищает все данные по типу сущности.
     *
     * @throws Throwable
     */
    public function testTruncate(): void
    {
        $client = $this->createClientMock();
        $client->expects($this->once())->method('deleteByQuery')->with(
            $this->equalTo(
                [
                    'index' => 'ElasticStorageTestEntity',
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

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);
        $storage->start();
        $storage->truncate('ElasticStorageTestEntity');
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при очистке хранилища будет перехвачено.
     *
     * @throws Throwable
     */
    public function testTruncateException(): void
    {
        $client = $this->createClientMock();
        $client->method('deleteByQuery')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->method('isFrozen')->willReturn(false);

        $storage = new ElasticStorage($provider, $registry, $builder);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->truncate(ElasticStorageTestEntity::class);
        $storage->stop();
    }

    /**
     * Создает мок для объекта, клоторый предоставляет клиента.
     *
     * @param Client|null $client
     *
     * @return MockObject
     */
    private function createClientProviderMock(?Client $client = null): MockObject
    {
        if ($client === null) {
            $client = $this->createClientMock();
        }

        $provider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $provider->method('provide')->willReturn($client);

        return $provider;
    }

    /**
     * Создает мок для объекта клиента.
     *
     * @return MockObject
     */
    private function createClientMock(): MockObject
    {
        return $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Создает мок для объекта с описаниями индексов.
     *
     * @return MockObject
     */
    private function createRegistryMock(): MockObject
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn(
            'ElasticStorageTestEntity'
        );
        $mapper->method('extractPrimaryFromEntity')->willReturnCallback(
                function ($entity) {
                    return method_exists($entity, 'getId')
                        ? $entity->getId()
                        : null;
                }
        );
        $mapper->method('extractDataFromEntity')->willReturnCallback(
                function ($entity) {
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

        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('getMapperForObject')->willReturnCallback(
                function ($toTest) use ($mapper) {
                    if (!($toTest instanceof ElasticStorageTestEntity)) {
                        throw new RuntimeException("Can't find mapper.");
                    }

                    return $mapper;
                }
        );
        $registry->method('getMapperForKey')->willReturnCallback(
                function ($toTest) use ($mapper) {
                    if ($toTest !== 'ElasticStorageTestEntity') {
                        throw new RuntimeException("Can't find mapper.");
                    }

                    return $mapper;
                }
        );

        return $registry;
    }
}

/**
 * Объект мока сущности для тестов.
 */
class ElasticStorageTestEntity
{
    /**
     * @var string
     */
    private $id = 'ElasticStorageTestEntity_id';

    /**
     * @var string
     */
    private $payload = 'ElasticStorageTestEntity_payload';

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }
}
