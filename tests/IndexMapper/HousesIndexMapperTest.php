<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\HousesIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по номерам домов улиц городов и населенных пунктов'.
 *
 * @internal
 */
class HousesIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new HousesIndexMapper();

        $this->assertSame('houses', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new HousesIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new HousesIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('objectid', $map);
        $this->assertArrayHasKey('objectguid', $map);
        $this->assertArrayHasKey('changeid', $map);
        $this->assertArrayHasKey('housenum', $map);
        $this->assertArrayHasKey('addnum1', $map);
        $this->assertArrayHasKey('addnum2', $map);
        $this->assertArrayHasKey('housetype', $map);
        $this->assertArrayHasKey('addtype1', $map);
        $this->assertArrayHasKey('addtype2', $map);
        $this->assertArrayHasKey('opertypeid', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('isactual', $map);
        $this->assertArrayHasKey('isactive', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = 'primary_value';

        $mapper = new HousesIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectguid = $this->createFakeData()->word;
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->housenum = $this->createFakeData()->word;
        $entity->addnum1 = $this->createFakeData()->word;
        $entity->addnum2 = $this->createFakeData()->word;
        $entity->housetype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->addtype1 = $this->createFakeData()->numberBetween(1, 100000);
        $entity->addtype2 = $this->createFakeData()->numberBetween(1, 100000);
        $entity->opertypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->previd = $this->createFakeData()->numberBetween(1, 100000);
        $entity->nextid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->updatedate = new DateTimeImmutable();
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->isactual = $this->createFakeData()->numberBetween(1, 100000);
        $entity->isactive = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new HousesIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('objectid', $dataForElastic);
        $this->assertSame($entity->objectid, $dataForElastic['objectid'], 'Test objectid field conversion.');
        $this->assertArrayHasKey('objectguid', $dataForElastic);
        $this->assertSame($entity->objectguid, $dataForElastic['objectguid'], 'Test objectguid field conversion.');
        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame($entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
        $this->assertArrayHasKey('housenum', $dataForElastic);
        $this->assertSame($entity->housenum, $dataForElastic['housenum'], 'Test housenum field conversion.');
        $this->assertArrayHasKey('addnum1', $dataForElastic);
        $this->assertSame($entity->addnum1, $dataForElastic['addnum1'], 'Test addnum1 field conversion.');
        $this->assertArrayHasKey('addnum2', $dataForElastic);
        $this->assertSame($entity->addnum2, $dataForElastic['addnum2'], 'Test addnum2 field conversion.');
        $this->assertArrayHasKey('housetype', $dataForElastic);
        $this->assertSame($entity->housetype, $dataForElastic['housetype'], 'Test housetype field conversion.');
        $this->assertArrayHasKey('addtype1', $dataForElastic);
        $this->assertSame($entity->addtype1, $dataForElastic['addtype1'], 'Test addtype1 field conversion.');
        $this->assertArrayHasKey('addtype2', $dataForElastic);
        $this->assertSame($entity->addtype2, $dataForElastic['addtype2'], 'Test addtype2 field conversion.');
        $this->assertArrayHasKey('opertypeid', $dataForElastic);
        $this->assertSame($entity->opertypeid, $dataForElastic['opertypeid'], 'Test opertypeid field conversion.');
        $this->assertArrayHasKey('previd', $dataForElastic);
        $this->assertSame($entity->previd, $dataForElastic['previd'], 'Test previd field conversion.');
        $this->assertArrayHasKey('nextid', $dataForElastic);
        $this->assertSame($entity->nextid, $dataForElastic['nextid'], 'Test nextid field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('isactual', $dataForElastic);
        $this->assertSame($entity->isactual, $dataForElastic['isactual'], 'Test isactual field conversion.');
        $this->assertArrayHasKey('isactive', $dataForElastic);
        $this->assertSame($entity->isactive, $dataForElastic['isactive'], 'Test isactive field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new HousesIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new HousesIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
