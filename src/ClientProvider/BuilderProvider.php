<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\ClientProvider;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use RuntimeException;

/**
 * Провайдер, который создает новый клиент.
 */
class BuilderProvider implements ClientProvider
{
    private array $hosts;

    private ?Client $client = null;

    public function __construct(array $hosts = [])
    {
        $this->hosts = $hosts;
    }

    /**
     * @inheritDoc
     */
    public function provide(): Client
    {
        if ($this->client === null) {
            $this->client = $this->createNewClient();
        }

        if (!($this->client instanceof Client)) {
            throw new RuntimeException("Can't provide any client for elasticsearch.");
        }

        return $this->client;
    }

    /**
     * Пробует создать нового клиента по настройкам.
     *
     * @return Client
     */
    private function createNewClient(): Client
    {
        return ClientBuilder::create()->setHosts($this->hosts)->build();
    }
}
