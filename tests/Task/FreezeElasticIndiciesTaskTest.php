<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;
use Liquetsoft\Fias\Elastic\Task\FreezeElasticIndiciesTask;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тест для операции, которая помечает индексы заморожеными.
 */
class FreezeElasticIndiciesTaskTest extends BaseCase
{
    /**
     * Проверяет, что операция заморозит все индексы.
     *
     * @throws Throwable
     */
    public function testRun()
    {
        $mapper = $this->getMockBuilder(IndexMapperInterface::class)->getMock();
        $mapper1 = $this->getMockBuilder(IndexMapperInterface::class)->getMock();

        $mapperRegistry = $this->getMockBuilder(IndexMapperRegistry::class)->getMock();
        $mapperRegistry->method('getAllMappers')->will($this->returnValue([$mapper, $mapper1]));

        $indexBuilder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $indexBuilder->method('isFrozen')->willReturn(false);
        $freezedIndicies = [];
        $indexBuilder->method('freeze')->willReturnCallback(
            function ($index) use (&$freezedIndicies) {
                $freezedIndicies[] = $index;
            }
        );

        $state = $this->getMockBuilder(State::class)->getMock();

        $task = new FreezeElasticIndiciesTask($mapperRegistry, $indexBuilder);
        $task->run($state);

        $this->assertSame(
            [
                $mapper,
                $mapper1,
            ],
            $freezedIndicies
        );
    }
}
