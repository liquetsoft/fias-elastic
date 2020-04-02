<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CurrentStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0'.
 */
class CurrentStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('currentstatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new CurrentStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('curentstid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
