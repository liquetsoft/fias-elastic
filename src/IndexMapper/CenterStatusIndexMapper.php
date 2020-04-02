<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень возможных статусов (центров) адресных объектов административных единиц'.
 */
class CenterStatusIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'centerstatus';
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
                    'centerstid' => [
                        'type' => 'keyword',
                    ],
                    'name' => [
                        'type' => 'text',
                    ],
                ],
            ],
        ];
    }
}
