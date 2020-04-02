<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocumentTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Типы нормативных документов'.
 */
class NormativeDocumentTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new NormativeDocumentTypeIndexMapper();

        $this->assertSame('normativedocumenttype', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new NormativeDocumentTypeIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('ndtypeid', $map['_doc']['properties']);
        $this->assertArrayHasKey('name', $map['_doc']['properties']);
    }
}
