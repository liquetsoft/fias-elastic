<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\OperationStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень кодов операций над адресными объектами'.
 */
class OperationStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operationstatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new OperationStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('operstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->operstatid = 'primary_value';

        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->operstatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new OperationStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('operstatid', $dataForElastic);
        $this->assertSame($entity->operstatid, $dataForElastic['operstatid']);
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name']);
    }
}
