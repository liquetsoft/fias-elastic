<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTime;
use Liquetsoft\Fias\Elastic\IndexMapper\RoomIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения о помещениях (квартирах, офисах, комнатах и т.д.)'.
 */
class RoomIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('room', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('roomid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new RoomIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('roomid', $map);
        $this->assertArrayHasKey('roomguid', $map);
        $this->assertArrayHasKey('houseguid', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('flatnumber', $map);
        $this->assertArrayHasKey('flattype', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('normdoc', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->roomid = 'primary_value';

        $mapper = new RoomIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->roomid = $this->createFakeData()->word;
        $entity->roomguid = $this->createFakeData()->word;
        $entity->houseguid = $this->createFakeData()->word;
        $entity->regioncode = $this->createFakeData()->word;
        $entity->flatnumber = $this->createFakeData()->word;
        $entity->flattype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->postalcode = $this->createFakeData()->word;
        $entity->startdate = new DateTime();
        $entity->enddate = new DateTime();
        $entity->updatedate = new DateTime();
        $entity->operstatus = $this->createFakeData()->word;
        $entity->livestatus = $this->createFakeData()->word;
        $entity->normdoc = $this->createFakeData()->word;

        $mapper = new RoomIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('roomid', $dataForElastic);
        $this->assertSame($entity->roomid, $dataForElastic['roomid']);
        $this->assertArrayHasKey('roomguid', $dataForElastic);
        $this->assertSame($entity->roomguid, $dataForElastic['roomguid']);
        $this->assertArrayHasKey('houseguid', $dataForElastic);
        $this->assertSame($entity->houseguid, $dataForElastic['houseguid']);
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode']);
        $this->assertArrayHasKey('flatnumber', $dataForElastic);
        $this->assertSame($entity->flatnumber, $dataForElastic['flatnumber']);
        $this->assertArrayHasKey('flattype', $dataForElastic);
        $this->assertSame($entity->flattype, $dataForElastic['flattype']);
        $this->assertArrayHasKey('postalcode', $dataForElastic);
        $this->assertSame($entity->postalcode, $dataForElastic['postalcode']);
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate']);
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate']);
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate']);
        $this->assertArrayHasKey('operstatus', $dataForElastic);
        $this->assertSame($entity->operstatus, $dataForElastic['operstatus']);
        $this->assertArrayHasKey('livestatus', $dataForElastic);
        $this->assertSame($entity->livestatus, $dataForElastic['livestatus']);
        $this->assertArrayHasKey('normdoc', $dataForElastic);
        $this->assertSame($entity->normdoc, $dataForElastic['normdoc']);
    }
}
