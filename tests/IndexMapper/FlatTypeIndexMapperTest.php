<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\FlatTypeIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень типов помещения или офиса'.
 */
class FlatTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('flattype', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('fltypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new FlatTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('fltypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testExtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->fltypeid = 'primary_value';

        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->fltypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new FlatTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('fltypeid', $dataForElastic);
        $this->assertSame((string) $entity->fltypeid, $dataForElastic['fltypeid'], 'Test fltypeid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
    }

    public function testHasProperty()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertTrue($mapper->hasProperty('fltypeid'));
        $this->assertFalse($mapper->hasProperty('fltypeid_tested_value'));
    }

    public function testQuery()
    {
        $mapper = new FlatTypeIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
