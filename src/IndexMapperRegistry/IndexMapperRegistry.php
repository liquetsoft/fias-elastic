<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapperRegistry;

use Liquetsoft\Fias\Elastic\Exception\IndexMapperRegistryException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Интерфейс для объекта, который возвращает описание полей индекса для указанной сущности.
 */
interface IndexMapperRegistry
{
    /**
     * Возвращает список всех описаний индексов.
     *
     * @return IndexMapperInterface[]
     */
    public function getAllMappers(): array;

    /**
     * Возвращает правду, если указанному ключу соответствует маппер.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasMapperForKey(string $key): bool;

    /**
     * Возвращает соответствующий объекту маппер или выбрасывает исключение.
     *
     * @param string $key
     *
     * @return IndexMapperInterface
     *
     * @throws IndexMapperRegistryException
     */
    public function getMapperForKey(string $key): IndexMapperInterface;

    /**
     * Возвращает правду, если указанному объекту соответствует маппер.
     *
     * @param object $object
     *
     * @return bool
     */
    public function hasMapperForObject(object $object): bool;

    /**
     * Возвращает соответствующий объекту маппер или выбрасывает исключение.
     *
     * @param object $object
     *
     * @return IndexMapperInterface
     *
     * @throws IndexMapperRegistryException
     */
    public function getMapperForObject(object $object): IndexMapperInterface;
}
