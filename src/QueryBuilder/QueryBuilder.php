<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\QueryBuilder;

use InvalidArgumentException;

/**
 * Интерфейс для объекта, который строит поисковые запросы для elasticsearch.
 */
interface QueryBuilder
{
    /**
     * Добавить в условие поиск по полному совпадению.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return QueryBuilder
     *
     * @throws InvalidArgumentException
     */
    public function match(string $property, $value): QueryBuilder;

    /**
     * Возвращает запрос для клиента elasticsearch.
     *
     * @return array
     */
    public function getQuery(): array;
}
