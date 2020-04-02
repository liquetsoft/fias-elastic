<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень статусов актуальности записи адресного элемента по ФИАС'.
 */
class ActualStatusIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'actualstatus';
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
                    'actstatid' => [
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
