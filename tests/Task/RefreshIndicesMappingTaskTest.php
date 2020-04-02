<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\Task\RefreshIndicesMappingTask;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тесты для операции, которая обновляет индексы elasticsearch.
 */
class RefreshIndicesMappingTaskTest extends BaseCase
{
    /**
     * Проверяет, что операция запустит обновления индексов.
     *
     * @throws Throwable
     */
    public function testRun()
    {
        $builder = $this->getMockBuilder(IndexBuilder::class)->getMock();
        $builder->expects($this->once())->method('refresh');
        $state = $this->getMockBuilder(State::class)->getMock();

        $task = new RefreshIndicesMappingTask($builder);
        $task->run($state);
    }
}
