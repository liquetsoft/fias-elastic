<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use DateTimeInterface;
use Liquetsoft\Fias\Elastic\Entity\Room;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения о помещениях (квартирах, офисах, комнатах и т.д.)'.
 */
class RoomTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('Room', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setRoomid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
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
            'startdate' => $entity->getStartdate()->format(DateTimeInterface::ATOM),
            'enddate' => $entity->getEnddate()->format(DateTimeInterface::ATOM),
            'updatedate' => $entity->getUpdatedate()->format(DateTimeInterface::ATOM),
            'operstatus' => $entity->getOperstatus(),
            'livestatus' => $entity->getLivestatus(),
            'normdoc' => $entity->getNormdoc(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
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
