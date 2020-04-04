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

    public function testGetPrimaryName()
    {
        $mapper = new RoomIndexMapper();

        $this->assertSame('roomid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new RoomIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('roomid', $map);
        $this->assertArrayHasKey('roomguid', $map);
        $this->assertArrayHasKey('houseguid', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('flatnumber', $map);
        $this->assertArrayHasKey('flattype', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('normdoc', $map);
    }
}
