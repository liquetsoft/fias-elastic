<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\StructureStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень видов строений'.
 */
class StructureStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('structurestatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new StructureStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('strstatid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
        $this->assertArrayHasKey('shortname', $map['_doc']['properties']);
    }
}
