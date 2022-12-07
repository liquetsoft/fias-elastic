<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\ReestrObjects;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения об адресном элементе в части его идентификаторов'.
 *
 * @internal
 */
class ReestrObjectsTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new ReestrObjects();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'objectid' => $this->createFakeData()->numberBetween(1, 1000000),
            'createdate' => new \DateTimeImmutable(),
            'changeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'levelid' => $this->createFakeData()->numberBetween(1, 1000000),
            'updatedate' => new \DateTimeImmutable(),
            'objectguid' => $this->createFakeData()->word,
            'isactive' => $this->createFakeData()->numberBetween(1, 1000000),
        ];
    }
}
