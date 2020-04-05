<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTime;
use Liquetsoft\Fias\Elastic\IndexMapper\AddressObjectIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Реестр адресообразующих элементов'.
 */
class AddressObjectIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new AddressObjectIndexMapper();

        $this->assertSame('addressobject', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new AddressObjectIndexMapper();

        $this->assertSame('aoid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new AddressObjectIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('aoid', $map);
        $this->assertArrayHasKey('aoguid', $map);
        $this->assertArrayHasKey('parentguid', $map);
        $this->assertArrayHasKey('previd', $map);
        $this->assertArrayHasKey('nextid', $map);
        $this->assertArrayHasKey('code', $map);
        $this->assertArrayHasKey('formalname', $map);
        $this->assertArrayHasKey('offname', $map);
        $this->assertArrayHasKey('shortname', $map);
        $this->assertArrayHasKey('aolevel', $map);
        $this->assertArrayHasKey('regioncode', $map);
        $this->assertArrayHasKey('areacode', $map);
        $this->assertArrayHasKey('autocode', $map);
        $this->assertArrayHasKey('citycode', $map);
        $this->assertArrayHasKey('ctarcode', $map);
        $this->assertArrayHasKey('placecode', $map);
        $this->assertArrayHasKey('plancode', $map);
        $this->assertArrayHasKey('streetcode', $map);
        $this->assertArrayHasKey('extrcode', $map);
        $this->assertArrayHasKey('sextcode', $map);
        $this->assertArrayHasKey('plaincode', $map);
        $this->assertArrayHasKey('currstatus', $map);
        $this->assertArrayHasKey('actstatus', $map);
        $this->assertArrayHasKey('livestatus', $map);
        $this->assertArrayHasKey('centstatus', $map);
        $this->assertArrayHasKey('operstatus', $map);
        $this->assertArrayHasKey('ifnsfl', $map);
        $this->assertArrayHasKey('ifnsul', $map);
        $this->assertArrayHasKey('terrifnsfl', $map);
        $this->assertArrayHasKey('terrifnsul', $map);
        $this->assertArrayHasKey('okato', $map);
        $this->assertArrayHasKey('oktmo', $map);
        $this->assertArrayHasKey('postalcode', $map);
        $this->assertArrayHasKey('startdate', $map);
        $this->assertArrayHasKey('enddate', $map);
        $this->assertArrayHasKey('updatedate', $map);
        $this->assertArrayHasKey('divtype', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->aoid = 'primary_value';

        $mapper = new AddressObjectIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->aoid = $this->createFakeData()->word;
        $entity->aoguid = $this->createFakeData()->word;
        $entity->parentguid = $this->createFakeData()->word;
        $entity->previd = $this->createFakeData()->word;
        $entity->nextid = $this->createFakeData()->word;
        $entity->code = $this->createFakeData()->word;
        $entity->formalname = $this->createFakeData()->word;
        $entity->offname = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;
        $entity->aolevel = $this->createFakeData()->numberBetween(1, 100000);
        $entity->regioncode = $this->createFakeData()->word;
        $entity->areacode = $this->createFakeData()->word;
        $entity->autocode = $this->createFakeData()->word;
        $entity->citycode = $this->createFakeData()->word;
        $entity->ctarcode = $this->createFakeData()->word;
        $entity->placecode = $this->createFakeData()->word;
        $entity->plancode = $this->createFakeData()->word;
        $entity->streetcode = $this->createFakeData()->word;
        $entity->extrcode = $this->createFakeData()->word;
        $entity->sextcode = $this->createFakeData()->word;
        $entity->plaincode = $this->createFakeData()->word;
        $entity->currstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->actstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->livestatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->centstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->operstatus = $this->createFakeData()->numberBetween(1, 100000);
        $entity->ifnsfl = $this->createFakeData()->word;
        $entity->ifnsul = $this->createFakeData()->word;
        $entity->terrifnsfl = $this->createFakeData()->word;
        $entity->terrifnsul = $this->createFakeData()->word;
        $entity->okato = $this->createFakeData()->word;
        $entity->oktmo = $this->createFakeData()->word;
        $entity->postalcode = $this->createFakeData()->word;
        $entity->startdate = new DateTime();
        $entity->enddate = new DateTime();
        $entity->updatedate = new DateTime();
        $entity->divtype = $this->createFakeData()->numberBetween(1, 100000);

        $mapper = new AddressObjectIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('aoid', $dataForElastic);
        $this->assertSame($entity->aoid, $dataForElastic['aoid']);
        $this->assertArrayHasKey('aoguid', $dataForElastic);
        $this->assertSame($entity->aoguid, $dataForElastic['aoguid']);
        $this->assertArrayHasKey('parentguid', $dataForElastic);
        $this->assertSame($entity->parentguid, $dataForElastic['parentguid']);
        $this->assertArrayHasKey('previd', $dataForElastic);
        $this->assertSame($entity->previd, $dataForElastic['previd']);
        $this->assertArrayHasKey('nextid', $dataForElastic);
        $this->assertSame($entity->nextid, $dataForElastic['nextid']);
        $this->assertArrayHasKey('code', $dataForElastic);
        $this->assertSame($entity->code, $dataForElastic['code']);
        $this->assertArrayHasKey('formalname', $dataForElastic);
        $this->assertSame($entity->formalname, $dataForElastic['formalname']);
        $this->assertArrayHasKey('offname', $dataForElastic);
        $this->assertSame($entity->offname, $dataForElastic['offname']);
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname']);
        $this->assertArrayHasKey('aolevel', $dataForElastic);
        $this->assertSame($entity->aolevel, $dataForElastic['aolevel']);
        $this->assertArrayHasKey('regioncode', $dataForElastic);
        $this->assertSame($entity->regioncode, $dataForElastic['regioncode']);
        $this->assertArrayHasKey('areacode', $dataForElastic);
        $this->assertSame($entity->areacode, $dataForElastic['areacode']);
        $this->assertArrayHasKey('autocode', $dataForElastic);
        $this->assertSame($entity->autocode, $dataForElastic['autocode']);
        $this->assertArrayHasKey('citycode', $dataForElastic);
        $this->assertSame($entity->citycode, $dataForElastic['citycode']);
        $this->assertArrayHasKey('ctarcode', $dataForElastic);
        $this->assertSame($entity->ctarcode, $dataForElastic['ctarcode']);
        $this->assertArrayHasKey('placecode', $dataForElastic);
        $this->assertSame($entity->placecode, $dataForElastic['placecode']);
        $this->assertArrayHasKey('plancode', $dataForElastic);
        $this->assertSame($entity->plancode, $dataForElastic['plancode']);
        $this->assertArrayHasKey('streetcode', $dataForElastic);
        $this->assertSame($entity->streetcode, $dataForElastic['streetcode']);
        $this->assertArrayHasKey('extrcode', $dataForElastic);
        $this->assertSame($entity->extrcode, $dataForElastic['extrcode']);
        $this->assertArrayHasKey('sextcode', $dataForElastic);
        $this->assertSame($entity->sextcode, $dataForElastic['sextcode']);
        $this->assertArrayHasKey('plaincode', $dataForElastic);
        $this->assertSame($entity->plaincode, $dataForElastic['plaincode']);
        $this->assertArrayHasKey('currstatus', $dataForElastic);
        $this->assertSame($entity->currstatus, $dataForElastic['currstatus']);
        $this->assertArrayHasKey('actstatus', $dataForElastic);
        $this->assertSame($entity->actstatus, $dataForElastic['actstatus']);
        $this->assertArrayHasKey('livestatus', $dataForElastic);
        $this->assertSame($entity->livestatus, $dataForElastic['livestatus']);
        $this->assertArrayHasKey('centstatus', $dataForElastic);
        $this->assertSame($entity->centstatus, $dataForElastic['centstatus']);
        $this->assertArrayHasKey('operstatus', $dataForElastic);
        $this->assertSame($entity->operstatus, $dataForElastic['operstatus']);
        $this->assertArrayHasKey('ifnsfl', $dataForElastic);
        $this->assertSame($entity->ifnsfl, $dataForElastic['ifnsfl']);
        $this->assertArrayHasKey('ifnsul', $dataForElastic);
        $this->assertSame($entity->ifnsul, $dataForElastic['ifnsul']);
        $this->assertArrayHasKey('terrifnsfl', $dataForElastic);
        $this->assertSame($entity->terrifnsfl, $dataForElastic['terrifnsfl']);
        $this->assertArrayHasKey('terrifnsul', $dataForElastic);
        $this->assertSame($entity->terrifnsul, $dataForElastic['terrifnsul']);
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
        $this->assertArrayHasKey('divtype', $dataForElastic);
        $this->assertSame($entity->divtype, $dataForElastic['divtype']);
    }
}
