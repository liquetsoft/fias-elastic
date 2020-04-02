<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень видов строений'.
 */
class StructureStatusIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'structurestatus';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'strstatid' => [
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