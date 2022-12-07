<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\QueryBuilder;

/**
 * Объект, который строит запрос во внутреннем массиве.
 *
 * @psalm-suppress MixedArrayAccess
 */
class ArrayQueryBuilder implements QueryBuilder
{
    private array $query = [];

    /**
     * {@inheritDoc}
     */
    public function match(string $property, $value): QueryBuilder
    {
        $this->isPropertyAllowed($property);

        $this->query['body']['query']['bool']['must'][] = [
            'match' => [
                $property => $value,
            ],
        ];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function term(string $property, $value): QueryBuilder
    {
        $this->isPropertyAllowed($property);

        $this->query['body']['query']['bool']['must'][] = [
            'term' => [$property => ['value' => $value]],
        ];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function notExist(string $property): QueryBuilder
    {
        $this->isPropertyAllowed($property);

        $this->query['body']['query']['bool']['must_not'][] = [
            'exists' => [
                'field' => $property,
            ],
        ];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function sortAsc(string $property): QueryBuilder
    {
        return $this->sort($property, QueryBuilder::SORT_ORDER_ASC);
    }

    /**
     * {@inheritDoc}
     */
    public function sortDesc(string $property): QueryBuilder
    {
        return $this->sort($property, QueryBuilder::SORT_ORDER_DESC);
    }

    /**
     * {@inheritDoc}
     */
    public function sort(string $property, string $order = QueryBuilder::SORT_ORDER_ASC): QueryBuilder
    {
        if ($order !== QueryBuilder::SORT_ORDER_ASC && $order !== QueryBuilder::SORT_ORDER_DESC) {
            $message = sprintf("Wrong sort order '%s'.", $order);
            throw new \InvalidArgumentException($message);
        }

        $this->isPropertyAllowed($property);

        $this->query['body']['sort'][] = [
            $property => [
                'order' => $order,
            ],
        ];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function size(int $size): QueryBuilder
    {
        $this->query['size'] = $size;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function from(int $from): QueryBuilder
    {
        $this->query['from'] = $from;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function searchAfter(array $values): QueryBuilder
    {
        $this->query['body']['search_after'] = array_values($values);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function merge(QueryBuilder $builder): QueryBuilder
    {
        $this->query = array_merge_recursive($this->query, $builder->getQuery());

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * Выбрасывает исключение, если указанное свойство не существует в индексе.
     *
     * @param string $property
     *
     * @throws \InvalidArgumentException
     */
    protected function isPropertyAllowed(string $property): void
    {
    }
}
