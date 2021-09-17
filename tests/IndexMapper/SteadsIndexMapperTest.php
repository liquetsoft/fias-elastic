<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\SteadsIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по земельным участкам'.
 *
 * @internal
 */
class SteadsIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new SteadsIndexMapper();

        $this->assertSame('steads', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new SteadsIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new SteadsIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('objectid', $map);
        $this->assertArrayHasKey('objectguid', $map);
        $this->assertArrayHasKey('changeid', $map);
        $this->assertArrayHasKey('number', $map);
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

        $mapper = new SteadsIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectguid = $this->createFakeData()->word;
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->number = $this->createFakeData()->word;
        $entity->opertypeid = $this->createFakeData()->word;
        $entity->previd = $this->createFakeData()->numberBetween(1, 100000);
        $entity->nextid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->updatedate = new DateTimeImmutable();
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->isactual = $this->createFakeData()->numberBetween(1, 100000);
        $entity->isactive = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new SteadsIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('objectid', $dataForElastic);
        $this->assertSame($entity->objectid, $dataForElastic['objectid'], 'Test objectid field conversion.');
        $this->assertArrayHasKey('objectguid', $dataForElastic);
        $this->assertSame($entity->objectguid, $dataForElastic['objectguid'], 'Test objectguid field conversion.');
        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame($entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
        $this->assertArrayHasKey('number', $dataForElastic);
        $this->assertSame($entity->number, $dataForElastic['number'], 'Test number field conversion.');
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
        $mapper = new SteadsIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new SteadsIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
