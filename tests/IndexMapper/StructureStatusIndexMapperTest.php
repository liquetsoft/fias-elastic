<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\StructureStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень видов строений'.
 */
class StructureStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('structurestatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('strstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new StructureStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('strstatid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->strstatid = 'primary_value';

        $mapper = new StructureStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
