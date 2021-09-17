<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapper;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\IndexMapper\ChangeHistoryIndexMapper;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;

/**
 * Тест для описания индекса сущности 'Сведения по истории изменений'.
 *
 * @internal
 */
class ChangeHistoryIndexMapperTest extends BaseCase
{
    public function testGetName(): void
    {
        $mapper = new ChangeHistoryIndexMapper();

        $this->assertSame('change_history', $mapper->getName());
    }

    public function testGetPrimaryName(): void
    {
        $mapper = new ChangeHistoryIndexMapper();

        $this->assertSame('changeid', $mapper->getPrimaryName());
    }

    public function testGetMappingProperties(): void
    {
        $mapper = new ChangeHistoryIndexMapper();
        $map = $mapper->getMappingProperties();

        $this->assertArrayHasKey('changeid', $map);
        $this->assertArrayHasKey('objectid', $map);
        $this->assertArrayHasKey('adrobjectid', $map);
        $this->assertArrayHasKey('opertypeid', $map);
        $this->assertArrayHasKey('ndocid', $map);
        $this->assertArrayHasKey('changedate', $map);
    }

    public function testExtractPrimaryFromEntity(): void
    {
        $entity = new stdClass();
        $entity->changeid = 'primary_value';

        $mapper = new ChangeHistoryIndexMapper();

        $this->assertSame('primary_value', $mapper->extractPrimaryFromEntity($entity));
    }

    public function testExtractDataFromEntity(): void
    {
        $entity = new stdClass();
        $entity->changeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->objectid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->adrobjectid = $this->createFakeData()->word;
        $entity->opertypeid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->ndocid = $this->createFakeData()->numberBetween(1, 100000);
        $entity->changedate = new DateTimeImmutable();

        $mapper = new ChangeHistoryIndexMapper();
        $dataForElastic = $mapper->extractDataFromEntity($entity);

        $this->assertArrayHasKey('changeid', $dataForElastic);
        $this->assertSame((string) $entity->changeid, $dataForElastic['changeid'], 'Test changeid field conversion.');
        $this->assertArrayHasKey('objectid', $dataForElastic);
        $this->assertSame($entity->objectid, $dataForElastic['objectid'], 'Test objectid field conversion.');
        $this->assertArrayHasKey('adrobjectid', $dataForElastic);
        $this->assertSame($entity->adrobjectid, $dataForElastic['adrobjectid'], 'Test adrobjectid field conversion.');
        $this->assertArrayHasKey('opertypeid', $dataForElastic);
        $this->assertSame($entity->opertypeid, $dataForElastic['opertypeid'], 'Test opertypeid field conversion.');
        $this->assertArrayHasKey('ndocid', $dataForElastic);
        $this->assertSame($entity->ndocid, $dataForElastic['ndocid'], 'Test ndocid field conversion.');
        $this->assertArrayHasKey('changedate', $dataForElastic);
        $this->assertSame($entity->changedate->format('Y-m-d\TH:i:s'), $dataForElastic['changedate'], 'Test changedate field conversion.');
    }

    public function testHasProperty(): void
    {
        $mapper = new ChangeHistoryIndexMapper();

        $this->assertTrue($mapper->hasProperty('changeid'));
        $this->assertFalse($mapper->hasProperty('changeid_tested_value'));
    }

    public function testQuery(): void
    {
        $mapper = new ChangeHistoryIndexMapper();
        $query = $mapper->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
}
