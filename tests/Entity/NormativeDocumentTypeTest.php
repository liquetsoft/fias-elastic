<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\NormativeDocumentType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Тип нормативного документа'.
 */
class NormativeDocumentTypeTest extends EntityCase
{
    /**
     * {@inheritdoc}
     */
    protected function createEntity()
    {
        return new NormativeDocumentType();
    }

    /**
     * {@inheritdoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'ndtypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
