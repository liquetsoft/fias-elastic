<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень кодов операций над адресными объектами.
 */
class OperationStatus implements EntityInterface
{
    /** @var int */
    private $operstatid = 0;

    /** @var string */
    private $name = '';

    public function setOperstatid(int $operstatid): self
    {
        $this->operstatid = $operstatid;

        return $this;
    }

    public function getOperstatid(): int
    {
        return $this->operstatid;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchIndex(): string
    {
        return 'operationstatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchId(): string
    {
        return (string) $this->operstatid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchData(): array
    {
        return [
            'operstatid' => $this->operstatid,
            'name' => $this->name,
        ];
    }
}
