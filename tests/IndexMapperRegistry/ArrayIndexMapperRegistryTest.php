<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapperRegistry;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\EntityInterface;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\ArrayIndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тесты для объекта, который содержит описания индексов во внутреннем массиве.
 */
class ArrayIndexMapperRegistryTest extends BaseCase
{
    /**
     * Проверяет, что объект выбросит исклбчение, если предоставить в конструктор неверный объект.
     *
     * @throws Throwable
     */
    public function testConstructorException()
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $this->expectException(InvalidArgumentException::class);
        new ArrayIndexMapperRegistry([$mapper, 'test']);
    }

    /**
     * Проверяет, что объект верно определит наличие описания индекса для сущности.
     *
     * @throws Throwable
     */
    public function testHasMapperFor()
    {
        $mapperName = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue($mapperName));

        $entity = $this->getMockBuilder(EntityInterface::class)->getMock();
        $entity->method('getElasticSearchIndex')->will($this->returnValue($mapperName));

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->assertTrue($registry->hasMapperFor($entity));
    }

    /**
     * Проверяет, что объект верно определит наличие описания индекса для сущности.
     *
     * @throws Throwable
     */
    public function testDoesNotHaveMapperFor()
    {
        $mapperName = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue($mapperName));

        $entity = $this->getMockBuilder(EntityInterface::class)->getMock();
        $entity->method('getElasticSearchIndex')->will($this->returnValue($mapperName . '_test'));

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->assertFalse($registry->hasMapperFor($entity));
    }

    /**
     * Проверяет, что объект правильно вернет описание индекса для сущности.
     *
     * @throws Throwable
     */
    public function testGetMapperFor()
    {
        $mapperName = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue($mapperName));

        $entity = $this->getMockBuilder(EntityInterface::class)->getMock();
        $entity->method('getElasticSearchIndex')->will($this->returnValue($mapperName));

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->assertSame($mapper, $registry->getMapperFor($entity));
    }

    /**
     * Проверяет, что объект выбросит исключение, если не сможет найти описание индекса.
     *
     * @throws Throwable
     */
    public function testGetMapperForException()
    {
        $mapperName = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue($mapperName));

        $entity = $this->getMockBuilder(EntityInterface::class)->getMock();
        $entity->method('getElasticSearchIndex')->will($this->returnValue($mapperName . '_test'));

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->expectException(InvalidArgumentException::class);
        $registry->getMapperFor($entity);
    }
}
