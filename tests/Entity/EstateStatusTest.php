<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\EstateStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Признак владения'.
 */
class EstateStatusTest extends EntityCase
{
    /**
     * {@inheritdoc}
     */
    protected function createEntity()
    {
        return new EstateStatus();
    }

    /**
     * {@inheritdoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'eststatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
