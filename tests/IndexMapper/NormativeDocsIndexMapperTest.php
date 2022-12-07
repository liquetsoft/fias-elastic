<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\NormativeDocsIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для описания индекса сущности 'Сведения о нормативном документе, являющемся основанием присвоения адресному элементу наименования'.
 *
 * @internal
 */
class NormativeDocsIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new NormativeDocsIndexMapper();

        $this->assertSame('normative_docs', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new NormativeDocsIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new NormativeDocsIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('date', $map);
        $this->assertArrayHasKey('number', $map);
        $this->assertArrayHasKey('type', $map);
        $this->assertArrayHasKey('kind', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('orgname', $map);
        $this->assertArrayHasKey('regnum', $map);
        $this->assertArrayHasKey('regdate', $map);
        $this->assertArrayHasKey('accdate', $map);
        $this->assertArrayHasKey('comment', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = 'primary_value';

        $mapper = new NormativeDocsIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new \stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->date = new \DateTimeImmutable();
        $entity->number = $this->createFakeData()->word;
        $entity->type = $this->createFakeData()->numberBetween(1, 100000);
        $entity->kind = $this->createFakeData()->numberBetween(1, 100000);
        $entity->updatedate = new \DateTimeImmutable();
        $entity->orgname = $this->createFakeData()->word;
        $entity->regnum = $this->createFakeData()->word;
        $entity->regdate = new \DateTimeImmutable();
        $entity->accdate = new \DateTimeImmutable();
        $entity->comment = $this->createFakeData()->word;

        $mapper = new NormativeDocsIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
        $this->assertArrayHasKey('date', $dataForElastic);
        $this->assertSame($entity->date->format('Y-m-d\TH:i:s'), $dataForElastic['date'], 'Test date field conversion.');
        $this->assertArrayHasKey('number', $dataForElastic);
        $this->assertSame($entity->number, $dataForElastic['number'], 'Test number field conversion.');
        $this->assertArrayHasKey('type', $dataForElastic);
        $this->assertSame($entity->type, $dataForElastic['type'], 'Test type field conversion.');
        $this->assertArrayHasKey('kind', $dataForElastic);
        $this->assertSame($entity->kind, $dataForElastic['kind'], 'Test kind field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('orgname', $dataForElastic);
        $this->assertSame($entity->orgname, $dataForElastic['orgname'], 'Test orgname field conversion.');
        $this->assertArrayHasKey('regnum', $dataForElastic);
        $this->assertSame($entity->regnum, $dataForElastic['regnum'], 'Test regnum field conversion.');
        $this->assertArrayHasKey('regdate', $dataForElastic);
        $this->assertSame($entity->regdate->format('Y-m-d\TH:i:s'), $dataForElastic['regdate'], 'Test regdate field conversion.');
        $this->assertArrayHasKey('accdate', $dataForElastic);
        $this->assertSame($entity->accdate->format('Y-m-d\TH:i:s'), $dataForElastic['accdate'], 'Test accdate field conversion.');
        $this->assertArrayHasKey('comment', $dataForElastic);
        $this->assertSame($entity->comment, $dataForElastic['comment'], 'Test comment field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new NormativeDocsIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new NormativeDocsIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
