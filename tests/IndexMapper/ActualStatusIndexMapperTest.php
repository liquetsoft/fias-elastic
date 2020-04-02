<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\ActualStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень статусов актуальности записи адресного элемента по ФИАС'.
 */
class ActualStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('actualstatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new ActualStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('actstatid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
