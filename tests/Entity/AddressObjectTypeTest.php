<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\AddressObjectType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации'.
 */
class AddressObjectTypeTest extends EntityCase
{
    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new AddressObjectType();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'kodtst' => $this->createFakeData()->numberBetween(1, 1000000),
            'level' => $this->createFakeData()->numberBetween(1, 1000000),
            'socrname' => $this->createFakeData()->word,
            'scname' => $this->createFakeData()->word,
        ];
    }
}
