<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\ElasticSearchRepository;

use Elasticsearch\Client;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\Exception\ElasticSearchRepositoryException;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Объект, который отправляет запросы на поиск в elasticsearch
 * и обрабатывает результаты.
 */
class BaseElasticSearchRepository implements ElasticSearchRepository
{
    private ClientProvider $clientProvider;

    private DenormalizerInterface $denormalizer;

    public function __construct(
        ClientProvider $clientProvider,
        DenormalizerInterface $denormalizer
    ) {
        $this->clientProvider = $clientProvider;
        $this->denormalizer = $denormalizer;
    }

    /**
     * {@inheritDoc}
     */
    public function one(QueryBuilder $queryBuilder, string $entityClass): ?object
    {
        $queryBuilder->size(1);
        $res = $this->all($queryBuilder, $entityClass);

        return $res[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function all(QueryBuilder $queryBuilder, string $entityClass): array
    {
        try {
            $result = $this->runSearchRequest($queryBuilder, $entityClass);
        } catch (\Throwable $e) {
            throw new ElasticSearchRepositoryException($e->getMessage(), 0, $e);
        }

        return $result;
    }

    /**
     * Проводит запрос на поиск данных в elasticsearch.
     *
     * @param QueryBuilder $queryBuilder
     * @param string       $entityClass
     *
     * @return object[]
     *
     * @throws ElasticSearchRepositoryException
     */
    private function runSearchRequest(QueryBuilder $queryBuilder, string $entityClass): array
    {
        $elasticResult = $this->getClient()->search($queryBuilder->getQuery());
        $hits = $elasticResult['hits']['hits'] ?? [];

        $result = [];
        foreach ($hits as $hit) {
            if (\is_array($hit)) {
                $result[] = $this->denormalizeHit($hit, $entityClass);
            }
        }

        return $result;
    }

    /**
     * Денормализует ответ от elasticsearch в указанный тип объекта.
     *
     * @param array  $hit
     * @param string $entityClass
     *
     * @return object
     */
    private function denormalizeHit(array $hit, string $entityClass): object
    {
        if (empty($hit['_source']) || !\is_array($hit['_source'])) {
            $message = "Can't denormalize item from elasticsearch empty source.";
            throw new ElasticSearchRepositoryException($message);
        }

        $object = $this->denormalizer->denormalize($hit['_source'], $entityClass);

        if (!\is_object($object)) {
            $message = 'Denormalizer returned non-object instance.';
            throw new ElasticSearchRepositoryException($message);
        }

        return $object;
    }

    /**
     * Возвращает объект клиента для запросов к elasticsearch.
     *
     * @return Client
     */
    private function getClient(): Client
    {
        return $this->clientProvider->provide();
    }
}
