<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\ElasticSearchRepository;

use Elasticsearch\Client;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\ElasticSearchRepository\BaseElasticSearchRepository;
use Liquetsoft\Fias\Elastic\Exception\ElasticSearchRepositoryException;
use Liquetsoft\Fias\Elastic\QueryBuilder\QueryBuilder;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use stdClass;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Throwable;

/**
 * Тест для репозитория elasticsearch.
 *
 * @internal
 */
class BaseElasticSearchRepositoryTest extends BaseCase
{
    /**
     * Проверяет, что репозтиторий правильно вернет один объект по условию.
     *
     * @throws Throwable
     */
    public function testOne(): void
    {
        $class = 'test';
        $queryData = [
            'test' => 'value',
        ];
        $hits = [
            'hits' => [
                'hits' => [
                    [
                        '_source' => ['test' => 'value'],
                    ],
                ],
            ],
        ];

        $query = $this->getMockBuilder(QueryBuilder::class)->getMock();
        $query->method('getQuery')->willReturn($queryData);

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())
            ->method('search')
            ->with(
                $this->identicalTo($queryData)
            )
            ->willReturn($hits)
        ;

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $object = new stdClass();

        $denormalizer = $this->getMockBuilder(DenormalizerInterface::class)->getMock();
        $denormalizer->expects($this->once())
            ->method('denormalize')
            ->with(
                $this->identicalTo($hits['hits']['hits'][0]['_source']),
                $this->identicalTo($class)
            )
            ->willReturn($object)
        ;

        $repo = new BaseElasticSearchRepository($clientProvider, $denormalizer);
        $testObject = $repo->one($query, $class);

        $this->assertSame($object, $testObject);
    }

    /**
     * Проверяет, что репозтиторий правильно вернет список объектов по условию.
     *
     * @throws Throwable
     */
    public function testAll(): void
    {
        $class = 'test';
        $queryData = [
            'test' => 'value',
        ];
        $hits = [
            'hits' => [
                'hits' => [
                    [
                        '_source' => ['test' => 'value'],
                    ],
                    [
                        '_source' => ['test1' => 'value 1'],
                    ],
                ],
            ],
        ];

        $query = $this->getMockBuilder(QueryBuilder::class)->getMock();
        $query->method('getQuery')->willReturn($queryData);

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects($this->once())
            ->method('search')
            ->with(
                $this->identicalTo($queryData)
            )
            ->willReturn($hits)
        ;

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $object = new stdClass();
        $object1 = new stdClass();

        $denormalizer = $this->getMockBuilder(DenormalizerInterface::class)->getMock();
        $denormalizer->method('denormalize')
            ->willReturnMap(
                [
                    [$hits['hits']['hits'][0]['_source'], $class, null, [], $object],
                    [$hits['hits']['hits'][1]['_source'], $class, null, [], $object1],
                ]
            )
        ;

        $repo = new BaseElasticSearchRepository($clientProvider, $denormalizer);
        $testObjects = $repo->all($query, $class);

        $this->assertSame([$object, $object1], $testObjects);
    }

    /**
     * Проверяет, что репозтиторий выбросит исключение при неполном ответе от elasticsearch.
     *
     * @throws Throwable
     */
    public function testEmptySourceException(): void
    {
        $class = 'test';
        $queryData = [
            'test' => 'value',
        ];
        $hits = [
            'hits' => [
                'hits' => [
                    [],
                ],
            ],
        ];

        $query = $this->getMockBuilder(QueryBuilder::class)->getMock();
        $query->method('getQuery')->willReturn($queryData);

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('search')->willReturn($hits);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $denormalizer = $this->getMockBuilder(DenormalizerInterface::class)->getMock();

        $repo = new BaseElasticSearchRepository($clientProvider, $denormalizer);

        $this->expectException(ElasticSearchRepositoryException::class);
        $repo->one($query, $class);
    }

    /**
     * Проверяет, что репозтиторий выбросит исключение при неправильном ответе от denprmalizer.
     *
     * @throws Throwable
     */
    public function testBrokenDenormalizeException(): void
    {
        $class = 'test';
        $queryData = [
            'test' => 'value',
        ];
        $hits = [
            'hits' => [
                'hits' => [
                    [
                        '_source' => ['test' => 'value'],
                    ],
                ],
            ],
        ];

        $query = $this->getMockBuilder(QueryBuilder::class)->getMock();
        $query->method('getQuery')->willReturn($queryData);

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('search')->willReturn($hits);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $denormalizer = $this->getMockBuilder(DenormalizerInterface::class)->getMock();
        $denormalizer->method('denormalize')->willReturn('test');

        $repo = new BaseElasticSearchRepository($clientProvider, $denormalizer);

        $this->expectException(ElasticSearchRepositoryException::class);
        $repo->one($query, $class);
    }
}
