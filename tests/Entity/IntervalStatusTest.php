<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\IntervalStatus;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Перечень возможных значений интервалов домов (обычный, четный, нечетный)'.
 */
class IntervalStatusTest extends EntityCase
{
    public function testGetElasticSearchDocumentType()
    {
        $this->assertSame('IntervalStatus', $this->createEntity()->getElasticSearchDocumentType());
    }

    public function testGetElasticSearchDocumentId()
    {
        $value = $this->createFakeData()->numberBetween(1, 1000000);

        $entity = $this->createEntity();
        $entity->setIntvstatid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchDocumentId());
    }

    public function testGetElasticSearchDocumentData()
    {
        $entity = $this->createEntity();
        $entity->setIntvstatid($this->createFakeData()->numberBetween(1, 1000000));
        $entity->setName($this->createFakeData()->word);

        $arrayToTest = [
            'intvstatid' => $entity->getIntvstatid(),
            'name' => $entity->getName(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchDocumentData());
    }

    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new IntervalStatus();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'intvstatid' => $this->createFakeData()->numberBetween(1, 1000000),
            'name' => $this->createFakeData()->word,
        ];
    }
}
