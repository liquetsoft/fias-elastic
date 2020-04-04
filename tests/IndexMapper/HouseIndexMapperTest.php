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

    public function testGetPrimaryName()
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('houseid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new HouseIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('houseid', $map);
        $this->assertArrayHasKey('houseguid', $map);
        $this->assertArrayHasKey('aoguid', $map);
        $this->assertArrayHasKey('housenum', $map);
        $this->assertArrayHasKey('strstatus', $map);
        $this->assertArrayHasKey('eststatus', $map);
        $this->assertArrayHasKey('statstatus', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('counter', $map);
        $this->assertArrayHasKey('divtype', $map);
    }
}
