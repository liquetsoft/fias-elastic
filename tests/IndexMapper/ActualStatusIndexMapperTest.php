<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\ActualStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

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

    public function testGetPrimaryName()
    {
        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('actstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new ActualStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('actstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->actstatid = 'primary_value';

        $mapper = new ActualStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
