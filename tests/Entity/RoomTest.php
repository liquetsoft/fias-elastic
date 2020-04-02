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
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('room', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setRoomid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setRoomid($this->createFakeData()->word);
        $entity->setRoomguid($this->createFakeData()->word);
        $entity->setHouseguid($this->createFakeData()->word);
        $entity->setRegioncode($this->createFakeData()->word);
        $entity->setFlatnumber($this->createFakeData()->word);
        $entity->setFlattype($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setPostalcode($this->createFakeData()->word);
        $entity->setStartdate(new DateTime());
        $entity->setEnddate(new DateTime());
        $entity->setUpdatedate(new DateTime());
        $entity->setOperstatus($this->createFakeData()->word);
        $entity->setLivestatus($this->createFakeData()->word);
        $entity->setNormdoc($this->createFakeData()->word);

        $arrayToTest = [
            'roomid' => $entity->getRoomid(),
            'roomguid' => $entity->getRoomguid(),
            'houseguid' => $entity->getHouseguid(),
            'regioncode' => $entity->getRegioncode(),
            'flatnumber' => $entity->getFlatnumber(),
            'flattype' => $entity->getFlattype(),
            'postalcode' => $entity->getPostalcode(),
            'startdate' => $entity->getStartdate()->format('Y-m-d\TH:i:s'),
            'enddate' => $entity->getEnddate()->format('Y-m-d\TH:i:s'),
            'updatedate' => $entity->getUpdatedate()->format('Y-m-d\TH:i:s'),
            'operstatus' => $entity->getOperstatus(),
            'livestatus' => $entity->getLivestatus(),
            'normdoc' => $entity->getNormdoc(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

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
            'operstatus' => $this->createFakeData()->word,
            'livestatus' => $this->createFakeData()->word,
            'normdoc' => $this->createFakeData()->word,
        ];
    }
}
