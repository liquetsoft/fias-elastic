<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\RoomTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень типов комнат'.
 */
class RoomTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('roomtype', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('rmtypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new RoomTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('rmtypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->rmtypeid = 'primary_value';

        $mapper = new RoomTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
