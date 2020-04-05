<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\StructureStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень видов строений'.
 */
class StructureStatusTest extends EntityCase
{
    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new StructureStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'strstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
