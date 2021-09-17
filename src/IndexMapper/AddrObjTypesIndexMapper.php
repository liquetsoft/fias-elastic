<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по типам адресных объектов'.
 */
class AddrObjTypesIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'addr_obj_types';
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
            'level' => [
                'type' => 'integer',
            ],
            'shortname' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
            'desc' => [
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
            'isactive' => [
                'type' => 'text',
            ],
        ];
    }
}
