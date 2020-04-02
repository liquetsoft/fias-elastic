<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexBuilder;

/**
 * Объект, который обновляет описание индексов из хранилища в elasticsearch.
 */
interface IndexBuilder
{
    /**
     * Обновляет описание всех индексов, о которых знает builder.
     */
    public function refresh(): void;
}
