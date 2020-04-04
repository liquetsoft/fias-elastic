<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\EstateStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

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

    public function testGetPrimaryName()
    {
        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('eststatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new EstateStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('eststatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->eststatid = 'primary_value';

        $mapper = new EstateStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }
}
