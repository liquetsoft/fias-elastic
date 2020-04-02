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

    public function testGetMap()
    {
        $mapper = new FlatTypeIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('fltypeid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
        $this->assertArrayHasKey('shortname', $map['_doc']['properties']);
    }
}
