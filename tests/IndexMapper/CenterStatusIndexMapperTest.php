<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CenterStatusIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Статус центра'.
 *
 * @internal
 */
class CenterStatusIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('centerstatus', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('centerstid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new CenterStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('centerstid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->centerstid = 'primary_value';

        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->centerstid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new CenterStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('centerstid', $dataForElastic);
        $this->assertSame((string) $entity->centerstid, $dataForElastic['centerstid'], 'Test centerstid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertTrue($mapper->hasProperty('centerstid'));
        $this->assertFalse($mapper->hasProperty('centerstid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new CenterStatusIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
