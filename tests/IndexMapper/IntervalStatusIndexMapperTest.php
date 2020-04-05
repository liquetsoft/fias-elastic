<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\IntervalStatusIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень возможных значений интервалов домов (обычный, четный, нечетный)'.
 */
class IntervalStatusIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new IntervalStatusIndexMapper();

        $this->assertSame('intervalstatus', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new IntervalStatusIndexMapper();

        $this->assertSame('intvstatid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new IntervalStatusIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('intvstatid', $map);
        $this->assertArrayHasKey('name', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->intvstatid = 'primary_value';

        $mapper = new IntervalStatusIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->intvstatid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;

        $mapper = new IntervalStatusIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('intvstatid', $dataForElastic);
        $this->assertSame((string) $entity->intvstatid, $dataForElastic['intvstatid'], 'Test intvstatid field conversion.');
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name'], 'Test name field conversion.');
    }
}
