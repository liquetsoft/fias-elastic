<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по иерархии в муниципальном делении'.
 */
class MunHierarchyIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'mun_hierarchy';
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
            'parentobjid' => [
                'type' => 'integer',
            ],
            'changeid' => [
                'type' => 'integer',
            ],
            'oktmo' => [
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
            'isactive' => [
                'type' => 'integer',
            ],
        ];
    }
}
