<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Component\Pipeline\Task\Task;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;

/**
 * Операция, которая помечает все индексы заморожеными.
 */
class FreezeElasticIndiciesTask implements Task
{
    private IndexMapperRegistry $registry;

    private IndexBuilder $builder;

    public function __construct(IndexMapperRegistry $registry, IndexBuilder $builder)
    {
        $this->registry = $registry;
        $this->builder = $builder;
    }

    /**
     * {@inheritDoc}
     */
    public function run(State $state): void
    {
        $mappers = $this->registry->getAllMappers();

        foreach ($mappers as $mapper) {
            if (!$this->builder->isFrozen($mapper)) {
                $this->builder->freeze($mapper);
            }
        }
    }
}
