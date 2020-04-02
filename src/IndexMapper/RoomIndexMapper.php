<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Сведения о помещениях (квартирах, офисах, комнатах и т.д.)'.
 */
class RoomIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'room';
    }

    /**
     * @inheritDoc
     */
    public function getMap(): array
    {
        return [
            'dynamic' => 'strict',
            '_doc' => [
                'properties' => [
                    'roomid' => [
                        'type' => 'keyword',
                    ],
                    'roomguid' => [
                        'type' => 'text',
                    ],
                    'houseguid' => [
                        'type' => 'text',
                    ],
                    'regioncode' => [
                        'type' => 'text',
                    ],
                    'flatnumber' => [
                        'type' => 'text',
                    ],
                    'flattype' => [
                        'type' => 'integer',
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
                    'operstatus' => [
                        'type' => 'text',
                    ],
                    'livestatus' => [
                        'type' => 'text',
                    ],
                    'normdoc' => [
                        'type' => 'text',
                    ],
                ],
            ],
        ];
    }
}
