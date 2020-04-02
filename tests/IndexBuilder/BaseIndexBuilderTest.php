<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexBuilder;

use Elasticsearch\Client;
use Elasticsearch\Namespaces\IndicesNamespace;
use Liquetsoft\Fias\Component\Tests\BaseCase;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\IndexBuilder\BaseIndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Throwable;

/**
 * Тест для объекта, который строит индексы в elasticsearch.
 */
class BaseIndexBuilderTest extends BaseCase
{
    /**
     * Проверяет, что объект верно обновит все индексы в elasticsearch или создаст новые.
     *
     * @throws Throwable
     */
    public function testRefresh()
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->will($this->returnValue($mapperName));
        $mapper->method('getMappingProperties')->will($this->returnValue($mapperMap));

        $mapper1Name = $this->createFakeData()->word;
        $mapper1Map = [$this->createFakeData()->word => $this->createFakeData()->word];
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1->method('getName')->will($this->returnValue($mapper1Name));
        $mapper1->method('getMappingProperties')->will($this->returnValue($mapper1Map));

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->will($this->returnCallback(function (array $params) use ($mapper1Name) {
            return isset($params['index']) && $params['index'] === '_all'
                ? [$mapper1Name => ['aliases' => [], 'mappings' => []]]
                : null;
        }));
        $indices->expects($this->at(1))
            ->method('create')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'body' => ['mappings' => ['properties' => $mapperMap]]]
                )
            );
        $indices->expects($this->at(2))
            ->method('putMapping')
            ->with(
                $this->identicalTo(
                    ['index' => $mapper1Name, 'body' => ['properties' => $mapper1Map]]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->will($this->returnValue($indices));

        $registry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $registry->method('getAllMappers')->will($this->returnValue([$mapper, $mapper1]));

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->returnValue($client));

        $builder = new BaseIndexBuilder($clientProvider, $registry);
        $builder->refresh();
    }
}
