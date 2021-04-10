<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\QueryBuilder;

use InvalidArgumentException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\QueryBuilder\MapperQueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тесты для конструктора запросов к elasticsearch.
 *
 * @internal
 */
class MapperQueryBuilderTest extends BaseCase
{
    /**
     * Проверяет, что объект правильно задаст условие для поиска.
     *
     * @throws Throwable
     */
    public function testMatch(): void
    {
        $param = $this->createFakeData()->word;
        $value = $this->createFakeData()->word;
        $param1 = $this->createFakeData()->word;
        $value1 = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->match($param, $value)->match($param1, $value1);
        $query = $builder->getQuery();

        $this->assertQuery(
            [
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
            ],
            $query
        );
    }

    /**
     * Проверяет, что объект выбросит исключение, если поле указано неверно.
     *
     * @throws Throwable
     */
    public function testMatchWrongFieldException(): void
    {
        $mapper = $this->getMapperMock();

        $builder = new MapperQueryBuilder($mapper);

        $this->expectException(InvalidArgumentException::class);
        $builder->match('test', 'test');
    }

    /**
     * Проверяет, что объект правильно задаст условие для поиска
     * по полному соответствию.
     *
     * @throws Throwable
     */
    public function testTerm(): void
    {
        $param = $this->createFakeData()->word;
        $value = $this->createFakeData()->word;
        $param1 = $this->createFakeData()->word;
        $value1 = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->term($param, $value)->term($param1, $value1);
        $query = $builder->getQuery();

        $this->assertQuery(
            [
                'bool' => [
                    'must' => [
                        [
                            'term' => [
                                $param => ['value' => $value],
                            ],
                        ],
                        [
                            'term' => [
                                $param1 => ['value' => $value1],
                            ],
                        ],
                    ],
                ],
            ],
            $query
        );
    }

    /**
     * Проверяет, что объект правильно задаст условие для отсутствия значения.
     *
     * @throws Throwable
     */
    public function testNotExist(): void
    {
        $param = $this->createFakeData()->word;
        $param1 = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param, $param1]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->notExist($param)->notExist($param1);
        $query = $builder->getQuery();

        $this->assertQuery(
            [
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
            ],
            $query
        );
    }

    /**
     * Проверяет, что объект правильно задаст сортировку.
     *
     * @throws Throwable
     */
    public function testSortAsc(): void
    {
        $param = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->sortAsc($param);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('body', $query);
        $this->assertArrayHasKey('sort', $query['body']);
        $this->assertSame(
            [
                [
                    $param => ['order' => 'asc'],
                ],
            ],
            $query['body']['sort']
        );
    }

    /**
     * Проверяет, что объект правильно задаст сортировку.
     *
     * @throws Throwable
     */
    public function testSortDesc(): void
    {
        $param = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->sortDesc($param);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('body', $query);
        $this->assertArrayHasKey('sort', $query['body']);
        $this->assertSame(
            [
                [
                    $param => ['order' => 'desc'],
                ],
            ],
            $query['body']['sort']
        );
    }

    /**
     * Проверяет, что объект правильно ограничит количество документов.
     *
     * @throws Throwable
     */
    public function testSize(): void
    {
        $size = $this->createFakeData()->numberBetween(1, 10000);
        $mapper = $this->getMapperMock();

        $builder = new MapperQueryBuilder($mapper);
        $builder->size($size);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('size', $query);
        $this->assertSame($size, $query['size']);
    }

    /**
     * Проверяет, что объект правильно задаст смещение элементов.
     *
     * @throws Throwable
     */
    public function testFrom(): void
    {
        $from = $this->createFakeData()->numberBetween(1, 10000);
        $mapper = $this->getMapperMock();

        $builder = new MapperQueryBuilder($mapper);
        $builder->from($from);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('from', $query);
        $this->assertSame($from, $query['from']);
    }

    /**
     * Проверяет, что объект правильно задаст search_after.
     *
     * @throws Throwable
     */
    public function testSearchAfter(): void
    {
        $searchAfter = [
            $this->createFakeData()->numberBetween(1, 1000),
        ];
        $param = $this->createFakeData()->word;
        $mapper = $this->getMapperMock([$param]);

        $builder = new MapperQueryBuilder($mapper);
        $builder->sortAsc($param);
        $builder->searchAfter($searchAfter);
        $query = $builder->getQuery();

        $this->assertArrayHasKey('body', $query);
        $this->assertArrayHasKey('search_after', $query['body']);
        $this->assertSame($searchAfter, $query['body']['search_after']);
    }

    /**
     * Проверяет, что объект верно объединит свои данные со внешним объектом.
     *
     * @throws Throwable
     */
    public function testMerge(): void
    {
        $param1 = $this->createFakeData()->word;
        $value1 = $this->createFakeData()->word;

        $param2 = $this->createFakeData()->word;
        $value2 = $this->createFakeData()->word;

        $mapper = $this->getMapperMock([$param1, $param2]);

        $builder1 = new MapperQueryBuilder($mapper);
        $builder1->match($param1, $value1);

        $builder2 = new MapperQueryBuilder($mapper);
        $builder2->match($param2, $value2);

        $query = $builder1->merge($builder2)->getQuery();

        $this->assertQuery(
            [
                'bool' => [
                    'must' => [
                        [
                            'match' => [
                                $param1 => $value1,
                            ],
                        ],
                        [
                            'match' => [
                                $param2 => $value2,
                            ],
                        ],
                    ],
                ],
            ],
            $query
        );
    }

    /**
     * Проверяет, что поисковый запрос совпадает с эталоном.
     *
     * @param array $awaitedQuery
     * @param array $realQuery
     */
    private function assertQuery(array $awaitedQuery, array $realQuery): void
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
                        'query' => $awaitedQuery,
                    ],
                ])
            )
        );
    }

    /**
     * Создает мок для описания индекса.
     *
     * @param array $allowedProperties
     *
     * @return IndexMapperInterface
     */
    private function getMapperMock(array $allowedProperties = []): IndexMapperInterface
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn('mock_index');
        $mapper->method('hasProperty')->willReturnCallback(
            function (string $property) use ($allowedProperties) {
                return \in_array($property, $allowedProperties);
            }
        );

        return $mapper;
    }
}
