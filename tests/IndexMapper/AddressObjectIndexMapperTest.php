<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\AddressObjectIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Реестр адресообразующих элементов'.
 */
class AddressObjectIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new AddressObjectIndexMapper();

        $this->assertSame('addressobject', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new AddressObjectIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('aoid', $map['_doc']['properties']);
        $this->assertArrayHasKey('aoguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('parentguid', $map['_doc']['properties']);
        $this->assertArrayHasKey('previd', $map['_doc']['properties']);
        $this->assertArrayHasKey('nextid', $map['_doc']['properties']);
        $this->assertArrayHasKey('code', $map['_doc']['properties']);
        $this->assertArrayHasKey('formalname', $map['_doc']['properties']);
        $this->assertArrayHasKey('offname', $map['_doc']['properties']);
        $this->assertArrayHasKey('shortname', $map['_doc']['properties']);
        $this->assertArrayHasKey('aolevel', $map['_doc']['properties']);
        $this->assertArrayHasKey('regioncode', $map['_doc']['properties']);
        $this->assertArrayHasKey('areacode', $map['_doc']['properties']);
        $this->assertArrayHasKey('autocode', $map['_doc']['properties']);
        $this->assertArrayHasKey('citycode', $map['_doc']['properties']);
        $this->assertArrayHasKey('ctarcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('placecode', $map['_doc']['properties']);
        $this->assertArrayHasKey('plancode', $map['_doc']['properties']);
        $this->assertArrayHasKey('streetcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('extrcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('sextcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('plaincode', $map['_doc']['properties']);
        $this->assertArrayHasKey('currstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('actstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('livestatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('centstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('operstatus', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsfl', $map['_doc']['properties']);
        $this->assertArrayHasKey('ifnsul', $map['_doc']['properties']);
        $this->assertArrayHasKey('terrifnsfl', $map['_doc']['properties']);
        $this->assertArrayHasKey('terrifnsul', $map['_doc']['properties']);
        $this->assertArrayHasKey('okato', $map['_doc']['properties']);
        $this->assertArrayHasKey('oktmo', $map['_doc']['properties']);
        $this->assertArrayHasKey('postalcode', $map['_doc']['properties']);
        $this->assertArrayHasKey('startdate', $map['_doc']['properties']);
        $this->assertArrayHasKey('enddate', $map['_doc']['properties']);
        $this->assertArrayHasKey('updatedate', $map['_doc']['properties']);
        $this->assertArrayHasKey('divtype', $map['_doc']['properties']);
    }
}
