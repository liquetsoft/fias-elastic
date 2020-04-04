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

    public function testGetPrimaryName()
    {
        $mapper = new AddressObjectIndexMapper();

        $this->assertSame('aoid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new AddressObjectIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('aoid', $map);
        $this->assertArrayHasKey('aoguid', $map);
        $this->assertArrayHasKey('parentguid', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('code', $map);
        $this->assertArrayHasKey('formalname', $map);
        $this->assertArrayHasKey('offname', $map);
        $this->assertArrayHasKey('shortname', $map);
        $this->assertArrayHasKey('aolevel', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('areacode', $map);
        $this->assertArrayHasKey('autocode', $map);
        $this->assertArrayHasKey('citycode', $map);
        $this->assertArrayHasKey('ctarcode', $map);
        $this->assertArrayHasKey('placecode', $map);
        $this->assertArrayHasKey('plancode', $map);
        $this->assertArrayHasKey('streetcode', $map);
        $this->assertArrayHasKey('extrcode', $map);
        $this->assertArrayHasKey('sextcode', $map);
        $this->assertArrayHasKey('plaincode', $map);
        $this->assertArrayHasKey('currstatus', $map);
        $this->assertArrayHasKey('actstatus', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('centstatus', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('terrifnsfl', $map);
        $this->assertArrayHasKey('terrifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('divtype', $map);
    }
}
