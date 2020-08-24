<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Тип помещения'.
 */
class FlatTypeIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'flattype';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'fltypeid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'fltypeid' => [
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
