<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\SteadIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения о земельных участках'.
 */
class SteadIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new SteadIndexMapper();

        $this->assertSame('stead', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new SteadIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('steadguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('number', $map['_doc']['properties']);
        $this->assertArrayHasKey('regioncode', $map['_doc']['properties']);
        $this->assertArrayHasKey('postalcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsfl', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsul', $map['_doc']['properties']);
        $this->assertArrayHasKey('okato', $map['_doc']['properties']);
        $this->assertArrayHasKey('oktmo', $map['_doc']['properties']);
        $this->assertArrayHasKey('parentguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('steadid', $map['_doc']['properties']);
        $this->assertArrayHasKey('operstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('startdate', $map['_doc']['properties']);
        $this->assertArrayHasKey('enddate', $map['_doc']['properties']);
        $this->assertArrayHasKey('updatedate', $map['_doc']['properties']);
        $this->assertArrayHasKey('livestatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('divtype', $map['_doc']['properties']);
        $this->assertArrayHasKey('normdoc', $map['_doc']['properties']);
    }
}
