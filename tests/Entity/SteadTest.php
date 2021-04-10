<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\Stead;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Классификатор земельных участков'.
 *
 * @internal
 */
class SteadTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new Stead();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'steadguid' => $this->createFakeData()->word,
            'number' => $this->createFakeData()->word,
            'regioncode' => $this->createFakeData()->word,
            'postalcode' => $this->createFakeData()->word,
            'ifnsfl' => $this->createFakeData()->word,
            'ifnsul' => $this->createFakeData()->word,
            'okato' => $this->createFakeData()->word,
            'oktmo' => $this->createFakeData()->word,
            'parentguid' => $this->createFakeData()->word,
            'steadid' => $this->createFakeData()->word,
            'operstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'startdate' => new DateTimeImmutable(),
            'enddate' => new DateTimeImmutable(),
            'updatedate' => new DateTimeImmutable(),
            'livestatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'divtype' => $this->createFakeData()->numberBetween(1, 1000000),
            'normdoc' => $this->createFakeData()->word,
            'terrifnsfl' => $this->createFakeData()->word,
            'terrifnsul' => $this->createFakeData()->word,
            'previd' => $this->createFakeData()->word,
            'nextid' => $this->createFakeData()->word,
            'cadnum' => $this->createFakeData()->word,
        ];
    }
}
