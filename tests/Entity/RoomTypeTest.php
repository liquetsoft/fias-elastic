<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\RoomType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень типов комнат'.
 */
class RoomTypeTest extends EntityCase
{
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('roomtype', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setRmtypeid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setRmtypeid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);
        $entity->setShortname($this->createFakeData()->word);

        $arrayToTest = [
            'rmtypeid' => $entity->getRmtypeid(),
            'name' => $entity->getName(),
            'shortname' => $entity->getShortname(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new RoomType();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'rmtypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
