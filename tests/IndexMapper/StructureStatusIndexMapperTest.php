<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\StructureStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Признак строения'.
 *
 * @internal
 */
class StructureStatusIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('structurestatus', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('strstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new StructureStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('strstatid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->strstatid = 'primary_value';

        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->strstatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new StructureStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('strstatid', $dataForElastic);
        $this->assertSame((string) $entity->strstatid, $dataForElastic['strstatid'], 'Test strstatid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('strstatid'));
        $this->assertFalse($mapper->hasProperty('strstatid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new StructureStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
