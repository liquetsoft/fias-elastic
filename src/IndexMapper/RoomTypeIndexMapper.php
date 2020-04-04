<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Перечень типов комнат'.
 */
class RoomTypeIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'roomtype';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'rmtypeid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'rmtypeid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
            'shortname' => [
                'type' => 'text',
            ],
        ];
    }
}
