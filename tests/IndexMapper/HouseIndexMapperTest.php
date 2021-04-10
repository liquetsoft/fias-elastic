<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\HouseIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по номерам домов улиц городов и населенных пунктов'.
 *
 * @internal
 */
class HouseIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('house', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('houseid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new HouseIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('houseid', $map);
        $this->assertArrayHasKey('houseguid', $map);
        $this->assertArrayHasKey('aoguid', $map);
        $this->assertArrayHasKey('housenum', $map);
        $this->assertArrayHasKey('strstatus', $map);
        $this->assertArrayHasKey('eststatus', $map);
        $this->assertArrayHasKey('statstatus', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('counter', $map);
        $this->assertArrayHasKey('divtype', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('terrifnsfl', $map);
        $this->assertArrayHasKey('terrifnsul', $map);
        $this->assertArrayHasKey('buildnum', $map);
        $this->assertArrayHasKey('strucnum', $map);
        $this->assertArrayHasKey('normdoc', $map);
        $this->assertArrayHasKey('cadnum', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->houseid = 'primary_value';

        $mapper = new HouseIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->houseid = $this->createFakeData()->word;
        $entity->houseguid = $this->createFakeData()->word;
        $entity->aoguid = $this->createFakeData()->word;
        $entity->housenum = $this->createFakeData()->word;
        $entity->strstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->eststatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->statstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->ifnsfl = $this->createFakeData()->word;
        $entity->ifnsul = $this->createFakeData()->word;
        $entity->okato = $this->createFakeData()->word;
        $entity->oktmo = $this->createFakeData()->word;
        $entity->postalcode = $this->createFakeData()->word;
        $entity->startdate = new DateTimeImmutable();
        $entity->enddate = new DateTimeImmutable();
        $entity->updatedate = new DateTimeImmutable();
        $entity->counter = $this->createFakeData()->numberBetween(1, 100000);
        $entity->divtype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->regioncode = $this->createFakeData()->word;
        $entity->terrifnsfl = $this->createFakeData()->word;
        $entity->terrifnsul = $this->createFakeData()->word;
        $entity->buildnum = $this->createFakeData()->word;
        $entity->strucnum = $this->createFakeData()->word;
        $entity->normdoc = $this->createFakeData()->word;
        $entity->cadnum = $this->createFakeData()->word;

        $mapper = new HouseIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('houseid', $dataForElastic);
        $this->assertSame((string) $entity->houseid, $dataForElastic['houseid'], 'Test houseid field conversion.');
        $this->assertArrayHasKey('houseguid', $dataForElastic);
        $this->assertSame($entity->houseguid, $dataForElastic['houseguid'], 'Test houseguid field conversion.');
        $this->assertArrayHasKey('aoguid', $dataForElastic);
        $this->assertSame($entity->aoguid, $dataForElastic['aoguid'], 'Test aoguid field conversion.');
        $this->assertArrayHasKey('housenum', $dataForElastic);
        $this->assertSame($entity->housenum, $dataForElastic['housenum'], 'Test housenum field conversion.');
        $this->assertArrayHasKey('strstatus', $dataForElastic);
        $this->assertSame($entity->strstatus, $dataForElastic['strstatus'], 'Test strstatus field conversion.');
        $this->assertArrayHasKey('eststatus', $dataForElastic);
        $this->assertSame($entity->eststatus, $dataForElastic['eststatus'], 'Test eststatus field conversion.');
        $this->assertArrayHasKey('statstatus', $dataForElastic);
        $this->assertSame($entity->statstatus, $dataForElastic['statstatus'], 'Test statstatus field conversion.');
        $this->assertArrayHasKey('ifnsfl', $dataForElastic);
        $this->assertSame($entity->ifnsfl, $dataForElastic['ifnsfl'], 'Test ifnsfl field conversion.');
        $this->assertArrayHasKey('ifnsul', $dataForElastic);
        $this->assertSame($entity->ifnsul, $dataForElastic['ifnsul'], 'Test ifnsul field conversion.');
        $this->assertArrayHasKey('okato', $dataForElastic);
        $this->assertSame($entity->okato, $dataForElastic['okato'], 'Test okato field conversion.');
        $this->assertArrayHasKey('oktmo', $dataForElastic);
        $this->assertSame($entity->oktmo, $dataForElastic['oktmo'], 'Test oktmo field conversion.');
        $this->assertArrayHasKey('postalcode', $dataForElastic);
        $this->assertSame($entity->postalcode, $dataForElastic['postalcode'], 'Test postalcode field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('counter', $dataForElastic);
        $this->assertSame($entity->counter, $dataForElastic['counter'], 'Test counter field conversion.');
        $this->assertArrayHasKey('divtype', $dataForElastic);
        $this->assertSame($entity->divtype, $dataForElastic['divtype'], 'Test divtype field conversion.');
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode'], 'Test regioncode field conversion.');
        $this->assertArrayHasKey('terrifnsfl', $dataForElastic);
        $this->assertSame($entity->terrifnsfl, $dataForElastic['terrifnsfl'], 'Test terrifnsfl field conversion.');
        $this->assertArrayHasKey('terrifnsul', $dataForElastic);
        $this->assertSame($entity->terrifnsul, $dataForElastic['terrifnsul'], 'Test terrifnsul field conversion.');
        $this->assertArrayHasKey('buildnum', $dataForElastic);
        $this->assertSame($entity->buildnum, $dataForElastic['buildnum'], 'Test buildnum field conversion.');
        $this->assertArrayHasKey('strucnum', $dataForElastic);
        $this->assertSame($entity->strucnum, $dataForElastic['strucnum'], 'Test strucnum field conversion.');
        $this->assertArrayHasKey('normdoc', $dataForElastic);
        $this->assertSame($entity->normdoc, $dataForElastic['normdoc'], 'Test normdoc field conversion.');
        $this->assertArrayHasKey('cadnum', $dataForElastic);
        $this->assertSame($entity->cadnum, $dataForElastic['cadnum'], 'Test cadnum field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new HouseIndexMapper();

        $this->assertTrue($mapper->hasProperty('houseid'));
        $this->assertFalse($mapper->hasProperty('houseid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new HouseIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
