<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\Carplaces;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по машино-местам'.
 *
 * @internal
 */
class CarplacesTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new Carplaces();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'id' => $this->createFakeData()->numberBetween(1, 1000000),
            'objectid' => $this->createFakeData()->numberBetween(1, 1000000),
            'objectguid' => $this->createFakeData()->word,
            'changeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'number' => $this->createFakeData()->word,
            'opertypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'previd' => $this->createFakeData()->numberBetween(1, 1000000),
            'nextid' => $this->createFakeData()->numberBetween(1, 1000000),
            'updatedate' => new DateTimeImmutable(),
            'startdate' => new DateTimeImmutable(),
            'enddate' => new DateTimeImmutable(),
            'isactual' => $this->createFakeData()->numberBetween(1, 1000000),
            'isactive' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
