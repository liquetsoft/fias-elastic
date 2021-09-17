<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения о классификаторе параметров адресообразующих элементов и объектов недвижимости'.
 */
class ParamIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'param';
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryName(): string
    {
        return 'id';
    }

    /**
     * {@inheritDoc}
     */
    public function getMappingProperties(): array
    {
        return [
            'id' => [
                'type' => 'keyword',
            ],
            'objectid' => [
                'type' => 'integer',
            ],
            'changeid' => [
                'type' => 'integer',
            ],
            'changeidend' => [
                'type' => 'integer',
            ],
            'typeid' => [
                'type' => 'integer',
            ],
            'value' => [
                'type' => 'text',
            ],
            'updatedate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'startdate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'enddate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
        ];
    }
}
