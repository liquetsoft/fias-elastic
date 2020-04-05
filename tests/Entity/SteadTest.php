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
