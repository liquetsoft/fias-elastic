<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTime;
use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocumentIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

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
        $this->assertArrayHasKey('docimgid', $map);
    }

    public function testExtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->normdocid = 'primary_value';

        $mapper = new NormativeDocumentIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->normdocid = $this->createFakeData()->word;
        $entity->docname = $this->createFakeData()->word;
        $entity->docdate = new DateTime();
        $entity->docnum = $this->createFakeData()->word;
        $entity->doctype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->docimgid = $this->createFakeData()->word;

        $mapper = new NormativeDocumentIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('normdocid', $dataForElastic);
        $this->assertSame((string) $entity->normdocid, $dataForElastic['normdocid'], 'Test normdocid field conversion.');
        $this->assertArrayHasKey('docname', $dataForElastic);
        $this->assertSame($entity->docname, $dataForElastic['docname'], 'Test docname field conversion.');
        $this->assertArrayHasKey('docdate', $dataForElastic);
        $this->assertSame($entity->docdate->format('Y-m-d\TH:i:s'), $dataForElastic['docdate'], 'Test docdate field conversion.');
        $this->assertArrayHasKey('docnum', $dataForElastic);
        $this->assertSame($entity->docnum, $dataForElastic['docnum'], 'Test docnum field conversion.');
        $this->assertArrayHasKey('doctype', $dataForElastic);
        $this->assertSame($entity->doctype, $dataForElastic['doctype'], 'Test doctype field conversion.');
        $this->assertArrayHasKey('docimgid', $dataForElastic);
        $this->assertSame($entity->docimgid, $dataForElastic['docimgid'], 'Test docimgid field conversion.');
    }

    public function testHasProperty()
    {
        $mapper = new NormativeDocumentIndexMapper();

        $this->assertTrue($mapper->hasProperty('normdocid'));
        $this->assertFalse($mapper->hasProperty('normdocid_tested_value'));
    }

    public function testQuery()
    {
        $mapper = new NormativeDocumentIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
