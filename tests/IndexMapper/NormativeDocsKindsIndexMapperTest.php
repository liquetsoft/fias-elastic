<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocsKindsIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения по видам нормативных документов'.
 *
 * @internal
 */
class NormativeDocsKindsIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new NormativeDocsKindsIndexMapper();

        $this->assertSame('normative_docs_kinds', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new NormativeDocsKindsIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new NormativeDocsKindsIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = 'primary_value';

        $mapper = new NormativeDocsKindsIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new NormativeDocsKindsIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new NormativeDocsKindsIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new NormativeDocsKindsIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
