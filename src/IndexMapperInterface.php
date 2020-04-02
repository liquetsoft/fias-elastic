<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic;

/**
 * Интерфейс для объекта, который предоставляет данные для маппинга индекса elasticsearch.
 */
interface IndexMapperInterface
{
    /**
     * Возвращает имя индекса.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Возвращает описание индекса.
     *
     * @return array
     */
    public function getMap(): array;
}
