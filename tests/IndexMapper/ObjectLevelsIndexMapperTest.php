<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\ObjectLevelsIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по уровням адресных объектов'.
 *
 * @internal
 */
class ObjectLevelsIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new ObjectLevelsIndexMapper();

        $this->assertSame('object_levels', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new ObjectLevelsIndexMapper();

        $this->assertSame('level', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new ObjectLevelsIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('level', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('isactive', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->level = 'primary_value';

        $mapper = new ObjectLevelsIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->level = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;
        $entity->updatedate = new DateTimeImmutable();
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->isactive = $this->createFakeData()->word;

        $mapper = new ObjectLevelsIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('level', $dataForElastic);
        $this->assertSame((string) $entity->level, $dataForElastic['level'], 'Test level field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
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
        $mapper = new ObjectLevelsIndexMapper();

        $this->assertTrue($mapper->hasProperty('level'));
        $this->assertFalse($mapper->hasProperty('level_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new ObjectLevelsIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
