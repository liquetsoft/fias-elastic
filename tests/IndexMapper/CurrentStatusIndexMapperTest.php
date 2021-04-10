<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CurrentStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Статус актуальности КЛАДР 4.0'.
 *
 * @internal
 */
class CurrentStatusIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('currentstatus', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('curentstid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new CurrentStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('curentstid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->curentstid = 'primary_value';

        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->curentstid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new CurrentStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('curentstid', $dataForElastic);
        $this->assertSame((string) $entity->curentstid, $dataForElastic['curentstid'], 'Test curentstid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('curentstid'));
        $this->assertFalse($mapper->hasProperty('curentstid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new CurrentStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
