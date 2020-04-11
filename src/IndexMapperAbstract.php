<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic;

use DateTimeInterface;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperException;
use Liquetsoft\Fias\Elastic\QueryBuilder\BaseQueryBuilder;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;

/**
 * Базовый класс для объекта с описанием индекса.
 */
abstract class IndexMapperAbstract implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function extractPrimaryFromEntity(object $entity): string
    {
        $primaryName = $this->getPrimaryName();
        $primaryValue = $this->extractParameterFormEntity($primaryName, $entity);

        if ($primaryValue === null) {
            throw new IndexMapperException(
                sprintf("Can't find value for primary '%s'.", $primaryName)
            );
        }

        return (string) $primaryValue;
    }

    /**
     * @inheritDoc
     */
    public function extractDataFromEntity(object $entity): array
    {
        $extractedData = [];

        $fields = $this->getMappingProperties();
        foreach ($fields as $fieldName => $fieldDescription) {
            $fieldValue = $this->extractParameterFormEntity($fieldName, $entity);
            $convertedValue = $this->convertValueForElastic($fieldValue, $fieldDescription);
            $extractedData[$fieldName] = $convertedValue;
        }

        return $extractedData;
    }

    /**
     * @inheritDoc
     */
    public function hasProperty(string $property): bool
    {
        $fields = $this->getMappingProperties();

        return isset($fields[$property]);
    }

    /**
     * @inheritDoc
     */
    public function query(): QueryBuilder
    {
        return new BaseQueryBuilder($this);
    }

    /**
     * Извлекает значение по имени из сущности.
     *
     * @param string $parameter
     * @param object $entity
     *
     * @return mixed
     */
    private function extractParameterFormEntity(string $parameter, object $entity)
    {
        $value = null;
        $getter = 'get' . ucfirst($parameter);

        if (method_exists($entity, $getter)) {
            $value = $entity->$getter();
        } elseif (isset($entity->$parameter)) {
            $value = $entity->$parameter;
        }

        return $value;
    }

    /**
     * Приводит значение к типу, указанному в описании.
     *
     * @param mixed $value
     * @param array $description
     *
     * @return mixed
     *
     * @throws IndexMapperException
     */
    private function convertValueForElastic($value, array $description)
    {
        if ($value === null) {
            return null;
        }

        $type = $description['type'] ?? 'text';
        if ($type === 'integer') {
            $convertedValue = (int) $value;
        } elseif ($type === 'text' || $type === 'keyword') {
            $convertedValue = (string) $value;
        } elseif ($type === 'date' && $value instanceof DateTimeInterface) {
            $convertedValue = $value->format('Y-m-d\TH:i:s');
        } else {
            throw new IndexMapperException(
                sprintf("Can't recognize type '%s' to convert.", $type)
            );
        }

        return $convertedValue;
    }
}
