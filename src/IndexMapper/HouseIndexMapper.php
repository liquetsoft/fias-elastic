<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по номерам домов улиц городов и населенных пунктов'.
 */
class HouseIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'house';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'houseid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'houseid' => [
                'type' => 'keyword',
            ],
            'houseguid' => [
                'type' => 'keyword',
            ],
            'aoguid' => [
                'type' => 'keyword',
            ],
            'housenum' => [
                'type' => 'keyword',
            ],
            'strstatus' => [
                'type' => 'integer',
            ],
            'eststatus' => [
                'type' => 'integer',
            ],
            'statstatus' => [
                'type' => 'integer',
            ],
            'ifnsfl' => [
                'type' => 'keyword',
            ],
            'ifnsul' => [
                'type' => 'keyword',
            ],
            'okato' => [
                'type' => 'keyword',
            ],
            'oktmo' => [
                'type' => 'keyword',
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
            'counter' => [
                'type' => 'integer',
            ],
            'divtype' => [
                'type' => 'integer',
            ],
            'regioncode' => [
                'type' => 'keyword',
            ],
            'terrifnsfl' => [
                'type' => 'keyword',
            ],
            'terrifnsul' => [
                'type' => 'keyword',
            ],
            'buildnum' => [
                'type' => 'keyword',
            ],
            'strucnum' => [
                'type' => 'keyword',
            ],
            'normdoc' => [
                'type' => 'keyword',
            ],
            'cadnum' => [
                'type' => 'keyword',
            ],
        ];
    }
}
