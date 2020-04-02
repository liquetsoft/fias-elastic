<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\HouseIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Элементы адреса, идентифицирующие адресуемые объекты'.
 */
class HouseIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('house', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new HouseIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('houseid', $map['_doc']['properties']);
        $this->assertArrayHasKey('houseguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('aoguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('housenum', $map['_doc']['properties']);
        $this->assertArrayHasKey('strstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('eststatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('statstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsfl', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsul', $map['_doc']['properties']);
        $this->assertArrayHasKey('okato', $map['_doc']['properties']);
        $this->assertArrayHasKey('oktmo', $map['_doc']['properties']);
        $this->assertArrayHasKey('postalcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('startdate', $map['_doc']['properties']);
        $this->assertArrayHasKey('enddate', $map['_doc']['properties']);
        $this->assertArrayHasKey('updatedate', $map['_doc']['properties']);
        $this->assertArrayHasKey('counter', $map['_doc']['properties']);
        $this->assertArrayHasKey('divtype', $map['_doc']['properties']);
    }
}
