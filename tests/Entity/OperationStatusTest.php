<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\OperationStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Статус действия'.
 */
class OperationStatusTest extends EntityCase
{
    /**
     * {@inheritdoc}
     */
    protected function createEntity()
    {
        return new OperationStatus();
    }

    /**
     * {@inheritdoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'operstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
