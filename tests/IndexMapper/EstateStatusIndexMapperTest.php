<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\EstateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Признак владения'.
 */
class EstateStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('estatestatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('eststatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new EstateStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('eststatid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testExtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->eststatid = 'primary_value';

        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->eststatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new EstateStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('eststatid', $dataForElastic);
        $this->assertSame((string) $entity->eststatid, $dataForElastic['eststatid'], 'Test eststatid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
    }

    public function testHasProperty()
    {
        $mapper = new EstateStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('eststatid'));
        $this->assertFalse($mapper->hasProperty('eststatid_tested_value'));
    }

    public function testQuery()
    {
        $mapper = new EstateStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
