<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTime;
use Liquetsoft\Fias\Elastic\IndexMapper\SteadIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Классификатор земельных участков'.
 */
class SteadIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new SteadIndexMapper();

        $this->assertSame('stead', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new SteadIndexMapper();

        $this->assertSame('steadid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new SteadIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('steadguid', $map);
        $this->assertArrayHasKey('number', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('parentguid', $map);
        $this->assertArrayHasKey('steadid', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('divtype', $map);
        $this->assertArrayHasKey('normdoc', $map);
        $this->assertArrayHasKey('terrifnsfl', $map);
        $this->assertArrayHasKey('terrifnsul', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('cadnum', $map);
    }

    public function testExtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->steadid = 'primary_value';

        $mapper = new SteadIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->steadguid = $this->createFakeData()->word;
        $entity->number = $this->createFakeData()->word;
        $entity->regioncode = $this->createFakeData()->word;
        $entity->postalcode = $this->createFakeData()->word;
        $entity->ifnsfl = $this->createFakeData()->word;
        $entity->ifnsul = $this->createFakeData()->word;
        $entity->okato = $this->createFakeData()->word;
        $entity->oktmo = $this->createFakeData()->word;
        $entity->parentguid = $this->createFakeData()->word;
        $entity->steadid = $this->createFakeData()->word;
        $entity->operstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->startdate = new DateTime();
        $entity->enddate = new DateTime();
        $entity->updatedate = new DateTime();
        $entity->livestatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->divtype = $this->createFakeData()->numberBetween(1, 100000);
        $entity->normdoc = $this->createFakeData()->word;
        $entity->terrifnsfl = $this->createFakeData()->word;
        $entity->terrifnsul = $this->createFakeData()->word;
        $entity->previd = $this->createFakeData()->word;
        $entity->nextid = $this->createFakeData()->word;
        $entity->cadnum = $this->createFakeData()->word;

        $mapper = new SteadIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('steadguid', $dataForElastic);
        $this->assertSame($entity->steadguid, $dataForElastic['steadguid'], 'Test steadguid field conversion.');
        $this->assertArrayHasKey('number', $dataForElastic);
        $this->assertSame($entity->number, $dataForElastic['number'], 'Test number field conversion.');
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode'], 'Test regioncode field conversion.');
        $this->assertArrayHasKey('postalcode', $dataForElastic);
        $this->assertSame($entity->postalcode, $dataForElastic['postalcode'], 'Test postalcode field conversion.');
        $this->assertArrayHasKey('ifnsfl', $dataForElastic);
        $this->assertSame($entity->ifnsfl, $dataForElastic['ifnsfl'], 'Test ifnsfl field conversion.');
        $this->assertArrayHasKey('ifnsul', $dataForElastic);
        $this->assertSame($entity->ifnsul, $dataForElastic['ifnsul'], 'Test ifnsul field conversion.');
        $this->assertArrayHasKey('okato', $dataForElastic);
        $this->assertSame($entity->okato, $dataForElastic['okato'], 'Test okato field conversion.');
        $this->assertArrayHasKey('oktmo', $dataForElastic);
        $this->assertSame($entity->oktmo, $dataForElastic['oktmo'], 'Test oktmo field conversion.');
        $this->assertArrayHasKey('parentguid', $dataForElastic);
        $this->assertSame($entity->parentguid, $dataForElastic['parentguid'], 'Test parentguid field conversion.');
        $this->assertArrayHasKey('steadid', $dataForElastic);
        $this->assertSame((string) $entity->steadid, $dataForElastic['steadid'], 'Test steadid field conversion.');
        $this->assertArrayHasKey('operstatus', $dataForElastic);
        $this->assertSame($entity->operstatus, $dataForElastic['operstatus'], 'Test operstatus field conversion.');
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate'], 'Test startdate field conversion.');
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate'], 'Test enddate field conversion.');
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate'], 'Test updatedate field conversion.');
        $this->assertArrayHasKey('livestatus', $dataForElastic);
        $this->assertSame($entity->livestatus, $dataForElastic['livestatus'], 'Test livestatus field conversion.');
        $this->assertArrayHasKey('divtype', $dataForElastic);
        $this->assertSame($entity->divtype, $dataForElastic['divtype'], 'Test divtype field conversion.');
        $this->assertArrayHasKey('normdoc', $dataForElastic);
        $this->assertSame($entity->normdoc, $dataForElastic['normdoc'], 'Test normdoc field conversion.');
        $this->assertArrayHasKey('terrifnsfl', $dataForElastic);
        $this->assertSame($entity->terrifnsfl, $dataForElastic['terrifnsfl'], 'Test terrifnsfl field conversion.');
        $this->assertArrayHasKey('terrifnsul', $dataForElastic);
        $this->assertSame($entity->terrifnsul, $dataForElastic['terrifnsul'], 'Test terrifnsul field conversion.');
        $this->assertArrayHasKey('previd', $dataForElastic);
        $this->assertSame($entity->previd, $dataForElastic['previd'], 'Test previd field conversion.');
        $this->assertArrayHasKey('nextid', $dataForElastic);
        $this->assertSame($entity->nextid, $dataForElastic['nextid'], 'Test nextid field conversion.');
        $this->assertArrayHasKey('cadnum', $dataForElastic);
        $this->assertSame($entity->cadnum, $dataForElastic['cadnum'], 'Test cadnum field conversion.');
    }

    public function testHasProperty()
    {
        $mapper = new SteadIndexMapper();

        $this->assertTrue($mapper->hasProperty('steadguid'));
        $this->assertFalse($mapper->hasProperty('steadguid_tested_value'));
    }

    public function testQuery()
    {
        $mapper = new SteadIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
