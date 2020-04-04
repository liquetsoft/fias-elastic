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
