<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\RoomTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень типов комнат'.
 */
class RoomTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('roomtype', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new RoomTypeIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('rmtypeid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
        $this->assertArrayHasKey('shortname', $map['_doc']['properties']);
    }
}
