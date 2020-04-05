<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapper\AddressObjectTypeIndexMapper;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации'.
 */
class AddressObjectTypeIndexMapperTest extends BaseCase
{
    public function testGetName()
    {
        $mapper = new AddressObjectTypeIndexMapper();

        $this->assertSame('addressobjecttype', $mapper->getName());
    }

    public function testGetPrimaryName()
    {
        $mapper = new AddressObjectTypeIndexMapper();

        $this->assertSame('kodtst', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties()
    {
        $mapper = new AddressObjectTypeIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('kodtst', $map);
        $this->assertArrayHasKey('level', $map);
        $this->assertArrayHasKey('socrname', $map);
        $this->assertArrayHasKey('scname', $map);
    }

    public function testEtractPrimaryFromEntity()
    {
        $entity = new stdClass();
        $entity->kodtst = 'primary_value';

        $mapper = new AddressObjectTypeIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity()
    {
        $entity = new stdClass();
        $entity->kodtst = $this->createFakeData()->numberBetween(1, 100000);
        $entity->level = $this->createFakeData()->numberBetween(1, 100000);
        $entity->socrname = $this->createFakeData()->word;
        $entity->scname = $this->createFakeData()->word;

        $mapper = new AddressObjectTypeIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertIsArray($dataForElastic);
        $this->assertArrayHasKey('kodtst', $dataForElastic);
        $this->assertSame($entity->kodtst, $dataForElastic['kodtst']);
        $this->assertArrayHasKey('level', $dataForElastic);
        $this->assertSame($entity->level, $dataForElastic['level']);
        $this->assertArrayHasKey('socrname', $dataForElastic);
        $this->assertSame($entity->socrname, $dataForElastic['socrname']);
        $this->assertArrayHasKey('scname', $dataForElastic);
        $this->assertSame($entity->scname, $dataForElastic['scname']);
    }
}
