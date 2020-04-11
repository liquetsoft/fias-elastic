<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\HouseStateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень возможных состояний объектов недвижимости'.
 */
class HouseStateStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('housestatestatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('housestid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new HouseStateStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('housestid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->housestid = 'primary_value';

        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->housestid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new HouseStateStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('housestid', $dataForElastic);
        $this->assertSame((string) $entity->housestid, $dataForElastic['housestid'], 'Test housestid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty()
    {
        $mapper = new HouseStateStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('housestid'));
        $this->assertFalse($mapper->hasProperty('housestid_tested_value'));
    }

    public function testQuery()
    {
        $mapper = new HouseStateStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
