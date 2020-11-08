<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Признак строения'.
 */
class StructureStatusIndexMapper extends IndexMapperAbstract
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
    public function getPrimaryName(): string
    {
        return 'strstatid';
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
                'type' => 'keyword',
            ],
            'shortname' => [
                'type' => 'keyword',
            ],
        ];
    }
}
