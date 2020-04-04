<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\SteadIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

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

    public function testGetPrimaryName()
    {
        $mapper = new SteadIndexMapper();

        $this->assertSame('steadguid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new SteadIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('steadguid', $map);
        $this->assertArrayHasKey('number', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('parentguid', $map);
        $this->assertArrayHasKey('steadid', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('divtype', $map);
        $this->assertArrayHasKey('normdoc', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->steadguid = 'primary_value';

        $mapper = new SteadIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
