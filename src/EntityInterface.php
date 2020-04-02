<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic;

/**
 * Интерфейс для объекта, который представляет документ в elastic search.
 */
interface EntityInterface
{
    /**
     * Возвращает тип документа.
     *
     * @return string
     */
    public function getElasticSearchIndex(): string;

    /**
     * Возвращает уникальный идентификатор документа.
     *
     * @return string
     */
    public function getElasticSearchId(): string;

    /**
     * Возвращает массив данных для индексирования.
     *
     * @return array
     */
    public function getElasticSearchData(): array;
}
