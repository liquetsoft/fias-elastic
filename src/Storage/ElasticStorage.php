<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Component\Storage\Storage;
use Liquetsoft\Fias\Elastic\EntityInterface;
use Throwable;

/**
 * Объект, который сохраняет данные ФИАС с помощью elastic search.
 */
class ElasticStorage implements Storage
{
    /**
     * Клиент для отправки запросов в elastic search.
     *
     * @var Client
     */
    private $client;

    /**
     * Количество элементов для множественной вставки.
     *
     * @var int
     */
    private $insertBatch;

    /**
     * Сохраненные в памяти данные для множественной вставки.
     *
     * @var EntityInterface[]
     */
    private $insertData = [];

    /**
     * @param Client $client
     * @param int    $insertBatch
     */
    public function __construct(Client $client, int $insertBatch = 1000)
    {
        $this->client = $client;
        $this->insertBatch = $insertBatch;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function stop(): void
    {
        $this->flushInsert();
    }

    /**
     * @inheritDoc
     */
    public function supports(object $entity): bool
    {
        return $this->supportsClass(get_class($entity));
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class): bool
    {
        return is_subclass_of($class, EntityInterface::class);
    }

    /**
     * @inheritDoc
     */
    public function insert(object $entity): void
    {
        $this->insertData[] = $this->checkEntity($entity);
        if (count($this->insertData) >= $this->insertBatch) {
            $this->flushInsert();
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(object $entity): void
    {
        $elasticEntity = $this->checkEntity($entity);

        try {
            $this->client->delete([
                'index' => $elasticEntity->getElasticSearchDocumentType(),
                'type' => $elasticEntity->getElasticSearchDocumentType(),
                'id' => $elasticEntity->getElasticSearchDocumentId(),
            ]);
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function upsert(object $entity): void
    {
        $elasticEntity = $this->checkEntity($entity);

        try {
            $this->client->index([
                'index' => $elasticEntity->getElasticSearchDocumentType(),
                'type' => $elasticEntity->getElasticSearchDocumentType(),
                'id' => $elasticEntity->getElasticSearchDocumentId(),
                'body' => $elasticEntity->getElasticSearchDocumentData(),
            ]);
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function truncate(string $entityClassName): void
    {
        $entity = $this->createEntityFromString($entityClassName);

        try {
            $this->client->deleteByQuery([
                'index' => $entity->getElasticSearchDocumentType(),
                'type' => $entity->getElasticSearchDocumentType(),
                'body' => [],
            ]);
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Создает сущность по имени класса или выбрасывает исключение.
     *
     * @param string $entityClassName
     *
     * @return EntityInterface
     *
     * @throws StorageException
     */
    private function createEntityFromString(string $entityClassName): EntityInterface
    {
        if (!class_exists($entityClassName)) {
            throw new StorageException(sprintf('Class %s does not exist.', $entityClassName));
        }

        $entity = new $entityClassName();

        if (!($entity instanceof EntityInterface)) {
            throw new StorageException(sprintf('Class %s must implements %s.', $entityClassName, EntityInterface::class));
        }

        return $entity;
    }

    /**
     * Возвращает сущность, если она реализует EntityInterface, или выбрасывает исключение.
     *
     * @param object $entity
     *
     * @return EntityInterface
     *
     * @throws StorageException
     */
    private function checkEntity(object $entity): EntityInterface
    {
        if (!($entity instanceof EntityInterface)) {
            throw new StorageException(sprintf('Entity must implements %s interface.', EntityInterface::class));
        }

        return $entity;
    }

    /**
     * Отправляет накопленный набор данных в elastic search.
     *
     * @throws StorageException
     */
    private function flushInsert(): void
    {
        $dataForQuery = [];
        foreach ($this->insertData as $item) {
            $dataForQuery[] = [
                'index' => [
                    '_index' => $item->getElasticSearchDocumentType(),
                    '_type' => $item->getElasticSearchDocumentType(),
                    '_id' => $item->getElasticSearchDocumentId(),
                ],
            ];
            $dataForQuery[] = $item->getElasticSearchDocumentData();
        }

        if (!empty($dataForQuery)) {
            try {
                $this->client->bulk(['body' => $dataForQuery]);
            } catch (Throwable $e) {
                throw new StorageException($e->getMessage(), 0, $e);
            }
        }

        $this->insertData = [];
    }
}
