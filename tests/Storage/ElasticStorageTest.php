<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Elastic\EntityInterface;
use Liquetsoft\Fias\Elastic\Storage\ElasticStorage;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use RuntimeException;
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
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $storage = new ElasticStorage($client);

        $this->assertTrue($storage->supports(new ElasticStorageTestEntity()));
        $this->assertFalse($storage->supports($this));
    }

    /**
     * Проверяет, что хранилище верно определяет, что может обрабатывать тип сущности.
     *
     * @throws Throwable
     */
    public function testSupportsClass()
    {
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $storage = new ElasticStorage($client);

        $this->assertTrue($storage->supportsClass(ElasticStorageTestEntity::class));
        $this->assertFalse($storage->supportsClass(get_class($this)));
    }

    /**
     * Проверяет, что хранилище добавляет сущность.
     *
     * @throws Throwable
     */
    public function testInsert()
    {
        $index = 'ElasticStorageTestEntity';

        $entity = new ElasticStorageTestEntity();
        $entity->id = $this->createFakeData()->word;
        $entity->data = [$this->createFakeData()->word => $this->createFakeData()->word];

        $entity1 = new ElasticStorageTestEntity();
        $entity1->id = $this->createFakeData()->word;
        $entity1->data = [$this->createFakeData()->word => $this->createFakeData()->word];

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())->method('bulk')->with($this->equalTo([
            'body' => [
                ['index' => ['_index' => $index, '_type' => $index, '_id' => $entity->id]],
                $entity->data,
                ['index' => ['_index' => $index, '_type' => $index, '_id' => $entity1->id]],
                $entity1->data,
            ],
        ]));

        $storage = new ElasticStorage($client);
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
    public function testInsertByOne()
    {
        $index = 'ElasticStorageTestEntity';

        $entity = new ElasticStorageTestEntity();
        $entity->id = $this->createFakeData()->word;
        $entity->data = [$this->createFakeData()->word => $this->createFakeData()->word];

        $entity1 = new ElasticStorageTestEntity();
        $entity1->id = $this->createFakeData()->word;
        $entity1->data = [$this->createFakeData()->word => $this->createFakeData()->word];

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->at(0))->method('bulk')->with($this->equalTo([
            'body' => [
                ['index' => ['_index' => $index, '_type' => $index, '_id' => $entity->id]],
                $entity->data,
            ],
        ]));
        $client->expects($this->at(1))->method('bulk')->with($this->equalTo([
            'body' => [
                ['index' => ['_index' => $index, '_type' => $index, '_id' => $entity1->id]],
                $entity1->data,
            ],
        ]));

        $storage = new ElasticStorage($client, 1);
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
    public function testInsertException()
    {
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('bulk')->will($this->throwException(new RuntimeException));

        $storage = new ElasticStorage($client);

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
    public function testDelete()
    {
        $entity = new ElasticStorageTestEntity();
        $entity->id = $this->createFakeData()->word;

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())->method('delete')->with($this->equalTo([
            'index' => 'ElasticStorageTestEntity',
            'type' => 'ElasticStorageTestEntity',
            'id' => $entity->id,
        ]));

        $storage = new ElasticStorage($client);
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
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('delete')->will($this->throwException(new RuntimeException));

        $storage = new ElasticStorage($client);

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
        $entity->id = $this->createFakeData()->word;
        $entity->data = [$this->createFakeData()->word => $this->createFakeData()->word];

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())->method('index')->with($this->equalTo([
            'index' => 'ElasticStorageTestEntity',
            'type' => 'ElasticStorageTestEntity',
            'id' => $entity->id,
            'body' => $entity->data,
        ]));

        $storage = new ElasticStorage($client);
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
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('index')->will($this->throwException(new RuntimeException));

        $storage = new ElasticStorage($client);

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
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())->method('deleteByQuery')->with(
            $this->equalTo(['index' => 'ElasticStorageTestEntity', 'type' => 'ElasticStorageTestEntity', 'body' => []])
        );

        $storage = new ElasticStorage($client);
        $storage->start();
        $storage->truncate(ElasticStorageTestEntity::class);
        $storage->stop();
    }

    /**
     * Проверяет, что исключение при очистке хранилища будет перехвачено.
     *
     * @throws Throwable
     */
    public function testTruncateException()
    {
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('deleteByQuery')->will($this->throwException(new RuntimeException));

        $storage = new ElasticStorage($client);

        $this->expectException(StorageException::class);
        $storage->start();
        $storage->truncate(ElasticStorageTestEntity::class);
    }
}

/**
 * Мок сущности для тестов.
 */
class ElasticStorageTestEntity implements EntityInterface
{
    public $id = '';

    public $data = [];

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'ElasticStorageTestEntity';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return $this->data;
    }
}
