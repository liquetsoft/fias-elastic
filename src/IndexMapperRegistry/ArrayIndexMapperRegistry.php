<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapperRegistry;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperRegistryException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Объект, который хранит описания индексов во внутреннем массиве.
 */
class ArrayIndexMapperRegistry implements IndexMapperRegistry
{
    /**
     * @var array<string, IndexMapperInterface>
     */
    private array $indexMappers = [];

    public function __construct(iterable $indexMappers)
    {
        foreach ($indexMappers as $key => $indexMapper) {
            if (!($indexMapper instanceof IndexMapperInterface)) {
                throw new InvalidArgumentException(
                    sprintf("Item with key '%s' must implements '%s'.", $key, IndexMapperInterface::class)
                );
            }
            $this->indexMappers[$this->unifyKey($key)] = $indexMapper;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAllMappers(): array
    {
        return array_values($this->indexMappers);
    }

    /**
     * {@inheritDoc}
     */
    public function hasMapperForKey(string $key): bool
    {
        $unifiedKey = $this->unifyKey($key);

        return isset($this->indexMappers[$unifiedKey]);
    }

    /**
     * {@inheritDoc}
     */
    public function getMapperForKey(string $key): IndexMapperInterface
    {
        $unifiedKey = $this->unifyKey($key);

        if (!isset($this->indexMappers[$unifiedKey])) {
            throw new IndexMapperRegistryException(sprintf("Can't find mapper for '%s' key.", $key));
        }

        return $this->indexMappers[$unifiedKey];
    }

    /**
     * {@inheritDoc}
     */
    public function hasMapperForObject(object $object): bool
    {
        return $this->hasMapperForKey(get_class($object));
    }

    /**
     * {@inheritDoc}
     */
    public function getMapperForObject(object $object): IndexMapperInterface
    {
        return $this->getMapperForKey(get_class($object));
    }

    /**
     * Приводит ключи для мапперов к общему виду.
     *
     * @param mixed $key
     *
     * @return string
     */
    private function unifyKey($key): string
    {
        return strtolower(trim((string) $key, " \t\n\r\0\x0B\\/"));
    }
}
