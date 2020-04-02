<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\ClientProvider;

use Elasticsearch\Client;

/**
 * Провайдер, который возвращает клиента, переданного через DI.
 */
class DIProvider implements ClientProvider
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function provide(): Client
    {
        return $this->client;
    }
}
