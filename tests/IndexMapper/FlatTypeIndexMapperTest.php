<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\FlatTypeIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Тип помещения'.
 *
 * @internal
 */
class FlatTypeIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('flattype', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('fltypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new FlatTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('fltypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->fltypeid = 'primary_value';

        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->fltypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new FlatTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('fltypeid', $dataForElastic);
        $this->assertSame((string) $entity->fltypeid, $dataForElastic['fltypeid'], 'Test fltypeid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertTrue($mapper->hasProperty('fltypeid'));
        $this->assertFalse($mapper->hasProperty('fltypeid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new FlatTypeIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
