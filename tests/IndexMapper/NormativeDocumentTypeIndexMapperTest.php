<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocumentTypeIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Тип нормативного документа'.
 *
 * @internal
 */
class NormativeDocumentTypeIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new NormativeDocumentTypeIndexMapper();

        $this->assertSame('normativedocumenttype', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new NormativeDocumentTypeIndexMapper();

        $this->assertSame('ndtypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new NormativeDocumentTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('ndtypeid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->ndtypeid = 'primary_value';

        $mapper = new NormativeDocumentTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->ndtypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new NormativeDocumentTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('ndtypeid', $dataForElastic);
        $this->assertSame((string) $entity->ndtypeid, $dataForElastic['ndtypeid'], 'Test ndtypeid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new NormativeDocumentTypeIndexMapper();

        $this->assertTrue($mapper->hasProperty('ndtypeid'));
        $this->assertFalse($mapper->hasProperty('ndtypeid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new NormativeDocumentTypeIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
