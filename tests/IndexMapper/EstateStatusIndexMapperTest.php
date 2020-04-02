<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\EstateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень возможных видов владений'.
 */
class EstateStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('estatestatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new EstateStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('eststatid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
