<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\AdmHierarchyIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по иерархии в административном делении'.
 *
 * @internal
 */
class AdmHierarchyIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new AdmHierarchyIndexMapper();

        $this->assertSame('adm_hierarchy', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new AdmHierarchyIndexMapper();

        $this->assertSame('id', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new AdmHierarchyIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('id', $map);
        $this->assertArrayHasKey('objectid', $map);
        $this->assertArrayHasKey('parentobjid', $map);
        $this->assertArrayHasKey('changeid', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('areacode', $map);
        $this->assertArrayHasKey('citycode', $map);
        $this->assertArrayHasKey('placecode', $map);
        $this->assertArrayHasKey('plancode', $map);
        $this->assertArrayHasKey('streetcode', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('isactive', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = 'primary_value';

        $mapper = new AdmHierarchyIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->id = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->parentobjid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->regioncode = $this->createFakeData()->word;
        $entity->areacode = $this->createFakeData()->word;
        $entity->citycode = $this->createFakeData()->word;
        $entity->placecode = $this->createFakeData()->word;
        $entity->plancode = $this->createFakeData()->word;
        $entity->streetcode = $this->createFakeData()->word;
        $entity->previd = $this->createFakeData()->numberBetween(1, 100000);
        $entity->nextid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->updatedate = new DateTimeImmutable();
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->isactive = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new AdmHierarchyIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('id', $dataForElastic);
        $this->assertSame((string) $entity->id, $dataForElastic['id'], 'Test id field conversion.');
        $this->assertArrayHasKey('objectid', $dataForElastic);
        $this->assertSame($entity->objectid, $dataForElastic['objectid'], 'Test objectid field conversion.');
        $this->assertArrayHasKey('parentobjid', $dataForElastic);
        $this->assertSame($entity->parentobjid, $dataForElastic['parentobjid'], 'Test parentobjid field conversion.');
        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame($entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode'], 'Test regioncode field conversion.');
        $this->assertArrayHasKey('areacode', $dataForElastic);
        $this->assertSame($entity->areacode, $dataForElastic['areacode'], 'Test areacode field conversion.');
        $this->assertArrayHasKey('citycode', $dataForElastic);
        $this->assertSame($entity->citycode, $dataForElastic['citycode'], 'Test citycode field conversion.');
        $this->assertArrayHasKey('placecode', $dataForElastic);
        $this->assertSame($entity->placecode, $dataForElastic['placecode'], 'Test placecode field conversion.');
        $this->assertArrayHasKey('plancode', $dataForElastic);
        $this->assertSame($entity->plancode, $dataForElastic['plancode'], 'Test plancode field conversion.');
        $this->assertArrayHasKey('streetcode', $dataForElastic);
        $this->assertSame($entity->streetcode, $dataForElastic['streetcode'], 'Test streetcode field conversion.');
        $this->assertArrayHasKey('previd', $dataForElastic);
        $this->assertSame($entity->previd, $dataForElastic['previd'], 'Test previd field conversion.');
        $this->assertArrayHasKey('nextid', $dataForElastic);
        $this->assertSame($entity->nextid, $dataForElastic['nextid'], 'Test nextid field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('isactive', $dataForElastic);
        $this->assertSame($entity->isactive, $dataForElastic['isactive'], 'Test isactive field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new AdmHierarchyIndexMapper();

        $this->assertTrue($mapper->hasProperty('id'));
        $this->assertFalse($mapper->hasProperty('id_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new AdmHierarchyIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
