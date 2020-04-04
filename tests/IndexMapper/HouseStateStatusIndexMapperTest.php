<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\HouseStateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень возможных состояний объектов недвижимости'.
 */
class HouseStateStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('housestatestatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('housestid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new HouseStateStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('housestid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->housestid = 'primary_value';

        $mapper = new HouseStateStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
