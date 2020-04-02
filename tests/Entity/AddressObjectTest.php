<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\AddressObject;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Реестр адресообразующих элементов'.
 */
class AddressObjectTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('addressobject', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setAoid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setAoid($this->createFakeData()->word);
        $entity->setAoguid($this->createFakeData()->word);
        $entity->setParentguid($this->createFakeData()->word);
        $entity->setPrevid($this->createFakeData()->word);
        $entity->setNextid($this->createFakeData()->word);
        $entity->setCode($this->createFakeData()->word);
        $entity->setFormalname($this->createFakeData()->word);
        $entity->setOffname($this->createFakeData()->word);
        $entity->setShortname($this->createFakeData()->word);
        $entity->setAolevel($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setRegioncode($this->createFakeData()->word);
        $entity->setAreacode($this->createFakeData()->word);
        $entity->setAutocode($this->createFakeData()->word);
        $entity->setCitycode($this->createFakeData()->word);
        $entity->setCtarcode($this->createFakeData()->word);
        $entity->setPlacecode($this->createFakeData()->word);
        $entity->setPlancode($this->createFakeData()->word);
        $entity->setStreetcode($this->createFakeData()->word);
        $entity->setExtrcode($this->createFakeData()->word);
        $entity->setSextcode($this->createFakeData()->word);
        $entity->setPlaincode($this->createFakeData()->word);
        $entity->setCurrstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setActstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setLivestatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setCentstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setOperstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setIfnsfl($this->createFakeData()->word);
        $entity->setIfnsul($this->createFakeData()->word);
        $entity->setTerrifnsfl($this->createFakeData()->word);
        $entity->setTerrifnsul($this->createFakeData()->word);
        $entity->setOkato($this->createFakeData()->word);
        $entity->setOktmo($this->createFakeData()->word);
        $entity->setPostalcode($this->createFakeData()->word);
        $entity->setStartdate(new DateTime());
        $entity->setEnddate(new DateTime());
        $entity->setUpdatedate(new DateTime());
        $entity->setDivtype($this->createFakeData()->numberBetween(1, 1000000));

        $arrayToTest = [
            'aoid' => $entity->getAoid(),
            'aoguid' => $entity->getAoguid(),
            'parentguid' => $entity->getParentguid(),
            'previd' => $entity->getPrevid(),
            'nextid' => $entity->getNextid(),
            'code' => $entity->getCode(),
            'formalname' => $entity->getFormalname(),
            'offname' => $entity->getOffname(),
            'shortname' => $entity->getShortname(),
            'aolevel' => $entity->getAolevel(),
            'regioncode' => $entity->getRegioncode(),
            'areacode' => $entity->getAreacode(),
            'autocode' => $entity->getAutocode(),
            'citycode' => $entity->getCitycode(),
            'ctarcode' => $entity->getCtarcode(),
            'placecode' => $entity->getPlacecode(),
            'plancode' => $entity->getPlancode(),
            'streetcode' => $entity->getStreetcode(),
            'extrcode' => $entity->getExtrcode(),
            'sextcode' => $entity->getSextcode(),
            'plaincode' => $entity->getPlaincode(),
            'currstatus' => $entity->getCurrstatus(),
            'actstatus' => $entity->getActstatus(),
            'livestatus' => $entity->getLivestatus(),
            'centstatus' => $entity->getCentstatus(),
            'operstatus' => $entity->getOperstatus(),
            'ifnsfl' => $entity->getIfnsfl(),
            'ifnsul' => $entity->getIfnsul(),
            'terrifnsfl' => $entity->getTerrifnsfl(),
            'terrifnsul' => $entity->getTerrifnsul(),
            'okato' => $entity->getOkato(),
            'oktmo' => $entity->getOktmo(),
            'postalcode' => $entity->getPostalcode(),
            'startdate' => $entity->getStartdate()->format('Y-m-d\TH:i:s'),
            'enddate' => $entity->getEnddate()->format('Y-m-d\TH:i:s'),
            'updatedate' => $entity->getUpdatedate()->format('Y-m-d\TH:i:s'),
            'divtype' => $entity->getDivtype(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new AddressObject();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'aoid' => $this->createFakeData()->word,
            'aoguid' => $this->createFakeData()->word,
            'parentguid' => $this->createFakeData()->word,
            'previd' => $this->createFakeData()->word,
            'nextid' => $this->createFakeData()->word,
            'code' => $this->createFakeData()->word,
            'formalname' => $this->createFakeData()->word,
            'offname' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
            'aolevel' => $this->createFakeData()->numberBetween(1, 1000000),
            'regioncode' => $this->createFakeData()->word,
            'areacode' => $this->createFakeData()->word,
            'autocode' => $this->createFakeData()->word,
            'citycode' => $this->createFakeData()->word,
            'ctarcode' => $this->createFakeData()->word,
            'placecode' => $this->createFakeData()->word,
            'plancode' => $this->createFakeData()->word,
            'streetcode' => $this->createFakeData()->word,
            'extrcode' => $this->createFakeData()->word,
            'sextcode' => $this->createFakeData()->word,
            'plaincode' => $this->createFakeData()->word,
            'currstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'actstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'livestatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'centstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'operstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'ifnsfl' => $this->createFakeData()->word,
            'ifnsul' => $this->createFakeData()->word,
            'terrifnsfl' => $this->createFakeData()->word,
            'terrifnsul' => $this->createFakeData()->word,
            'okato' => $this->createFakeData()->word,
            'oktmo' => $this->createFakeData()->word,
            'postalcode' => $this->createFakeData()->word,
            'startdate' => new DateTime(),
            'enddate' => new DateTime(),
            'updatedate' => new DateTime(),
            'divtype' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
