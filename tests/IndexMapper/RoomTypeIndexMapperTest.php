<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\RoomTypeIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Тип комнаты'.
 *
 * @internal
 */
class RoomTypeIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('roomtype', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('rmtypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new RoomTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('rmtypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->rmtypeid = 'primary_value';

        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->rmtypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new RoomTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('rmtypeid', $dataForElastic);
        $this->assertSame((string) $entity->rmtypeid, $dataForElastic['rmtypeid'], 'Test rmtypeid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname'], 'Test shortname field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertTrue($mapper->hasProperty('rmtypeid'));
        $this->assertFalse($mapper->hasProperty('rmtypeid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new RoomTypeIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
