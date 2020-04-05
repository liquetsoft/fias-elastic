<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Storage\ElasticStorage;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use RuntimeException;
use stdClass;
use Throwable;

/**
 * Тест для хранилища, которое записывает данные в elastic search.
 */
class ElasticStorageTest extends BaseCase
{
    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать сущность.
     *
     * @throws Throwable
     */
    public function testSupports()
    {
        $entity = new stdClass();
        $provider = $this->createClientProviderMock();
        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('hasMapperForObject')->will(
            $this->returnCallback(
                function ($toTest) use ($entity) {
                    return $toTest === $entity;
                }
            )
        );

        $storage = new ElasticStorage($provider, $registry);

        $this->assertTrue($storage->supports($entity));
        $this->assertFalse($storage->supports($this));
    }

    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать тип сущности.
     *
     * @throws Throwable
     */
    public function testSupportsClass()
    {
        $key = $this->createFakeData()->word;
        $provider = $this->createClientProviderMock();
        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('hasMapperForKey')->will(
            $this->returnCallback(
                function ($toTest) use ($key) {
                    return $toTest === $key;
                }
            )
        );

        $storage = new ElasticStorage($provider, $registry);

        $this->assertTrue($storage->supportsClass($key));
        $this->assertFalse($storage->supportsClass($key . '_test'));
    }

    // /**
    //  * Проверяет, что хранилище добавляет сущность.
    //  *
    //  * @throws Throwable
    //  */
    // public function testInsert()
    // {
    //     $index = 'ElasticStorageTestEntity';
    //
    //     $entity = new ElasticStorageTestEntity();
    //     $entity->id = $this->createFakeData()->word;
    //     $entity->data = [$this->createFakeData()->word => $this->createFakeData()->word];
    //
    //     $entity1 = new ElasticStorageTestEntity();
    //     $entity1->id = $this->createFakeData()->word;
    //     $entity1->data = [$this->createFakeData()->word => $this->createFakeData()->word];
    //
    //     $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
    //     $client->expects($this->once())->method('bulk')->with($this->equalTo([
    //         'body' => [
    //             ['index' => ['_index' => $index, '_id' => $entity->id]],
    //             $entity->data,
    //             ['index' => ['_index' => $index, '_id' => $entity1->id]],
    //             $entity1->data,
    //         ],
    //     ]));
    //
    //     $provider = $this->getMockBuilder(ClientProvider::class)->disableOriginalConstructor()->getMock();
    //     $provider->method('provide')->will($this->returnValue($client));
    //
    //     $storage = new ElasticStorage($provider);
    //     $storage->start();
    //     $storage->insert($entity);
    //     $storage->insert($entity1);
    //     $storage->stop();
    // }
    //
    // /**
    //  * Проверяет, что хранилище добавляет сущность указанными партиями.
    //  *
    //  * @throws Throwable
    //  */
    // public function testInsertByOne()
    // {
    //     $index = 'ElasticStorageTestEntity';
    //
    //     $entity = new ElasticStorageTestEntity();
    //     $entity->id = $this->createFakeData()->word;
    //     $entity->data = [$this->createFakeData()->word => $this->createFakeData()->word];
    //
    //     $entity1 = new ElasticStorageTestEntity();
    //     $entity1->id = $this->createFakeData()->word;
    //     $entity1->data = [$this->createFakeData()->word => $this->createFakeData()->word];
    //
    //     $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
    //     $client->expects($this->at(0))->method('bulk')->with($this->equalTo([
    //         'body' => [
    //             ['index' => ['_index' => $index, '_id' => $entity->id]],
    //             $entity->data,
    //         ],
    //     ]));
    //     $client->expects($this->at(1))->method('bulk')->with($this->equalTo([
    //         'body' => [
    //             ['index' => ['_index' => $index, '_id' => $entity1->id]],
    //             $entity1->data,
    //         ],
    //     ]));
    //
    //     $provider = $this->getMockBuilder(ClientProvider::class)->disableOriginalConstructor()->getMock();
    //     $provider->method('provide')->will($this->returnValue($client));
    //
    //     $storage = new ElasticStorage($provider, 1);
    //     $storage->start();
    //     $storage->insert($entity);
    //     $storage->insert($entity1);
    //     $storage->stop();
    // }
    //
    // /**
    //  * Проверяет, что исключение при добавлении документа будет перехвачено.
    //  *
    //  * @throws Throwable
    //  */
    // public function testInsertException()
    // {
    //     $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
    //     $client->method('bulk')->will($this->throwException(new RuntimeException));
    //
    //     $provider = $this->getMockBuilder(ClientProvider::class)->disableOriginalConstructor()->getMock();
    //     $provider->method('provide')->will($this->returnValue($client));
    //
    //     $storage = new ElasticStorage($provider);
    //
    //     $this->expectException(StorageException::class);
    //     $storage->start();
    //     $storage->insert(new ElasticStorageTestEntity());
    //     $storage->stop();
    // }

    /**
     * Проверяет, что хранилище удаляет сущность.
     *
     * @throws Throwable
     */
    public function testDelete()
    {
        $entity = new ElasticStorageTestEntity();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('delete')->with(
            $this->equalTo(
                [
                    'index' => 'ElasticStorageTestEntity',
                    'id' => 'ElasticStorageTestEntity_id',
                ]
            )
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);
        $storage->start();
        $storage->delete($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при удалении документа будет перехвачено.
     *
     * @throws Throwable
     */
    public function testDeleteException()
    {
        $client = $this->createClientMock();
        $client->method('delete')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->delete(new ElasticStorageTestEntity());
    }

    /**
     * Проверяет, что хранилище обновляет сущность.
     *
     * @throws Throwable
     */
    public function testUpsert()
    {
        $entity = new ElasticStorageTestEntity();
        $client = $this->createClientMock();
        $client->expects($this->once())->method('index')->with($this->equalTo([
            'index' => 'ElasticStorageTestEntity',
            'id' => 'ElasticStorageTestEntity_id',
            'body' => [
                'id' => 'ElasticStorageTestEntity_id',
                'payload' => 'ElasticStorageTestEntity_payload',
            ],
        ]));
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);
        $storage->start();
        $storage->upsert($entity);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при обновлении документа будет перехвачено.
     *
     * @throws Throwable
     */
    public function testUpsertException()
    {
        $client = $this->createClientMock();
        $client->method('index')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->upsert(new ElasticStorageTestEntity());
    }

    /**
     * Проверяет, что хранилище очищает все данные по типу сущности.
     *
     * @throws Throwable
     */
    public function testTruncate()
    {
        $client = $this->createClientMock();
        $client->expects($this->once())->method('deleteByQuery')->with(
            $this->equalTo(
                [
                    'index' => 'ElasticStorageTestEntity',
                    'body' => [],
                ]
            )
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);
        $storage->start();
        $storage->truncate('ElasticStorageTestEntity');
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при очистке хранилища будет перехвачено.
     *
     * @throws Throwable
     */
    public function testTruncateException()
    {
        $client = $this->createClientMock();
        $client->method('deleteByQuery')->will(
            $this->throwException(new RuntimeException())
        );
        $provider = $this->createClientProviderMock($client);
        $registry = $this->createRegistryMock();

        $storage = new ElasticStorage($provider, $registry);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->truncate(ElasticStorageTestEntity::class);
    }

    /**
     * Создает мок для объекта, клоторый предоставляет клиента.
     */
    private function createClientProviderMock(?Client $client = null)
    {
        if ($client === null) {
            $client = $this->createClientMock();
        }

        $provider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $provider->method('provide')->will($this->returnValue($client));

        return $provider;
    }

    /**
     * Создает мок для объекта клиента.
     */
    private function createClientMock()
    {
        return $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Создает мок для объекта с описаниями индексов.
     */
    private function createRegistryMock()
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will(
            $this->returnValue('ElasticStorageTestEntity')
        );
        $mapper->method('extractPrimaryFromEntity')->will(
            $this->returnCallback(
                function ($entity) {
                    return method_exists($entity, 'getId')
                        ? $entity->getId()
                        : null;
                }
            )
        );
        $mapper->method('extractDataFromEntity')->will(
            $this->returnCallback(
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
            )
        );

        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('getMapperForObject')->will(
            $this->returnCallback(
                function ($toTest) use ($mapper) {
                    if (!($toTest instanceof ElasticStorageTestEntity)) {
                        throw new RuntimeException("Can't find mapper.");
                    }

                    return $mapper;
                }
            )
        );
        $registry->method('getMapperForKey')->will(
            $this->returnCallback(
                function ($toTest) use ($mapper) {
                    if ($toTest !== 'ElasticStorageTestEntity') {
                        throw new RuntimeException("Can't find mapper.");
                    }

                    return $mapper;
                }
            )
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
