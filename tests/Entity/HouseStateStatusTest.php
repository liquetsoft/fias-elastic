<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\HouseStateStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень возможных состояний объектов недвижимости'.
 */
class HouseStateStatusTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('housestatestatus', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setHousestid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setHousestid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);

        $arrayToTest = [
            'housestid' => $entity->getHousestid(),
            'name' => $entity->getName(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new HouseStateStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'housestid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
