<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\OperationStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень кодов операций над адресными объектами'.
 */
class OperationStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operationstatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new OperationStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('operstatid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
