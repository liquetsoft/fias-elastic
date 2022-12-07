<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\AddrObjTypesIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения по типам адресных объектов'.
 *
 * @internal
 */
class AddrObjTypesIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new AddrObjTypesIndexMapper();

        $this->assertSame('addr_obj_types', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new AddrObjTypesIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new AddrObjTypesIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('level', $map);
        $this->assertArrayHasKey('shortname', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('desc', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('isactive', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = 'primary_value';

        $mapper = new AddrObjTypesIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->level = $this->createFakeData()->numberBetween(1, 100000);
        $entity->shortname = $this->createFakeData()->word;
        $entity->name = $this->createFakeData()->word;
        $entity->desc = $this->createFakeData()->word;
        $entity->updatedate = new \DateTimeImmutable();
        $entity->startdate = new \DateTimeImmutable();
        $entity->enddate = new \DateTimeImmutable();
        $entity->isactive = $this->createFakeData()->word;

        $mapper = new AddrObjTypesIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('level', $dataForElastic);
        $this->assertSame($entity->level, $dataForElastic['level'], 'Test level field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('desc', $dataForElastic);
        $this->assertSame($entity->desc, $dataForElastic['desc'], 'Test desc field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('isactive', $dataForElastic);
        $this->assertSame($entity->isactive, $dataForElastic['isactive'], 'Test isactive field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new AddrObjTypesIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new AddrObjTypesIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
