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

    public function testGetPrimaryName()
    {
        $mapper = new CurrentStatusIndexMapper();

        $this->assertSame('curentstid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new CurrentStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('curentstid', $map);
        $this->assertArrayHasKey('name', $map);
    }
}
