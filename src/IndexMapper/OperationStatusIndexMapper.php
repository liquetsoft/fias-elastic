<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Статус действия'.
 */
class OperationStatusIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'operationstatus';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'operstatid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'operstatid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'keyword',
            ],
        ];
    }
}
