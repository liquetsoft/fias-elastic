<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\CurrentStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0'.
 */
class CurrentStatusTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('currentstatus', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setCurentstid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setCurentstid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);

        $arrayToTest = [
            'curentstid' => $entity->getCurentstid(),
            'name' => $entity->getName(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new CurrentStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'curentstid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
