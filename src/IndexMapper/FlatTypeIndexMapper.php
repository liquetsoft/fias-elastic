<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень типов помещения или офиса'.
 */
class FlatTypeIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'flattype';
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
                    'fltypeid' => [
                        'type' => 'keyword',
                    ],
                    'name' => [
                        'type' => 'text',
                    ],
                    'shortname' => [
                        'type' => 'text',
                    ],
                ],
            ],
        ];
    }
}
