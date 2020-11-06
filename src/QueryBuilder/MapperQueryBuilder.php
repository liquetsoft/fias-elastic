<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\QueryBuilder;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Объект, который строит запрос во внутреннем массиве с использованием описания индекса.
 */
class MapperQueryBuilder extends ArrayQueryBuilder
{
    private IndexMapperInterface $mapper;

    public function __construct(IndexMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): array
    {
        $query = parent::getQuery();
        $query['index'] = $this->mapper->getName();

        return $query;
    }

    /**
     * Выбрасывает исключение, если указанное свойство не существует в индексе.
     *
     * @param string $property
     *
     * @throws InvalidArgumentException
     */
    protected function isPropertyAllowed(string $property): void
    {
        if (!$this->mapper->hasProperty($property)) {
            $message = sprintf("There is no '%s' property in '%s' index.", $property, $this->mapper->getName());
            throw new InvalidArgumentException($message);
        }
    }
}
