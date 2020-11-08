<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Классификатор адресообразующих элементов'.
 */
class AddressObjectIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'addressobject';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'aoid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'aoid' => [
                'type' => 'keyword',
            ],
            'aoguid' => [
                'type' => 'keyword',
            ],
            'parentguid' => [
                'type' => 'keyword',
            ],
            'previd' => [
                'type' => 'keyword',
            ],
            'nextid' => [
                'type' => 'keyword',
            ],
            'code' => [
                'type' => 'keyword',
            ],
            'formalname' => [
                'type' => 'text',
            ],
            'offname' => [
                'type' => 'text',
            ],
            'shortname' => [
                'type' => 'keyword',
            ],
            'aolevel' => [
                'type' => 'integer',
            ],
            'regioncode' => [
                'type' => 'keyword',
            ],
            'areacode' => [
                'type' => 'keyword',
            ],
            'autocode' => [
                'type' => 'keyword',
            ],
            'citycode' => [
                'type' => 'keyword',
            ],
            'ctarcode' => [
                'type' => 'keyword',
            ],
            'placecode' => [
                'type' => 'keyword',
            ],
            'plancode' => [
                'type' => 'keyword',
            ],
            'streetcode' => [
                'type' => 'keyword',
            ],
            'extrcode' => [
                'type' => 'keyword',
            ],
            'sextcode' => [
                'type' => 'keyword',
            ],
            'plaincode' => [
                'type' => 'keyword',
            ],
            'currstatus' => [
                'type' => 'integer',
            ],
            'actstatus' => [
                'type' => 'integer',
            ],
            'livestatus' => [
                'type' => 'integer',
            ],
            'centstatus' => [
                'type' => 'integer',
            ],
            'operstatus' => [
                'type' => 'integer',
            ],
            'ifnsfl' => [
                'type' => 'keyword',
            ],
            'ifnsul' => [
                'type' => 'keyword',
            ],
            'terrifnsfl' => [
                'type' => 'keyword',
            ],
            'terrifnsul' => [
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
            'divtype' => [
                'type' => 'integer',
            ],
            'normdoc' => [
                'type' => 'keyword',
            ],
        ];
    }
}
