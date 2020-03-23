<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\Room;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения о помещениях (квартирах, офисах, комнатах и т.д.)'.
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
            'startdate' => new DateTime,
            'enddate' => new DateTime,
            'updatedate' => new DateTime,
            'operstatus' => $this->createFakeData()->word,
            'livestatus' => $this->createFakeData()->word,
            'normdoc' => $this->createFakeData()->word,
        ];
    }
}
