<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\House;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по номерам домов улиц городов и населенных пунктов'.
 *
 * @internal
 */
class HouseTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new House();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'houseid' => $this->createFakeData()->word,
            'houseguid' => $this->createFakeData()->word,
            'aoguid' => $this->createFakeData()->word,
            'housenum' => $this->createFakeData()->word,
            'strstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'eststatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'statstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'ifnsfl' => $this->createFakeData()->word,
            'ifnsul' => $this->createFakeData()->word,
            'okato' => $this->createFakeData()->word,
            'oktmo' => $this->createFakeData()->word,
            'postalcode' => $this->createFakeData()->word,
            'startdate' => new DateTimeImmutable(),
            'enddate' => new DateTimeImmutable(),
            'updatedate' => new DateTimeImmutable(),
            'counter' => $this->createFakeData()->numberBetween(1, 1000000),
            'divtype' => $this->createFakeData()->numberBetween(1, 1000000),
            'regioncode' => $this->createFakeData()->word,
            'terrifnsfl' => $this->createFakeData()->word,
            'terrifnsul' => $this->createFakeData()->word,
            'buildnum' => $this->createFakeData()->word,
            'strucnum' => $this->createFakeData()->word,
            'normdoc' => $this->createFakeData()->word,
            'cadnum' => $this->createFakeData()->word,
        ];
    }
}
