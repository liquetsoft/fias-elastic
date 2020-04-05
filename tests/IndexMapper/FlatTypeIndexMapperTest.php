<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\FlatTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень типов помещения или офиса'.
 */
class FlatTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('flattype', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('fltypeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new FlatTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('fltypeid', $map);
        $this->assertArrayHasKey('name', $map);
        $this->assertArrayHasKey('shortname', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->fltypeid = 'primary_value';

        $mapper = new FlatTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->fltypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->name = $this->createFakeData()->word;
        $entity->shortname = $this->createFakeData()->word;

        $mapper = new FlatTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('fltypeid', $dataForElastic);
        $this->assertSame($entity->fltypeid, $dataForElastic['fltypeid']);
        $this->assertArrayHasKey('name', $dataForElastic);
        $this->assertSame($entity->name, $dataForElastic['name']);
        $this->assertArrayHasKey('shortname', $dataForElastic);
        $this->assertSame($entity->shortname, $dataForElastic['shortname']);
    }
}
