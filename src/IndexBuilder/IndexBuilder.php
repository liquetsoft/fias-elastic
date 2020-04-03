<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexBuilder;

use Liquetsoft\Fias\Elastic\Exception\IndexBuilderException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Объект, который обновляет описание индексов из хранилища в elasticsearch.
 */
interface IndexBuilder
{
    /**
     * Создает или обеовляет индекс в эластике согласно описанию.
     *
     * @param IndexMapperInterface $indexMapper
     *
     * @throws IndexBuilderException
     */
    public function save(IndexMapperInterface $indexMapper): void;

    /**
     * Закрывает индекс.
     *
     * @param IndexMapperInterface $indexMapper
     *
     * @throws IndexBuilderException
     */
    public function close(IndexMapperInterface $indexMapper): void;

    /**
     * Открывает индекс.
     *
     * @param IndexMapperInterface $indexMapper
     *
     * @throws IndexBuilderException
     */
    public function open(IndexMapperInterface $indexMapper): void;
}
