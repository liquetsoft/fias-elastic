<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по земельным участкам'.
 */
class SteadsIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'steads';
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
            'number' => [
                'type' => 'text',
            ],
            'opertypeid' => [
                'type' => 'keyword',
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
