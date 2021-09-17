<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\ParamTypes;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по типу параметра'.
 *
 * @internal
 */
class ParamTypesTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new ParamTypes();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'id' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'code' => $this->createFakeData()->word,
            'desc' => $this->createFakeData()->word,
            'updatedate' => new DateTimeImmutable(),
            'startdate' => new DateTimeImmutable(),
            'enddate' => new DateTimeImmutable(),
            'isactive' => $this->createFakeData()->word,
        ];
    }
}
