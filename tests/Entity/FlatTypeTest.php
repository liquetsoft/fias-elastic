<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\FlatType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень типов помещения или офиса'.
 */
class FlatTypeTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('FlatType', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setFltypeid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setFltypeid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);
        $entity->setShortname($this->createFakeData()->word);

        $arrayToTest = [
            'fltypeid' => $entity->getFltypeid(),
            'name' => $entity->getName(),
            'shortname' => $entity->getShortname(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new FlatType();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'fltypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
