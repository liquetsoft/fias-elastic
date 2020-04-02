<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapperRegistry;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\EntityInterface;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Объект, который хранит описания индексов во внутреннем массиве.
 */
class ArrayIndexMapperRegistry implements IndexMapperRegistry
{
    /**
     * @var IndexMapperInterface[]
     */
    private $indexMappers = [];

    /**
     * @param iterable $indexMappers
     *
     * @throws InvalidArgumentException
     */
    public function __construct(iterable $indexMappers)
    {
        foreach ($indexMappers as $key => $indexMapper) {
            if (!($indexMapper instanceof IndexMapperInterface)) {
                throw new InvalidArgumentException(
                    sprintf("Item with key '%s' must implements '%s'.", $key, IndexMapperInterface::class)
                );
            }
            $this->indexMappers[$indexMapper->getName()] = $indexMapper;
        }
    }

    /**
     * @inheritDoc
     */
    public function hasMapperFor(EntityInterface $entity): bool
    {
        return isset($this->indexMappers[$entity->getElasticSearchIndex()]);
    }

    /**
     * @inheritDoc
     */
    public function getMapperFor(EntityInterface $entity): IndexMapperInterface
    {
        if (!isset($this->indexMappers[$entity->getElasticSearchIndex()])) {
            throw new InvalidArgumentException(
                sprintf("Can't find mapper for '%s' index.", $entity->getElasticSearchIndex())
            );
        }

        return $this->indexMappers[$entity->getElasticSearchIndex()];
    }

    /**
     * @inheritDoc
     */
    public function getAllMappers(): array
    {
        return array_values($this->indexMappers);
    }
}
