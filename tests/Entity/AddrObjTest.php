<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\AddrObj;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения классификатора адресообразующих элементов'.
 *
 * @internal
 */
class AddrObjTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new AddrObj();
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
            'name' => $this->createFakeData()->word,
            'typename' => $this->createFakeData()->word,
            'level' => $this->createFakeData()->word,
            'opertypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'previd' => $this->createFakeData()->numberBetween(1, 1000000),
            'nextid' => $this->createFakeData()->numberBetween(1, 1000000),
            'updatedate' => new \DateTimeImmutable(),
            'startdate' => new \DateTimeImmutable(),
            'enddate' => new \DateTimeImmutable(),
            'isactual' => $this->createFakeData()->numberBetween(1, 1000000),
            'isactive' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
