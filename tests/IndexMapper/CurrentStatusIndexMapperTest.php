<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CurrentStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0'.
 */
class CurrentStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('currentstatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('curentstid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new CurrentStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('curentstid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->curentstid = 'primary_value';

        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->curentstid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new CurrentStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('curentstid', $dataForElastic);
        $this->assertSame($entity->curentstid, $dataForElastic['curentstid']);
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name']);
    }
}
