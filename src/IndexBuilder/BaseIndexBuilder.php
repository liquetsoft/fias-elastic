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

    private ?array $listOfIndicies = null;

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
            $this->listOfIndicies = null;
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
            $this->listOfIndicies = null;
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
            $this->listOfIndicies = null;
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
            $this->listOfIndicies = null;
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isFrozen(IndexMapperInterface $indexMapper): bool
    {
        $description = $this->getIndexDescription($indexMapper);

        if ($description === null) {
            $message = sprintf("Index with name '%s' not found.", $indexMapper->getName());
            throw new IndexBuilderException($message);
        }

        return !empty($description['settings']['index']['frozen'])
            && $description['settings']['index']['frozen'] === 'true';
    }

    /**
     * {@inheritDoc}
     */
    public function freeze(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->freeze(
                [
                    'index' => $indexMapper->getName(),
                ]
            );
            $this->listOfIndicies = null;
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unfreeze(IndexMapperInterface $indexMapper): void
    {
        try {
            $this->getClient()->indices()->unfreeze(
                [
                    'index' => $indexMapper->getName(),
                ]
            );
            $this->listOfIndicies = null;
        } catch (Throwable $e) {
            throw new IndexBuilderException($e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasIndex(IndexMapperInterface $indexMapper): bool
    {
        return $this->getIndexDescription($indexMapper) !== null;
    }

    /**
     * Возвращает массив с описанием указанного индекса или null, если индекс
     * не найден.
     *
     * @param IndexMapperInterface $indexMapper
     *
     * @return array|null
     */
    private function getIndexDescription(IndexMapperInterface $indexMapper): ?array
    {
        $indices = $this->getListOfIndices();

        return $indices[$indexMapper->getName()] ?? null;
    }

    /**
     * Возвращает список всех индексов elasticsearch.
     *
     * @return array
     */
    private function getListOfIndices(): array
    {
        if ($this->listOfIndicies === null) {
            $this->listOfIndicies = $this->getClient()->indices()->get(
                [
                    'index' => '_all',
                ]
            );
        }

        return $this->listOfIndicies;
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
