<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\OperationStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Статус действия'.
 *
 * @internal
 */
class OperationStatusIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operationstatus', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new OperationStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('operstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->operstatid = 'primary_value';

        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->operstatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new OperationStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('operstatid', $dataForElastic);
        $this->assertSame((string) $entity->operstatid, $dataForElastic['operstatid'], 'Test operstatid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('operstatid'));
        $this->assertFalse($mapper->hasProperty('operstatid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new OperationStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
