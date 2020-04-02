<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocumentIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования'.
 */
class NormativeDocumentIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new NormativeDocumentIndexMapper();

        $this->assertSame('normativedocument', $mapper->getName());
    }

    public function testGetMap()
    {
        $mapper = new NormativeDocumentIndexMapper();
        $map = $mapper->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('_doc', $map);
        $this->assertArrayHasKey('properties', $map['_doc']);
        $this->assertArrayHasKey('normdocid', $map['_doc']['properties']);
        $this->assertArrayHasKey('docname', $map['_doc']['properties']);
        $this->assertArrayHasKey('docdate', $map['_doc']['properties']);
        $this->assertArrayHasKey('docnum', $map['_doc']['properties']);
        $this->assertArrayHasKey('doctype', $map['_doc']['properties']);
    }
}
