<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\ClientProvider;

use Elasticsearch\Client;
use RuntimeException;

/**
 * Интерфейс для объекта, который предоставляет клмент elasticsearch для библиотеки.
 */
interface ClientProvider
{
    /**
     * Возвращает клиент или выбрасывает исключение.
     *
     * @return Client
     *
     * @throws RuntimeException
     */
    public function provide(): Client;
}
