<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\IndexBuilder;

use Elasticsearch\Client;
use Elasticsearch\Namespaces\IndicesNamespace;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\Exception\IndexBuilderException;
use Liquetsoft\Fias\Elastic\IndexBuilder\BaseIndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для объекта, который строит индексы в elasticsearch.
 *
 * @internal
 */
class BaseIndexBuilderTest extends BaseCase
{
    /**
     * Проверяет, что объект создаст индекс, если его не существует.
     *
     * @throws \Throwable
     */
    public function testSaveNewIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->willReturn([]);
        $indices->expects($this->once())
            ->method('create')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'body' => ['mappings' => ['properties' => $mapperMap]]]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->save($mapper);
    }

    /**
     * Проверяет, что объект обновит существующий индекс.
     *
     * @throws \Throwable
     */
    public function testSaveExistedIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->willReturn([$mapperName => ['aliases' => []]]);
        $indices->expects($this->once())
            ->method('putMapping')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'body' => ['properties' => $mapperMap]]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->save($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при сохранении.
     *
     * @throws \Throwable
     */
    public function testSaveException(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->save($mapper);
    }

    /**
     * Проверяет, что объект закроет индекс.
     *
     * @throws \Throwable
     */
    public function testCloseIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('close')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'ignore_unavailable' => true]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->close($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при закрытии индекса.
     *
     * @throws \Throwable
     */
    public function testCloseException(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->close($mapper);
    }

    /**
     * Проверяет, что объект откроет индекс.
     *
     * @throws \Throwable
     */
    public function testOpenIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('open')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'ignore_unavailable' => true]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->open($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при открытии индекса.
     *
     * @throws \Throwable
     */
    public function testOpenException(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->open($mapper);
    }

    /**
     * Проверяет, что объект обновит индекс.
     *
     * @throws \Throwable
     */
    public function testRefreshIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('refresh')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'ignore_unavailable' => true]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->refresh($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при обновлении индекса.
     *
     * @throws \Throwable
     */
    public function testRefreshException(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->refresh($mapper);
    }

    /**
     * Проверяет, что объект удали индекс.
     *
     * @throws \Throwable
     */
    public function testDeleteIndex(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('delete')
            ->with(
                $this->identicalTo(
                    ['index' => $mapperName, 'ignore_unavailable' => true]
                )
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->delete($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при удалении индекса.
     *
     * @throws \Throwable
     */
    public function testDeleteIndexException(): void
    {
        $mapperName = $this->createFakeData()->word;
        $mapperMap = [$this->createFakeData()->word => $this->createFakeData()->word];

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);
        $mapper->method('getMappingProperties')->willReturn($mapperMap);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->delete($mapper);
    }

    /**
     * Проверяет, что объект правильно получит статус заморозки индекса.
     *
     * @throws \Throwable
     */
    public function testIsFrozen(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->willReturn(
            [
                $mapperName => [
                    'aliases' => [],
                    'settings' => [
                        'index' => [
                            'frozen' => 'true',
                        ],
                    ],
                ],
            ]
        );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);

        $this->assertTrue($builder->isFrozen($mapper));
    }

    /**
     * Проверяет, что объект правильно получит статус заморозки индекса.
     *
     * @throws \Throwable
     */
    public function testIsNotFrozen(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->willReturn(
            [
                $mapperName => [
                    'aliases' => [],
                    'settings' => [
                        'index' => [
                            'frozen' => 'false',
                        ],
                    ],
                ],
            ]
        );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);

        $this->assertFalse($builder->isFrozen($mapper));
    }

    /**
     * Проверяет, что объект правильно получит статус заморозки индекса.
     *
     * @throws \Throwable
     */
    public function testIsFrozenException(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->method('get')->willReturn([]);

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->isFrozen($mapper);
    }

    /**
     * Проверяет, что объект заморозит индекс.
     *
     * @throws \Throwable
     */
    public function testFreezeIndex(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('freeze')
            ->with(
                $this->identicalTo(['index' => $mapperName])
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->freeze($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при заморозке индекса.
     *
     * @throws \Throwable
     */
    public function testFreezeIndexException(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->freeze($mapper);
    }

    /**
     * Проверяет, что объект разморозит индекс.
     *
     * @throws \Throwable
     */
    public function testUnfreezeIndex(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $indices = $this->getMockBuilder(IndicesNamespace::class)->disableOriginalConstructor()->getMock();
        $indices->expects($this->once())
            ->method('unfreeze')
            ->with(
                $this->identicalTo(['index' => $mapperName])
            );

        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->method('indices')->willReturn($indices);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->willReturn($client);

        $builder = new BaseIndexBuilder($clientProvider);
        $builder->unfreeze($mapper);
    }

    /**
     * Проверяет, что объект перехватит исключение при разморозке индекса.
     *
     * @throws \Throwable
     */
    public function testUnfreezeIndexException(): void
    {
        $mapperName = $this->createFakeData()->word;

        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper->method('getName')->willReturn($mapperName);

        $clientProvider = $this->getMockBuilder(ClientProvider::class)->getMock();
        $clientProvider->method('provide')->will($this->throwException(new \RuntimeException()));

        $builder = new BaseIndexBuilder($clientProvider);

        $this->expectException(IndexBuilderException::class);
        $builder->unfreeze($mapper);
    }
}
