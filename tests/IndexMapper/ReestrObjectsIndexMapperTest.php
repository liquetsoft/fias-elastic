<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\ReestrObjectsIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения об адресном элементе в части его идентификаторов'.
 *
 * @internal
 */
class ReestrObjectsIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new ReestrObjectsIndexMapper();

        $this->assertSame('reestr_objects', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new ReestrObjectsIndexMapper();

        $this->assertSame('objectid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new ReestrObjectsIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('objectid', $map);
        $this->assertArrayHasKey('createdate', $map);
        $this->assertArrayHasKey('changeid', $map);
        $this->assertArrayHasKey('levelid', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('objectguid', $map);
        $this->assertArrayHasKey('isactive', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->objectid = 'primary_value';

        $mapper = new ReestrObjectsIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->objectid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->createdate = new DateTimeImmutable();
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->levelid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->updatedate = new DateTimeImmutable();
        $entity->objectguid = $this->createFakeData()->word;
        $entity->isactive = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new ReestrObjectsIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('objectid', $dataForElastic);
        $this->assertSame((string) $entity->objectid, $dataForElastic['objectid'], 'Test objectid field conversion.');
        $this->assertArrayHasKey('createdate', $dataForElastic);
        $this->assertSame($entity->createdate->format('Y-m-d\TH:i:s'), $dataForElastic['createdate'], 'Test createdate field conversion.');
        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame($entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
        $this->assertArrayHasKey('levelid', $dataForElastic);
        $this->assertSame($entity->levelid, $dataForElastic['levelid'], 'Test levelid field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('objectguid', $dataForElastic);
        $this->assertSame($entity->objectguid, $dataForElastic['objectguid'], 'Test objectguid field conversion.');
        $this->assertArrayHasKey('isactive', $dataForElastic);
        $this->assertSame($entity->isactive, $dataForElastic['isactive'], 'Test isactive field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new ReestrObjectsIndexMapper();

        $this->assertTrue($mapper->hasProperty('objectid'));
        $this->assertFalse($mapper->hasProperty('objectid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new ReestrObjectsIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
