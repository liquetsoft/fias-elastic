<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0'.
 */
class CurrentStatusIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'currentstatus';
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
                    'curentstid' => [
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
