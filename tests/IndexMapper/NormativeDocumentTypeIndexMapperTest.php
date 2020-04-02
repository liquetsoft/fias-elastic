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

    public function testGetMappingProperties()
    {
        $mapper = new NormativeDocumentTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('ndtypeid', $map);
        $this->assertArrayHasKey('name', $map);
    }
}
