<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\Room;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Классификатор помещениях'.
 */
class RoomTest extends EntityCase
{
    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new Room();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'roomid' => $this->createFakeData()->word,
            'roomguid' => $this->createFakeData()->word,
            'houseguid' => $this->createFakeData()->word,
            'regioncode' => $this->createFakeData()->word,
            'flatnumber' => $this->createFakeData()->word,
            'flattype' => $this->createFakeData()->numberBetween(1, 1000000),
            'postalcode' => $this->createFakeData()->word,
            'startdate' => new DateTime(),
            'enddate' => new DateTime(),
            'updatedate' => new DateTime(),
            'operstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'livestatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'normdoc' => $this->createFakeData()->word,
            'roomnumber' => $this->createFakeData()->word,
            'roomtype' => $this->createFakeData()->numberBetween(1, 1000000),
            'previd' => $this->createFakeData()->word,
            'nextid' => $this->createFakeData()->word,
            'cadnum' => $this->createFakeData()->word,
            'roomcadnum' => $this->createFakeData()->word,
        ];
    }
}
