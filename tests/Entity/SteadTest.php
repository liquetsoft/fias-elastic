<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\Stead;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения о земельных участках'.
 */
class SteadTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('stead', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setSteadguid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setSteadguid($this->createFakeData()->word);
        $entity->setNumber($this->createFakeData()->word);
        $entity->setRegioncode($this->createFakeData()->word);
        $entity->setPostalcode($this->createFakeData()->word);
        $entity->setIfnsfl($this->createFakeData()->word);
        $entity->setIfnsul($this->createFakeData()->word);
        $entity->setOkato($this->createFakeData()->word);
        $entity->setOktmo($this->createFakeData()->word);
        $entity->setParentguid($this->createFakeData()->word);
        $entity->setSteadid($this->createFakeData()->word);
        $entity->setOperstatus($this->createFakeData()->word);
        $entity->setStartdate(new DateTime());
        $entity->setEnddate(new DateTime());
        $entity->setUpdatedate(new DateTime());
        $entity->setLivestatus($this->createFakeData()->word);
        $entity->setDivtype($this->createFakeData()->word);
        $entity->setNormdoc($this->createFakeData()->word);

        $arrayToTest = [
            'steadguid' => $entity->getSteadguid(),
            'number' => $entity->getNumber(),
            'regioncode' => $entity->getRegioncode(),
            'postalcode' => $entity->getPostalcode(),
            'ifnsfl' => $entity->getIfnsfl(),
            'ifnsul' => $entity->getIfnsul(),
            'okato' => $entity->getOkato(),
            'oktmo' => $entity->getOktmo(),
            'parentguid' => $entity->getParentguid(),
            'steadid' => $entity->getSteadid(),
            'operstatus' => $entity->getOperstatus(),
            'startdate' => $entity->getStartdate()->format('Y-m-d\TH:i:s'),
            'enddate' => $entity->getEnddate()->format('Y-m-d\TH:i:s'),
            'updatedate' => $entity->getUpdatedate()->format('Y-m-d\TH:i:s'),
            'livestatus' => $entity->getLivestatus(),
            'divtype' => $entity->getDivtype(),
            'normdoc' => $entity->getNormdoc(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new Stead();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'steadguid' => $this->createFakeData()->word,
            'number' => $this->createFakeData()->word,
            'regioncode' => $this->createFakeData()->word,
            'postalcode' => $this->createFakeData()->word,
            'ifnsfl' => $this->createFakeData()->word,
            'ifnsul' => $this->createFakeData()->word,
            'okato' => $this->createFakeData()->word,
            'oktmo' => $this->createFakeData()->word,
            'parentguid' => $this->createFakeData()->word,
            'steadid' => $this->createFakeData()->word,
            'operstatus' => $this->createFakeData()->word,
            'startdate' => new DateTime(),
            'enddate' => new DateTime(),
            'updatedate' => new DateTime(),
            'livestatus' => $this->createFakeData()->word,
            'divtype' => $this->createFakeData()->word,
            'normdoc' => $this->createFakeData()->word,
        ];
    }
}
