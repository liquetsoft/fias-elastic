<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\ActualStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Статус актуальности ФИАС'.
 *
 * @internal
 */
class ActualStatusIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('actualstatus', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('actstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new ActualStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('actstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->actstatid = 'primary_value';

        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->actstatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new ActualStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('actstatid', $dataForElastic);
        $this->assertSame((string) $entity->actstatid, $dataForElastic['actstatid'], 'Test actstatid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new ActualStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('actstatid'));
        $this->assertFalse($mapper->hasProperty('actstatid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new ActualStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
