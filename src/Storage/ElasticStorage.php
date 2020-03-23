<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Storage;

use Liquetsoft\Fias\Component\Storage\Storage;

/**
 * Объект, который сохраняет данные ФИАС с помощью Elastic search.
 */
class ElasticStorage implements Storage
{
    /**
     * @inheritDoc
     */
    public function start(): void
    {
        // TODO: Implement start() method.
    }

    /**
     * @inheritDoc
     */
    public function stop(): void
    {
        // TODO: Implement stop() method.
    }

    /**
     * @inheritDoc
     */
    public function insert(object $entity): void
    {
        // TODO: Implement insert() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(object $entity): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritDoc
     */
    public function upsert(object $entity): void
    {
        // TODO: Implement upsert() method.
    }

    /**
     * @inheritDoc
     */
    public function truncate(string $entityClassName): void
    {
        // TODO: Implement truncate() method.
    }
}
