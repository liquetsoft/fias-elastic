<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Mock;

/**
 * Объект мока сущности для тестов.
 */
class ElasticStorageMock
{
    /**
     * @var string
     */
    private $id = 'ElasticStorageMock_id';

    /**
     * @var string
     */
    private $payload = 'ElasticStorageMock_payload';

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }
}
