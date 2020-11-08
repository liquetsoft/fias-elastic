<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Классификатор земельных участков'.
 */
class SteadIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'stead';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'steadid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'steadguid' => [
                'type' => 'keyword',
            ],
            'number' => [
                'type' => 'text',
            ],
            'regioncode' => [
                'type' => 'keyword',
            ],
            'postalcode' => [
                'type' => 'keyword',
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
            'parentguid' => [
                'type' => 'keyword',
            ],
            'steadid' => [
                'type' => 'keyword',
            ],
            'operstatus' => [
                'type' => 'integer',
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
            'livestatus' => [
                'type' => 'integer',
            ],
            'divtype' => [
                'type' => 'integer',
            ],
            'normdoc' => [
                'type' => 'keyword',
            ],
            'terrifnsfl' => [
                'type' => 'keyword',
            ],
            'terrifnsul' => [
                'type' => 'keyword',
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
        ];
    }
}
