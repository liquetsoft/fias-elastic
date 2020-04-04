<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\FlatTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень типов помещения или офиса'.
 */
class FlatTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('flattype', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('fltypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new FlatTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('fltypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }
}
