<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\QueryBuilder;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Объект, который строит запрос во внутреннем массиве.
 */
class BaseQueryBuilder implements QueryBuilder
{
    /**
     * @var IndexMapperInterface
     */
    private $mapper;

    /**
     * @var array
     */
    private $match = [];

    /**
     * @param IndexMapperInterface $mapper
     */
    public function __construct(IndexMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @inheritDoc
     */
    public function match(string $property, $value): QueryBuilder
    {
        $this->isPropertyAllowed($property);

        $this->match[$property] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): array
    {
        $query = [
            'index' => $this->mapper->getName(),
            'body' => [
                'query' => [],
            ],
        ];

        foreach ($this->match as $property => $value) {
            $query['body']['query']['bool']['must'][] = [
                'match' => [
                    $property => $value,
                ],
            ];
        }

        return $query;
    }

    /**
     * Выбрасывает исключение, если указанное свойство не существует в индексе.
     *
     * @property string $property
     *
     * @throws InvalidArgumentException
     */
    private function isPropertyAllowed(string $property): void
    {
        if (!$this->mapper->hasProperty($property)) {
            $message = sprintf("There is no '%s' property in '%s' index.", $property, $this->mapper->getName());
            throw new InvalidArgumentException($message);
        }
    }
}
