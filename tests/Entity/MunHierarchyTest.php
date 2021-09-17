<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\MunHierarchy;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по иерархии в муниципальном делении'.
 *
 * @internal
 */
class MunHierarchyTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new MunHierarchy();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'id' => $this->createFakeData()->numberBetween(1, 1000000),
            'objectid' => $this->createFakeData()->numberBetween(1, 1000000),
            'parentobjid' => $this->createFakeData()->numberBetween(1, 1000000),
            'changeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'oktmo' => $this->createFakeData()->word,
            'previd' => $this->createFakeData()->numberBetween(1, 1000000),
            'nextid' => $this->createFakeData()->numberBetween(1, 1000000),
            'updatedate' => new DateTimeImmutable(),
            'startdate' => new DateTimeImmutable(),
            'enddate' => new DateTimeImmutable(),
            'isactive' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
