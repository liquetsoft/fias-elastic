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

    public function testGetPrimaryName()
    {
        $mapper = new OperationStatusIndexMapper();

        $this->assertSame('operstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new OperationStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('operstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }
}
