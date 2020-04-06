<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Реестр адресообразующих элементов'.
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
                'type' => 'text',
            ],
            'previd' => [
                'type' => 'text',
            ],
            'nextid' => [
                'type' => 'text',
            ],
            'code' => [
                'type' => 'text',
            ],
            'formalname' => [
                'type' => 'text',
            ],
            'offname' => [
                'type' => 'text',
            ],
            'shortname' => [
                'type' => 'text',
            ],
            'aolevel' => [
                'type' => 'integer',
            ],
            'regioncode' => [
                'type' => 'text',
            ],
            'areacode' => [
                'type' => 'text',
            ],
            'autocode' => [
                'type' => 'text',
            ],
            'citycode' => [
                'type' => 'text',
            ],
            'ctarcode' => [
                'type' => 'text',
            ],
            'placecode' => [
                'type' => 'text',
            ],
            'plancode' => [
                'type' => 'text',
            ],
            'streetcode' => [
                'type' => 'text',
            ],
            'extrcode' => [
                'type' => 'text',
            ],
            'sextcode' => [
                'type' => 'text',
            ],
            'plaincode' => [
                'type' => 'text',
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
                'type' => 'text',
            ],
            'ifnsul' => [
                'type' => 'text',
            ],
            'terrifnsfl' => [
                'type' => 'text',
            ],
            'terrifnsul' => [
                'type' => 'text',
            ],
            'okato' => [
                'type' => 'text',
            ],
            'oktmo' => [
                'type' => 'text',
            ],
            'postalcode' => [
                'type' => 'text',
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
        ];
    }
}
