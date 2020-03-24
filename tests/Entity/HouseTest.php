<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use DateTimeInterface;
use Liquetsoft\Fias\Elastic\Entity\House;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Элементы адреса, идентифицирующие адресуемые объекты'.
 */
class HouseTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('House', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setHouseid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setHouseid($this->createFakeData()->word);
        $entity->setHouseguid($this->createFakeData()->word);
        $entity->setAoguid($this->createFakeData()->word);
        $entity->setHousenum($this->createFakeData()->word);
        $entity->setStrstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setEststatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setStatstatus($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setIfnsfl($this->createFakeData()->word);
        $entity->setIfnsul($this->createFakeData()->word);
        $entity->setOkato($this->createFakeData()->word);
        $entity->setOktmo($this->createFakeData()->word);
        $entity->setPostalcode($this->createFakeData()->word);
        $entity->setStartdate(new DateTime());
        $entity->setEnddate(new DateTime());
        $entity->setUpdatedate(new DateTime());
        $entity->setCounter($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setDivtype($this->createFakeData()->numberBetween(1, 1000000));

        $arrayToTest = [
            'houseid' => $entity->getHouseid(),
            'houseguid' => $entity->getHouseguid(),
            'aoguid' => $entity->getAoguid(),
            'housenum' => $entity->getHousenum(),
            'strstatus' => $entity->getStrstatus(),
            'eststatus' => $entity->getEststatus(),
            'statstatus' => $entity->getStatstatus(),
            'ifnsfl' => $entity->getIfnsfl(),
            'ifnsul' => $entity->getIfnsul(),
            'okato' => $entity->getOkato(),
            'oktmo' => $entity->getOktmo(),
            'postalcode' => $entity->getPostalcode(),
            'startdate' => $entity->getStartdate()->format(DateTimeInterface::ATOM),
            'enddate' => $entity->getEnddate()->format(DateTimeInterface::ATOM),
            'updatedate' => $entity->getUpdatedate()->format(DateTimeInterface::ATOM),
            'counter' => $entity->getCounter(),
            'divtype' => $entity->getDivtype(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new House();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'houseid' => $this->createFakeData()->word,
            'houseguid' => $this->createFakeData()->word,
            'aoguid' => $this->createFakeData()->word,
            'housenum' => $this->createFakeData()->word,
            'strstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'eststatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'statstatus' => $this->createFakeData()->numberBetween(1, 1000000),
            'ifnsfl' => $this->createFakeData()->word,
            'ifnsul' => $this->createFakeData()->word,
            'okato' => $this->createFakeData()->word,
            'oktmo' => $this->createFakeData()->word,
            'postalcode' => $this->createFakeData()->word,
            'startdate' => new DateTime(),
            'enddate' => new DateTime(),
            'updatedate' => new DateTime(),
            'counter' => $this->createFakeData()->numberBetween(1, 1000000),
            'divtype' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
