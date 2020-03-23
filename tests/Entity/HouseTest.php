<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\House;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Элементы адреса, идентифицирующие адресуемые объекты'.
 */
class HouseTest extends EntityCase
{
    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new House();
    }

    /**
     * @inheritdoc
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
            'startdate' => new DateTime,
            'enddate' => new DateTime,
            'updatedate' => new DateTime,
            'counter' => $this->createFakeData()->numberBetween(1, 1000000),
            'divtype' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
