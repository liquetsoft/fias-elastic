<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexBuilder;

use Liquetsoft\Fias\Elastic\ClientProvider\ClientProvider;
use Liquetsoft\Fias\Elastic\IndexMapperRegistry\IndexMapperRegistry;

/**
 * Объект, который использует клиент elasticsearch и хранилище описания индексов для обновления описания индексов.
 */
class BaseIndexBuilder implements IndexBuilder
{
    /**
     * @var ClientProvider
     */
    private $clientProvider;

    /**
     * @var IndexMapperRegistry
     */
    private $indexMapperRegistry;

    /**
     * @param ClientProvider      $clientProvider
     * @param IndexMapperRegistry $indexMapperRegistry
     */
    public function __construct(ClientProvider $clientProvider, IndexMapperRegistry $indexMapperRegistry)
    {
        $this->clientProvider = $clientProvider;
        $this->indexMapperRegistry = $indexMapperRegistry;
    }

    /**
     * @inheritDoc
     */
    public function refresh(): void
    {
        $indices = $this->clientProvider->provide()->indices();

        $indicesInElastic = $indices->get([
            'index' => '_all',
            'allow_no_indices' => true,
        ]);

        $neededIndices = $this->indexMapperRegistry->getAllMappers();
        foreach ($neededIndices as $index) {
            if (isset($indicesInElastic[$index->getName()])) {
                $indices->putMapping([
                    'index' => $index->getName(),
                    'body' => [
                        'properties' => $index->getMappingProperties(),
                    ],
                ]);
            } else {
                $indices->create([
                    'index' => $index->getName(),
                    'body' => [
                        'mappings' => [
                            'properties' => $index->getMappingProperties(),
                        ],
                    ],
                ]);
            }
        }
    }
}
