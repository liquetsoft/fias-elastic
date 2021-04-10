<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\AddressObjectType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Тип адресного объекта'.
 *
 * @internal
 */
class AddressObjectTypeTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new AddressObjectType();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'kodtst' => $this->createFakeData()->word,
            'level' => $this->createFakeData()->numberBetween(1, 1000000),
            'socrname' => $this->createFakeData()->word,
            'scname' => $this->createFakeData()->word,
        ];
    }
}
