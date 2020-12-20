<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Классификатор помещениях'.
 */
class RoomIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'room';
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryName(): string
    {
        return 'roomid';
    }

    /**
     * {@inheritDoc}
     */
    public function getMappingProperties(): array
    {
        return [
            'roomid' => [
                'type' => 'keyword',
            ],
            'roomguid' => [
                'type' => 'keyword',
            ],
            'houseguid' => [
                'type' => 'keyword',
            ],
            'regioncode' => [
                'type' => 'keyword',
            ],
            'flatnumber' => [
                'type' => 'keyword',
            ],
            'flattype' => [
                'type' => 'integer',
            ],
            'postalcode' => [
                'type' => 'keyword',
            ],
            'startdate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'enddate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'updatedate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'operstatus' => [
                'type' => 'integer',
            ],
            'livestatus' => [
                'type' => 'integer',
            ],
            'normdoc' => [
                'type' => 'keyword',
            ],
            'roomnumber' => [
                'type' => 'keyword',
            ],
            'roomtype' => [
                'type' => 'integer',
            ],
            'previd' => [
                'type' => 'keyword',
            ],
            'nextid' => [
                'type' => 'keyword',
            ],
            'cadnum' => [
                'type' => 'keyword',
            ],
            'roomcadnum' => [
                'type' => 'keyword',
            ],
        ];
    }
}
