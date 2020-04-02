<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\AddressObjectTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации'.
 */
class AddressObjectTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new AddressObjectTypeIndexMapper();

        $this->assertSame('addressobjecttype', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new AddressObjectTypeIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('kodtst', $map['_doc']['properties']);
        $this->assertArrayHasKey('level', $map['_doc']['properties']);
        $this->assertArrayHasKey('socrname', $map['_doc']['properties']);
        $this->assertArrayHasKey('scname', $map['_doc']['properties']);
    }
}
