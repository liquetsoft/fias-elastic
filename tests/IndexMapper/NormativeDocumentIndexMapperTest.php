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

    public function testGetPrimaryName()
    {
        $mapper = new NormativeDocumentIndexMapper();

        $this->assertSame('normdocid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new NormativeDocumentIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('normdocid', $map);
        $this->assertArrayHasKey('docname', $map);
        $this->assertArrayHasKey('docdate', $map);
        $this->assertArrayHasKey('docnum', $map);
        $this->assertArrayHasKey('doctype', $map);
    }
}
