<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Task\OpenElasticIndicesTask;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;

/**
 * Тест для операции, которая помечает индексы открытыми для записи.
 *
 * @internal
 */
class OpenElasticIndicesTaskTest extends BaseCase
{
    /**
     * Проверяет, что операция откроет все индексы.
     *
     * @throws \Throwable
     */
    public function testRun(): void
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $mapperRegistry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $mapperRegistry->method('getAllMappers')->willReturn([$mapper, $mapper1]);

        $indexBuilder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $openedIndicies = [];
        $indexBuilder->method('open')->willReturnCallback(
            function (IndexMapperInterface $index) use (&$openedIndicies): void {
                $openedIndicies[] = $index;
            }
        );

        $state = $this->getMockBuilder(State::class)->getMock();

        $task = new OpenElasticIndicesTask($mapperRegistry, $indexBuilder);
        $task->run($state);

        $this->assertSame(
            [
                $mapper,
                $mapper1,
            ],
            $openedIndicies
        );
    }
}
