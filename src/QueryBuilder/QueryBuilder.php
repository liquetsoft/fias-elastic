<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\QueryBuilder;

/**
 * Интерфейс для объекта, который строит поисковые запросы для elasticsearch.
 */
interface QueryBuilder
{
    public const SORT_ORDER_ASC = 'asc';

    public const SORT_ORDER_DESC = 'desc';

    /**
     * Добавить в условие поиск по частичному совпадению.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function match(string $property, $value): QueryBuilder;

    /**
     * Добавить в условие поиск по полному совпадению.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function term(string $property, $value): QueryBuilder;

    /**
     * Добавить в условие поиск по отсутствию значения.
     *
     * @param string $property
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function notExist(string $property): QueryBuilder;

    /**
     * Добавить порядок сортировки по возрастанию.
     *
     * @param string $property
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function sortAsc(string $property): QueryBuilder;

    /**
     * Добавить порядок сортировки по убыванию.
     *
     * @param string $property
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function sortDesc(string $property): QueryBuilder;

    /**
     * Добавить сортировку в указанном порядке.
     *
     * @param string $property
     * @param string $order
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function sort(string $property, string $order = QueryBuilder::SORT_ORDER_ASC): QueryBuilder;

    /**
     * Добавить ограничение на количество документов.
     *
     * @param int $size
     *
     * @return QueryBuilder
     */
    public function size(int $size): QueryBuilder;

    /**
     * Добавить смещение по элементам.
     *
     * @param int $from
     *
     * @return QueryBuilder
     */
    public function from(int $from): QueryBuilder;

    /**
     * Добавить значения search_after для пагинации.
     *
     * @param array $values
     *
     * @return QueryBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function searchAfter(array $values): QueryBuilder;

    /**
     * Объединяет запросы из двух объектов.
     *
     * @param QueryBuilder $builder
     *
     * @return QueryBuilder
     */
    public function merge(QueryBuilder $builder): QueryBuilder;

    /**
     * Возвращает запрос для клиента elasticsearch.
     *
     * @return array
     */
    public function getQuery(): array;
}
