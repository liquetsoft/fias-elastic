<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\HouseStateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

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

    public function testGetMap()
    {
        $mapper = new HouseStateStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('housestid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
