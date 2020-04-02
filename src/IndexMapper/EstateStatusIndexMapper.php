<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень возможных видов владений'.
 */
class EstateStatusIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'estatestatus';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'eststatid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
        ];
    }
}
