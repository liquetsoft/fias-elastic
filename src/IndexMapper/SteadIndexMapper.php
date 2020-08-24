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
                'type' => 'text',
            ],
            'number' => [
                'type' => 'text',
            ],
            'regioncode' => [
                'type' => 'text',
            ],
            'postalcode' => [
                'type' => 'text',
            ],
            'ifnsfl' => [
                'type' => 'text',
            ],
            'ifnsul' => [
                'type' => 'text',
            ],
            'okato' => [
                'type' => 'text',
            ],
            'oktmo' => [
                'type' => 'text',
            ],
            'parentguid' => [
                'type' => 'text',
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
                'type' => 'text',
            ],
            'terrifnsfl' => [
                'type' => 'text',
            ],
            'terrifnsul' => [
                'type' => 'text',
            ],
            'previd' => [
                'type' => 'text',
            ],
            'nextid' => [
                'type' => 'text',
            ],
            'cadnum' => [
                'type' => 'text',
            ],
        ];
    }
}
