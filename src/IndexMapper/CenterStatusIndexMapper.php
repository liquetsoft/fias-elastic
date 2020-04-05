<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Перечень возможных статусов (центров) адресных объектов административных единиц'.
 */
class CenterStatusIndexMapper extends IndexMapperAbstract
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
    public function getPrimaryName(): string
    {
        return 'centerstid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'centerstid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
        ];
    }
}
