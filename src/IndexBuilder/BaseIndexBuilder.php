<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexBuilder;

use Elasticsearch\Client;
use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\Exception\IndexBuilderException;
use Liquetsoft\Fias\Elastic\IndexMapperInterface;
use Throwable;

/**
 * Объект, который использует клиент elasticsearch и хранилище описания индексов для обновления описания индексов.
 */
class BaseIndexBuilder implements IndexBuilder
{
    private ClientProvider $clientProvider;

    private ?Client $client = null;

    public function __construct(ClientProvider $clientProvider)
    {
        $this->clientProvider = $clientProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function save(IndexMapperInterface $indexMapper): void
    {
        try {
            $client = $this->getClient();
            if ($this->hasIndex($indexMapper)) {
                $client->indices()->putMapping(
                    [
                        'index' => $indexMapper->getName(),
                        'body' => [
                            'properties' => $indexMapper->getMappingProperties(),
                        ],
                    ]
                );
            } else {
                $client->indices()->create(
                    [
                        'index' => $indexMapper->getName(),
                        'body' => [
                            'mappings' => [
                                'properties' => $indexMapper->getMappingProperties(),
                            ],
                        ],
                    ]
                );
            }
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function close(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->close(
                [
                    'index' => $indexMapper->getName(),
                    'ignore_unavailable' => true,
                ]
            );
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function open(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->open(
                [
                    'index' => $indexMapper->getName(),
                    'ignore_unavailable' => true,
                ]
            );
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refresh(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->refresh(
                [
                    'index' => $indexMapper->getName(),
                    'ignore_unavailable' => true,
                ]
            );
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function delete(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->delete(
                [
                    'index' => $indexMapper->getName(),
                    'ignore_unavailable' => true,
                ]
            );
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasIndex(IndexMapperInterface $indexMapper): bool
    {
        $indices = $this->getListOfIndices();

        return isset($indices[$indexMapper->getName()]);
    }

    /**
     * Возвращает список всех индексов elasticsearch.
     *
     * @return array
     */
    private function getListOfIndices(): array
    {
        return $this->getClient()->indices()->get(
            [
                'index' => '_all',
            ]
        );
    }

    /**
     * Возвращает объект клиента elasticsearch из провайдера.
     *
     * @return Client
     */
    private function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = $this->clientProvider->provide();
        }

        return $this->client;
    }
}
