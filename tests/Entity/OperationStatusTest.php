<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\OperationStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень кодов операций над адресными объектами'.
 */
class OperationStatusTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('operationstatus', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setOperstatid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setOperstatid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);

        $arrayToTest = [
            'operstatid' => $entity->getOperstatid(),
            'name' => $entity->getName(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new OperationStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'operstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
