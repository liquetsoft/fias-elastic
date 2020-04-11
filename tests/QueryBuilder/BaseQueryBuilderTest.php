<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\QueryBuilder;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\QueryBuilder\BaseQueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use PHPUnit\Framework\MockObject\MockObject;
use Throwable;

/**
 * Тесты для конструктора запросов к elasticsearch.
 */
class ArrayIndexMapperRegistryTest extends BaseCase
{
    /**
     * Проверяет, что объект правильно задаст условие для поиска.
     *
     * @throws Throwable
     */
    public function testMatch()
    {
        $param = $this->createFakeData()->word;
        $value = $this->createFakeData()->word;
        $param1 = $this->createFakeData()->word;
        $value1 = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new BaseQueryBuilder($mapper);
        $builder->match($param, $value)->match($param1, $value1);
        $query = $builder->getQuery();

        $this->assertQuery([
            'bool' => [
                'must' => [
                    [
                        'match' => [
                            $param => $value,
                        ],
                    ],
                    [
                        'match' => [
                            $param1 => $value1,
                        ],
                    ],
                ],
            ],
        ], $query);
    }

    /**
     * Проверяет, что объект выбросит исключение, если поле указано неверно.
     *
     * @throws Throwable
     */
    public function testMatchWrongFieldException()
    {
        $mapper = $this->getMapperMock();

        $builder = new BaseQueryBuilder($mapper);

        $this->expectException(InvalidArgumentException::class);
        $builder->match('test', 'test');
    }

    /**
     * Проверяет, что объект правильно задаст условие для отсутствия значения.
     *
     * @throws Throwable
     */
    public function testNotExist()
    {
        $param = $this->createFakeData()->word;
        $param1 = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new BaseQueryBuilder($mapper);
        $builder->notExist($param)->notExist($param1);
        $query = $builder->getQuery();

        $this->assertQuery([
            'bool' => [
                'must_not' => [
                    [
                        'exists' => [
                            'field' => $param,
                        ],
                    ],
                    [
                        'exists' => [
                            'field' => $param1,
                        ],
                    ],
                ],
            ],
        ], $query);
    }

    /**
     * Проверяет, что объект правильно ограничит количество документов.
     *
     * @throws Throwable
     */
    public function testSize()
    {
        $size = $this->createFakeData()->numberBetween(1, 10000);
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new BaseQueryBuilder($mapper);
        $builder->size($size);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('size', $query);
        $this->assertEquals($size, $query['size']);
    }

    /**
     * Проверяет, что объект выбросит исключение, если поле указано неверно.
     *
     * @throws Throwable
     */
    public function testNotExistWrongFieldException()
    {
        $mapper = $this->getMapperMock();

        $builder = new BaseQueryBuilder($mapper);

        $this->expectException(InvalidArgumentException::class);
        $builder->notExist('test');
    }

    /**
     * Проверяет, что поисковый запрос совпадает с эталоном.
     *
     * @param array $etalonQuery
     * @param array $realQuery
     */
    private function assertQuery(array $etalonQuery, array $realQuery): void
    {
        $this->assertThat(
            $realQuery,
            $this->logicalAnd(
                $this->isType('array'),
                $this->arrayHasKey('index'),
                $this->arrayHasKey('body'),
                $this->equalTo([
                    'index' => 'mock_index',
                    'body' => [
                        'query' => $etalonQuery,
                    ],
                ])
            )
        );
    }

    /**
     * Создает мок для описания индекса.
     */
    private function getMapperMock($allowedProperties = []): MockObject
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue('mock_index'));
        $mapper->method('hasProperty')->will(
            $this->returnCallback(
                function (string $property) use ($allowedProperties) {
                    return in_array($property, $allowedProperties);
                }
            )
        );

        return $mapper;
    }
}
