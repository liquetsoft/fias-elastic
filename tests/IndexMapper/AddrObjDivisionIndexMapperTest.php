<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\AddrObjDivisionIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по операциям переподчинения'.
 *
 * @internal
 */
class AddrObjDivisionIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new AddrObjDivisionIndexMapper();

        $this->assertSame('addr_obj_division', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new AddrObjDivisionIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new AddrObjDivisionIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('parentid', $map);
        $this->assertArrayHasKey('childid', $map);
        $this->assertArrayHasKey('changeid', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = 'primary_value';

        $mapper = new AddrObjDivisionIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->parentid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->childid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new AddrObjDivisionIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('parentid', $dataForElastic);
        $this->assertSame($entity->parentid, $dataForElastic['parentid'], 'Test parentid field conversion.');
        $this->assertArrayHasKey('childid', $dataForElastic);
        $this->assertSame($entity->childid, $dataForElastic['childid'], 'Test childid field conversion.');
        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame($entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new AddrObjDivisionIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new AddrObjDivisionIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
