<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения о земельных участках'.
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
        return 'steadguid';
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
                'type' => 'text',
            ],
            'operstatus' => [
                'type' => 'text',
            ],
            'startdate' => [
                'type' => 'date',
                'format' => 'yyyy-mm-dd\'T\'HH:mm:ss',
            ],
            'enddate' => [
                'type' => 'date',
                'format' => 'yyyy-mm-dd\'T\'HH:mm:ss',
            ],
            'updatedate' => [
                'type' => 'date',
                'format' => 'yyyy-mm-dd\'T\'HH:mm:ss',
            ],
            'livestatus' => [
                'type' => 'text',
            ],
            'divtype' => [
                'type' => 'text',
            ],
            'normdoc' => [
                'type' => 'text',
            ],
        ];
    }
}
