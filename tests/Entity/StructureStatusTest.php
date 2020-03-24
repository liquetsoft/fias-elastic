<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\StructureStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень видов строений'.
 */
class StructureStatusTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('StructureStatus', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setStrstatid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setStrstatid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);
        $entity->setShortname($this->createFakeData()->word);

        $arrayToTest = [
            'strstatid' => $entity->getStrstatid(),
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
        return new StructureStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'strstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
            'shortname' => $this->createFakeData()->word,
        ];
    }
}
