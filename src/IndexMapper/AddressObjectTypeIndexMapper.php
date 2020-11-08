<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Тип адресного объекта'.
 */
class AddressObjectTypeIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'addressobjecttype';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'kodtst';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'kodtst' => [
                'type' => 'keyword',
            ],
            'level' => [
                'type' => 'integer',
            ],
            'socrname' => [
                'type' => 'keyword',
            ],
            'scname' => [
                'type' => 'keyword',
            ],
        ];
    }
}
