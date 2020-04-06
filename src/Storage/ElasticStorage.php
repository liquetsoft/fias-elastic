<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Component\Storage\Storage;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Throwable;

/**
 * Объект, который сохраняет данные ФИАС с помощью elastic search.
 */
class ElasticStorage implements Storage
{
    /**
     * Клиент для отправки запросов в elastic search.
     *
     * @var ClientProvider
     */
    private $clientProvider;

    /**
     * Объект с описаниями индексов.
     *
     * @var IndexMapperRegistry
     */
    private $registry;

    /**
     * Количество элементов для множественной вставки.
     *
     * @var int
     */
    private $insertBatch;

    /**
     * Сохраненные в памяти данные для множественной вставки.
     *
     * @var object[]
     */
    private $insertData = [];

    /**
     * @param ClientProvider      $clientProvider
     * @param IndexMapperRegistry $registry
     * @param int                 $insertBatch
     */
    public function __construct(
        ClientProvider $clientProvider,
        IndexMapperRegistry $registry,
        int $insertBatch = 1000
    ) {
        $this->clientProvider = $clientProvider;
        $this->registry = $registry;
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
        return $this->registry->hasMapperForObject($entity);
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class): bool
    {
        return $this->registry->hasMapperForKey($class);
    }

    /**
     * @inheritDoc
     */
    public function insert(object $entity): void
    {
        $this->insertData[] = $entity;

        if (count($this->insertData) >= $this->insertBatch) {
            $this->flushInsert();
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(object $entity): void
    {
        try {
            $mapper = $this->registry->getMapperForObject($entity);
            $this->getClient()->delete([
                'index' => $mapper->getName(),
                'id' => $mapper->extractPrimaryFromEntity($entity),
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
        try {
            $mapper = $this->registry->getMapperForObject($entity);
            $this->getClient()->index([
                'index' => $mapper->getName(),
                'id' => $mapper->extractPrimaryFromEntity($entity),
                'body' => $mapper->extractDataFromEntity($entity),
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
        try {
            $mapper = $this->registry->getMapperForKey($entityClassName);
            $this->getClient()->deleteByQuery([
                'index' => $mapper->getName(),
                'ignore_unavailable' => true,
                'body' => [
                    'query' => [
                        'match_all' => (object) [],
                    ],
                ],
            ]);
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Отправляет накопленный набор данных в elastic search.
     *
     * @throws StorageException
     */
    private function flushInsert(): void
    {
        try {
            $dataForQuery = [];
            foreach ($this->insertData as $item) {
                $mapper = $this->registry->getMapperForObject($item);
                $dataForQuery[] = [
                    'index' => [
                        '_index' => $mapper->getName(),
                        '_id' => $mapper->extractPrimaryFromEntity($item),
                    ],
                ];
                $dataForQuery[] = $mapper->extractDataFromEntity($item);
            }

            $this->insertData = [];

            if (!empty($dataForQuery)) {
                $this->getClient()->bulk(['body' => $dataForQuery]);
            }
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Возвращает клиента из текущего провайдера клиента elasticsearch.
     *
     * @return Client
     */
    private function getClient(): Client
    {
        return $this->clientProvider->provide();
    }
}
