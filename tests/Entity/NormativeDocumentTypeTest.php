<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\NormativeDocumentType;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Типы нормативных документов'.
 */
class NormativeDocumentTypeTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('NormativeDocumentType', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setNdtypeid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setNdtypeid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);

        $arrayToTest = [
            'ndtypeid' => $entity->getNdtypeid(),
            'name' => $entity->getName(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new NormativeDocumentType();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'ndtypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
