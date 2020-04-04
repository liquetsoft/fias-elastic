<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации'.
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
                'type' => 'text',
            ],
            'scname' => [
                'type' => 'text',
            ],
        ];
    }
}
