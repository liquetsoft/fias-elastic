<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации'.
 */
class AddressObjectTypeIndexMapper implements IndexMapperInterface
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
    public function getMap(): array
    {
        return [
            'dynamic' => 'strict',
            '_doc' => [
                'properties' => [
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
                ],
            ],
        ];
    }
}
