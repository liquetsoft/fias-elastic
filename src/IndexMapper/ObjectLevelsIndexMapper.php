<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по уровням адресных объектов'.
 */
class ObjectLevelsIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'object_levels';
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryName(): string
    {
        return 'level';
    }

    /**
     * {@inheritDoc}
     */
    public function getMappingProperties(): array
    {
        return [
            'level' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
            'shortname' => [
                'type' => 'keyword',
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
            'isactive' => [
                'type' => 'text',
            ],
        ];
    }
}
