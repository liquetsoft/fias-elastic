<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Признак владения'.
 */
class EstateStatusIndexMapper extends IndexMapperAbstract
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'estatestatus';
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryName(): string
    {
        return 'eststatid';
    }

    /**
     * {@inheritDoc}
     */
    public function getMappingProperties(): array
    {
        return [
            'eststatid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'keyword',
            ],
            'shortname' => [
                'type' => 'keyword',
            ],
        ];
    }
}
