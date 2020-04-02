<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\CenterStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень возможных статусов (центров) адресных объектов административных единиц'.
 */
class CenterStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new CenterStatusIndexMapper();

        $this->assertSame('centerstatus', $mapper->getName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new CenterStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('centerstid', $map);
        $this->assertArrayHasKey('name', $map);
    }
}