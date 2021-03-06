<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Статус актуальности ФИАС'.
 */
class ActualStatusIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'actualstatus';
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryName(): string
    {
        return 'actstatid';
    }

    /**
     * {@inheritDoc}
     */
    public function getMappingProperties(): array
    {
        return [
            'actstatid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'keyword',
            ],
        ];
    }
}
