<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CenterStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень возможных статусов (центров) адресных объектов административных единиц'.
 */
class CenterStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('centerstatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('centerstid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new CenterStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('centerstid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->centerstid = 'primary_value';

        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->centerstid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new CenterStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('centerstid', $dataForElastic);
        $this->assertSame($entity->centerstid, $dataForElastic['centerstid']);
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name']);
    }
}
