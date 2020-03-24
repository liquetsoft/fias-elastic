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
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('AddressObjectType', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setKodtst($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setKodtst($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setLevel($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setSocrname($this->createFakeData()->word);
        $entity->setScname($this->createFakeData()->word);

        $arrayToTest = [
            'kodtst' => $entity->getKodtst(),
            'level' => $entity->getLevel(),
            'socrname' => $entity->getSocrname(),
            'scname' => $entity->getScname(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
    }

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
