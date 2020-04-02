<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapperRegistry;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\EntityInterface;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Интерфейс для объекта, который возвращает описание полей индекса для указанной сущности.
 */
interface IndexMapperRegistry
{
    /**
     * Возвращает правду, если объект имеет описание полей индекса для указанной сущности.
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function hasMapperFor(EntityInterface $entity): bool;

    /**
     * Возвращает описание индекса для сущности.
     *
     * @param EntityInterface $entity
     *
     * @return IndexMapperInterface
     *
     * @throws InvalidArgumentException
     */
    public function getMapperFor(EntityInterface $entity): IndexMapperInterface;

    /**
     * Возвращает список всех описаний индексов.
     *
     * @return IndexMapperInterface[]
     */
    public function getAllMappers(): array;
}
