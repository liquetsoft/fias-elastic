<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по номерам домов улиц городов и населенных пунктов'.
 */
class HousesIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'houses';
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
            'objectguid' => [
                'type' => 'keyword',
            ],
            'changeid' => [
                'type' => 'integer',
            ],
            'housenum' => [
                'type' => 'keyword',
            ],
            'addnum1' => [
                'type' => 'keyword',
            ],
            'addnum2' => [
                'type' => 'keyword',
            ],
            'housetype' => [
                'type' => 'integer',
            ],
            'addtype1' => [
                'type' => 'integer',
            ],
            'addtype2' => [
                'type' => 'integer',
            ],
            'opertypeid' => [
                'type' => 'integer',
            ],
            'previd' => [
                'type' => 'integer',
            ],
            'nextid' => [
                'type' => 'integer',
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
            'isactual' => [
                'type' => 'integer',
            ],
            'isactive' => [
                'type' => 'integer',
            ],
        ];
    }
}
