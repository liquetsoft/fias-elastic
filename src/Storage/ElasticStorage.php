<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Storage;

use Elasticsearch\Client;
use Liquetsoft\Fias\Component\Exception\StorageException;
use Liquetsoft\Fias\Component\Storage\Storage;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperException;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperRegistryException;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;

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
     * Объект для работы с снастройками индекса.
     */
    private IndexBuilder $indexBuilder;

    /**
     * Количество элементов для множественной вставки.
     */
    private int $insertBatch;

    /**
     * Ссылка на объект клиента, если он уже был получен.
     */
    private ?Client $client = null;

    /**
     * Данные операций для множественной отправки.
     *
     * @var array<string, object[]>
     */
    private array $bulkOperations = [];

    /**
     * Список замороженных индексов, которые были разморожены для вставки.
     *
     * @var array<string, IndexMapperInterface>
     */
    private array $unfrozedIndicies = [];

    public function __construct(
        ClientProvider $clientProvider,
        IndexMapperRegistry $registry,
        IndexBuilder $indexBuilder,
        int $insertBatch = 1000
    ) {
        $this->clientProvider = $clientProvider;
        $this->registry = $registry;
        $this->indexBuilder = $indexBuilder;
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
        $this->freezeIndices();
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
        } catch (\Throwable $e) {
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
                $carry += \count($operationArray);

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
        } catch (\Throwable $e) {
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
     * @param array<string, object[]> $operations
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

        $mapper = $this->getAndPrepareMapperForObject($object);
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
     * Получает и подготавливает маппер для указанного объекта.
     *
     * @param object $object
     *
     * @return IndexMapperInterface
     *
     * @throws IndexMapperRegistryException
     * @throws IndexMapperException
     */
    private function getAndPrepareMapperForObject(object $object): IndexMapperInterface
    {
        $mapper = $this->registry->getMapperForObject($object);
        $name = $mapper->getName();

        if (!isset($this->unfrozedIndicies[$name]) && $this->indexBuilder->isFrozen($mapper)) {
            $this->indexBuilder->unfreeze($mapper);
            $this->unfrozedIndicies[$name] = $mapper;
        }

        return $mapper;
    }

    /**
     * Замораживает все размороженные в процессе работы индексы.
     */
    private function freezeIndices(): void
    {
        foreach ($this->unfrozedIndicies as $mapper) {
            $this->indexBuilder->freeze($mapper);
        }

        $this->unfrozedIndicies = [];
    }

    /**
     * Возвращает клиента из текущего провайдера клиента elasticsearch.
     *
     * @return Client
     */
    private function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = $this->clientProvider->provide();
        }

        return $this->client;
    }
}
