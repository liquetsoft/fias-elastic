<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Task;

use Liquetsoft\Fias\Component\Pipeline\State\State;
use Liquetsoft\Fias\Component\Pipeline\Task\Task;
use Liquetsoft\Fias\Elastic\IndexBuilder\IndexBuilder;

/**
 * Операция для обновления индексов elasticsearch.
 */
class RefreshIndicesMappingTask implements Task
{
    /**
     * @var IndexBuilder
     */
    private $indexBuilder;

    /**
     * @param IndexBuilder $indexBuilder
     */
    public function __construct(IndexBuilder $indexBuilder)
    {
        $this->indexBuilder = $indexBuilder;
    }

    /**
     * @inheritDoc
     */
    public function run(State $state): void
    {
        $this->indexBuilder->refresh();
    }
}
