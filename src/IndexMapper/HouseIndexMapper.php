<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Элементы адреса, идентифицирующие адресуемые объекты'.
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
                'type' => 'text',
            ],
            'aoguid' => [
                'type' => 'text',
            ],
            'housenum' => [
                'type' => 'text',
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
            'postalcode' => [
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
            'counter' => [
                'type' => 'integer',
            ],
            'divtype' => [
                'type' => 'integer',
            ],
        ];
    }
}
