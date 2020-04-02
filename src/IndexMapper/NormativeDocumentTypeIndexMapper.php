<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Типы нормативных документов'.
 */
class NormativeDocumentTypeIndexMapper implements IndexMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'normativedocumenttype';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'ndtypeid' => [
                'type' => 'keyword',
            ],
            'name' => [
                'type' => 'text',
            ],
        ];
    }
}
