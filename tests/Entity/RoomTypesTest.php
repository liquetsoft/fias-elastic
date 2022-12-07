<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\RoomTypes;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по типам комнат'.
 *
 * @internal
 */
class RoomTypesTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new RoomTypes();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'id' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
            'desc' => $this->createFakeData()->word,
            'updatedate' => new \DateTimeImmutable(),
            'startdate' => new \DateTimeImmutable(),
            'enddate' => new \DateTimeImmutable(),
            'isactive' => $this->createFakeData()->word,
        ];
    }
}
