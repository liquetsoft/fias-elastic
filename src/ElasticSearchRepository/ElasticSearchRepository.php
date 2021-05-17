<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\ElasticSearchRepository;

use Liquetsoft\Fias\Elastic\Exception\ElasticSearchRepositoryException;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;

/**
 * Интерфейс для объекта, который отправляет запросы на поиск в elasticsearch
 * и обрабатывает результаты.
 */
interface ElasticSearchRepository
{
    /**
     * Ищет только одну запись по условию.
     *
     * @param QueryBuilder $queryBuilder
     * @param string       $entityClass
     *
     * @return object|null
     *
     * @throws ElasticSearchRepositoryException
     */
    public function one(QueryBuilder $queryBuilder, string $entityClass): ?object;

    /**
     * Отправляет запрос на поиск в elasticsearch
     * и преобразует ответ в соответствующий массив объектов.
     *
     * @param QueryBuilder $queryBuilder
     * @param string       $entityClass
     *
     * @return object[]
     *
     * @throws ElasticSearchRepositoryException
     */
    public function all(QueryBuilder $queryBuilder, string $entityClass): array;
}
