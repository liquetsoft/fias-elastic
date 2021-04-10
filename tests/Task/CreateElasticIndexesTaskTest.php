<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Task\CreateElasticIndexesTask;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тест для операции, которая создает индексы в elasticsearch.
 *
 * @internal
 */
class CreateElasticIndexesTaskTest extends BaseCase
{
    /**
     * Проверяет, что операция создаст все индексы.
     *
     * @throws Throwable
     */
    public function testRun(): void
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $mapperRegistry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $mapperRegistry->method('getAllMappers')->willReturn([$mapper, $mapper1]);

        $indexBuilder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $savedIndicies = [];
        $indexBuilder->method('save')->willReturnCallback(
            function (IndexMapperInterface $index) use (&$savedIndicies): void {
                $savedIndicies[] = $index;
            }
        );

        $state = $this->getMockBuilder(State::class)->getMock();

        $task = new CreateElasticIndexesTask($mapperRegistry, $indexBuilder);
        $task->run($state);

        $this->assertSame(
            [
                $mapper,
                $mapper1,
            ],
            $savedIndicies
        );
    }
}
