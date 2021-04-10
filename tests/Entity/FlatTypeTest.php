<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\FlatType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Тип помещения'.
 *
 * @internal
 */
class FlatTypeTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new FlatType();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'fltypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
