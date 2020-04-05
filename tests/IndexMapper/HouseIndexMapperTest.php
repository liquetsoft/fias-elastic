<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTime;
use Liquetsoft\Fias\Elastic\IndexMapper\HouseIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Элементы адреса, идентифицирующие адресуемые объекты'.
 */
class HouseIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('house', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new HouseIndexMapper();

        $this->assertSame('houseid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
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
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->houseid = 'primary_value';

        $mapper = new HouseIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
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
        $entity->startdate = new DateTime();
        $entity->enddate = new DateTime();
        $entity->updatedate = new DateTime();
        $entity->counter = $this->createFakeData()->numberBetween(1, 100000);
        $entity->divtype = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new HouseIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('houseid', $dataForElastic);
        $this->assertSame($entity->houseid, $dataForElastic['houseid']);
        $this->assertArrayHasKey('houseguid', $dataForElastic);
        $this->assertSame($entity->houseguid, $dataForElastic['houseguid']);
        $this->assertArrayHasKey('aoguid', $dataForElastic);
        $this->assertSame($entity->aoguid, $dataForElastic['aoguid']);
        $this->assertArrayHasKey('housenum', $dataForElastic);
        $this->assertSame($entity->housenum, $dataForElastic['housenum']);
        $this->assertArrayHasKey('strstatus', $dataForElastic);
        $this->assertSame($entity->strstatus, $dataForElastic['strstatus']);
        $this->assertArrayHasKey('eststatus', $dataForElastic);
        $this->assertSame($entity->eststatus, $dataForElastic['eststatus']);
        $this->assertArrayHasKey('statstatus', $dataForElastic);
        $this->assertSame($entity->statstatus, $dataForElastic['statstatus']);
        $this->assertArrayHasKey('ifnsfl', $dataForElastic);
        $this->assertSame($entity->ifnsfl, $dataForElastic['ifnsfl']);
        $this->assertArrayHasKey('ifnsul', $dataForElastic);
        $this->assertSame($entity->ifnsul, $dataForElastic['ifnsul']);
        $this->assertArrayHasKey('okato', $dataForElastic);
        $this->assertSame($entity->okato, $dataForElastic['okato']);
        $this->assertArrayHasKey('oktmo', $dataForElastic);
        $this->assertSame($entity->oktmo, $dataForElastic['oktmo']);
        $this->assertArrayHasKey('postalcode', $dataForElastic);
        $this->assertSame($entity->postalcode, $dataForElastic['postalcode']);
        $this->assertArrayHasKey('startdate', $dataForElastic);
        $this->assertSame($entity->startdate->format('Y-m-d\TH:i:s'), $dataForElastic['startdate']);
        $this->assertArrayHasKey('enddate', $dataForElastic);
        $this->assertSame($entity->enddate->format('Y-m-d\TH:i:s'), $dataForElastic['enddate']);
        $this->assertArrayHasKey('updatedate', $dataForElastic);
        $this->assertSame($entity->updatedate->format('Y-m-d\TH:i:s'), $dataForElastic['updatedate']);
        $this->assertArrayHasKey('counter', $dataForElastic);
        $this->assertSame($entity->counter, $dataForElastic['counter']);
        $this->assertArrayHasKey('divtype', $dataForElastic);
        $this->assertSame($entity->divtype, $dataForElastic['divtype']);
    }
}
