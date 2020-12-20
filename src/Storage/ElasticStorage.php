<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Component\Storage\Storage;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperException;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperRegistryException;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Throwable;

/**
 * Объект, который сохраняет данные ФИАС с помощью elastic search.
 */
class ElasticStorage implements Storage
{
    /**
     * Клиент для отправки запросов в elastic search.
     */
    private ClientProvider $clientProvider;

    /**
     * Объект с описаниями индексов.
     */
    private IndexMapperRegistry $registry;

    /**
     * Количество элементов для множественной вставки.
     */
    private int $insertBatch;

    /**
     * Данные операций для множественной отправки.
     *
     * @var array<string, array>
     */
    private array $bulkOperations = [];

    public function __construct(ClientProvider $clientProvider, IndexMapperRegistry $registry, int $insertBatch = 1000)
    {
        $this->clientProvider = $clientProvider;
        $this->registry = $registry;
        $this->insertBatch = $insertBatch;
    }

    /**
     * {@inheritDoc}
     */
    public function start(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function stop(): void
    {
        $this->flushBulk();
    }

    /**
     * {@inheritDoc}
     */
    public function supports(object $entity): bool
    {
        return $this->registry->hasMapperForObject($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass(string $class): bool
    {
        return $this->registry->hasMapperForKey($class);
    }

    /**
     * {@inheritDoc}
     */
    public function insert(object $entity): void
    {
        $this->addBulkOperation('index', $entity);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(object $entity): void
    {
        $this->addBulkOperation('delete', $entity);
    }

    /**
     * {@inheritDoc}
     */
    public function upsert(object $entity): void
    {
        $this->addBulkOperation('index', $entity);
    }

    /**
     * {@inheritDoc}
     */
    public function truncate(string $entityClassName): void
    {
        try {
            $mapper = $this->registry->getMapperForKey($entityClassName);
            $this->getClient()->deleteByQuery(
                [
                    'index' => $mapper->getName(),
                    'ignore_unavailable' => true,
                    'body' => [
                        'query' => [
                            'match_all' => (object) [],
                        ],
                    ],
                ]
            );
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Добавляет операцию с объектом для множественной отправки команд одним запросом.
     *
     * @param string $operation
     * @param object $item
     *
     * @throws StorageException
     */
    private function addBulkOperation(string $operation, object $item): void
    {
        $this->bulkOperations[$operation][] = $item;

        $itemsCount = array_reduce(
            $this->bulkOperations,
            function (int $carry, array $operationArray): int {
                $carry += count($operationArray);

                return $carry;
            },
            0
        );

        if ($itemsCount >= $this->insertBatch) {
            $this->flushBulk();
        }
    }

    /**
     * Отправляет все данные в одном множественном запросе.
     *
     * @throws StorageException
     */
    private function flushBulk(): void
    {
        try {
            $this->runBulkQuery();
            $this->bulkOperations = [];
        } catch (Throwable $e) {
            throw new StorageException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Непосредственная отправка запроса на применение множества операций.
     *
     * @throws IndexMapperException
     * @throws IndexMapperRegistryException
     * @throws StorageException
     */
    private function runBulkQuery(): void
    {
        $bulkQuery = $this->convertBulkOperationsToBulkQuery($this->bulkOperations);

        if (empty($bulkQuery)) {
            return;
        }

        $res = $this->getClient()->bulk(
            [
                'body' => $bulkQuery,
            ]
        );

        if (!empty($res['error'])) {
            throw new StorageException(
                'Error while bulk insert: ' . json_encode($res['items'])
            );
        }
    }

    /**
     * Конвертирует операции в массив для отправки запроса.
     *
     * @param array $operations
     *
     * @return array
     *
     * @throws IndexMapperRegistryException
     * @throws IndexMapperException
     */
    private function convertBulkOperationsToBulkQuery(array $operations): array
    {
        $query = [];
        foreach ($operations as $operation => $objects) {
            foreach ($objects as $object) {
                $query = array_merge($query, $this->createOperationArray($operation, $object));
            }
        }

        return $query;
    }

    /**
     * Создает массив для конкретной операции над объектом.
     *
     * @param string $operation
     * @param object $object
     *
     * @return array
     *
     * @throws IndexMapperRegistryException
     * @throws IndexMapperException
     */
    private function createOperationArray(string $operation, object $object): array
    {
        $operationArray = [];

        $mapper = $this->registry->getMapperForObject($object);
        $index = $mapper->getName();
        $id = $mapper->extractPrimaryFromEntity($object);

        if ($operation === 'delete') {
            $operationArray[] = [
                'delete' => [
                    '_index' => $index,
                    '_id' => $id,
                ],
            ];
        } else {
            $operationArray[] = [
                $operation => [
                    '_index' => $index,
                    '_id' => $id,
                ],
            ];
            $operationArray[] = $mapper->extractDataFromEntity($object);
        }

        return $operationArray;
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
