<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\RoomIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения о помещениях (квартирах, офисах, комнатах и т.д.)'.
 */
class RoomIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('room', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new RoomIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('roomid', $map['_doc']['properties']);
        $this->assertArrayHasKey('roomguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('houseguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('regioncode', $map['_doc']['properties']);
        $this->assertArrayHasKey('flatnumber', $map['_doc']['properties']);
        $this->assertArrayHasKey('flattype', $map['_doc']['properties']);
        $this->assertArrayHasKey('postalcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('startdate', $map['_doc']['properties']);
        $this->assertArrayHasKey('enddate', $map['_doc']['properties']);
        $this->assertArrayHasKey('updatedate', $map['_doc']['properties']);
        $this->assertArrayHasKey('operstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('livestatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('normdoc', $map['_doc']['properties']);
    }
}
