<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\IntervalStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень возможных значений интервалов домов (обычный, четный, нечетный)'.
 */
class IntervalStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new IntervalStatusIndexMapper();

        $this->assertSame('intervalstatus', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new IntervalStatusIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('intvstatid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
