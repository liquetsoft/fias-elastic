<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexMapperRegistry;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\Exception\IndexMapperRegistryException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\ArrayIndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;
use Throwable;

/**
 * Тесты для объекта, который содержит описания индексов во внутреннем массиве.
 *
 * @internal
 */
class ArrayIndexMapperRegistryTest extends BaseCase
{
    /**
     * Проверяет, что объект выбросит исклбчение, если предоставить в конструктор неверный объект.
     *
     * @throws Throwable
     */
    public function testConstructorNotARegistryException(): void
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $this->expectException(InvalidArgumentException::class);
        new ArrayIndexMapperRegistry([$mapper, 'test']);
    }

    /**
     * Проверяет, что объект правильно находит соответствие для строкового ключа.
     *
     * @throws Throwable
     */
    public function testHasMapperForKey(): void
    {
        $key = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$key => $mapper]);

        $this->assertTrue($registry->hasMapperForKey($key));
        $this->assertFalse($registry->hasMapperForKey($key . '_test'));
    }

    /**
     * Проверяет, что объект правильно вернет соответствие для исени класса.
     *
     * @throws Throwable
     */
    public function testGetMapperForKey(): void
    {
        $key = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$mapper1, $key => $mapper]);

        $this->assertSame($mapper, $registry->getMapperForKey($key));
    }

    /**
     * Проверяет, что объект выбросит исключение, если не найдет соответствие.
     *
     * @throws Throwable
     */
    public function testGetMapperForKeyException(): void
    {
        $key = $this->createFakeData()->word;
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->expectException(IndexMapperRegistryException::class);
        $registry->getMapperForKey($key);
    }

    /**
     * Проверяет, что объект правильно находит соответствие для объекта.
     *
     * @throws Throwable
     */
    public function testHasMapperForObject(): void
    {
        $object = new stdClass();
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([\get_class($object) => $mapper]);

        $this->assertTrue($registry->hasMapperForObject($object));
        $this->assertFalse($registry->hasMapperForObject($this));
    }

    /**
     * Проверяет, что объект правильно вернет соответствие для объекта.
     *
     * @throws Throwable
     */
    public function testGetMapperForObject(): void
    {
        $object = new stdClass();
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$mapper1, \get_class($object) => $mapper]);

        $this->assertSame($mapper, $registry->getMapperForObject($object));
    }

    /**
     * Проверяет, что объект выбросит исключение, если не найдет соответствие.
     *
     * @throws Throwable
     */
    public function testGetMapperForObjectException(): void
    {
        $object = new stdClass();
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$mapper]);

        $this->expectException(IndexMapperRegistryException::class);
        $registry->getMapperForObject($object);
    }

    /**
     * Проверяет, что объект вернет список всех опианий.
     *
     * @throws Throwable
     */
    public function testGetAllMappers(): void
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $registry = new ArrayIndexMapperRegistry([$mapper, $mapper1]);
        $allMappers = $registry->getAllMappers();

        $this->assertSame([$mapper, $mapper1], $allMappers);
    }
}
