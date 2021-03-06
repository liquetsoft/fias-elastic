<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\ActualStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Статус актуальности ФИАС'.
 */
class ActualStatusTest extends EntityCase
{
    /**
     * {@inheritdoc}
     */
    protected function createEntity()
    {
        return new ActualStatus();
    }

    /**
     * {@inheritdoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'actstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
