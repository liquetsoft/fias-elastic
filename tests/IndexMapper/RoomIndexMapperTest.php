<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\RoomIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Классификатор помещениях'.
 *
 * @internal
 */
class RoomIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('room', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('roomid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new RoomIndexMapper();
        $map = $mapper->getMappingProperties();

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
        $this->assertArrayHasKey('roomnumber', $map);
        $this->assertArrayHasKey('roomtype', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('cadnum', $map);
        $this->assertArrayHasKey('roomcadnum', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->roomid = 'primary_value';

        $mapper = new RoomIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->roomid = $this->createFakeData()->word;
        $entity->roomguid = $this->createFakeData()->word;
        $entity->houseguid = $this->createFakeData()->word;
        $entity->regioncode = $this->createFakeData()->word;
        $entity->flatnumber = $this->createFakeData()->word;
        $entity->flattype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->postalcode = $this->createFakeData()->word;
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->updatedate = new DateTimeImmutable();
        $entity->operstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->livestatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->normdoc = $this->createFakeData()->word;
        $entity->roomnumber = $this->createFakeData()->word;
        $entity->roomtype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->previd = $this->createFakeData()->word;
        $entity->nextid = $this->createFakeData()->word;
        $entity->cadnum = $this->createFakeData()->word;
        $entity->roomcadnum = $this->createFakeData()->word;

        $mapper = new RoomIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('roomid', $dataForElastic);
        $this->assertSame($entity->roomid, $dataForElastic['roomid'], 'Test roomid field conversion.');
        $this->assertArrayHasKey('roomguid', $dataForElastic);
        $this->assertSame($entity->roomguid, $dataForElastic['roomguid'], 'Test roomguid field conversion.');
        $this->assertArrayHasKey('houseguid', $dataForElastic);
        $this->assertSame($entity->houseguid, $dataForElastic['houseguid'], 'Test houseguid field conversion.');
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode'], 'Test regioncode field conversion.');
        $this->assertArrayHasKey('flatnumber', $dataForElastic);
        $this->assertSame($entity->flatnumber, $dataForElastic['flatnumber'], 'Test flatnumber field conversion.');
        $this->assertArrayHasKey('flattype', $dataForElastic);
        $this->assertSame($entity->flattype, $dataForElastic['flattype'], 'Test flattype field conversion.');
        $this->assertArrayHasKey('postalcode', $dataForElastic);
        $this->assertSame($entity->postalcode, $dataForElastic['postalcode'], 'Test postalcode field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('operstatus', $dataForElastic);
        $this->assertSame($entity->operstatus, $dataForElastic['operstatus'], 'Test operstatus field conversion.');
        $this->assertArrayHasKey('livestatus', $dataForElastic);
        $this->assertSame($entity->livestatus, $dataForElastic['livestatus'], 'Test livestatus field conversion.');
        $this->assertArrayHasKey('normdoc', $dataForElastic);
        $this->assertSame($entity->normdoc, $dataForElastic['normdoc'], 'Test normdoc field conversion.');
        $this->assertArrayHasKey('roomnumber', $dataForElastic);
        $this->assertSame($entity->roomnumber, $dataForElastic['roomnumber'], 'Test roomnumber field conversion.');
        $this->assertArrayHasKey('roomtype', $dataForElastic);
        $this->assertSame($entity->roomtype, $dataForElastic['roomtype'], 'Test roomtype field conversion.');
        $this->assertArrayHasKey('previd', $dataForElastic);
        $this->assertSame($entity->previd, $dataForElastic['previd'], 'Test previd field conversion.');
        $this->assertArrayHasKey('nextid', $dataForElastic);
        $this->assertSame($entity->nextid, $dataForElastic['nextid'], 'Test nextid field conversion.');
        $this->assertArrayHasKey('cadnum', $dataForElastic);
        $this->assertSame($entity->cadnum, $dataForElastic['cadnum'], 'Test cadnum field conversion.');
        $this->assertArrayHasKey('roomcadnum', $dataForElastic);
        $this->assertSame($entity->roomcadnum, $dataForElastic['roomcadnum'], 'Test roomcadnum field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new RoomIndexMapper();

        $this->assertTrue($mapper->hasProperty('roomid'));
        $this->assertFalse($mapper->hasProperty('roomid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new RoomIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
