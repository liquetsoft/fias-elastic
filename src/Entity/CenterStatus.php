<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень возможных статусов (центров) адресных объектов административных единиц.
 */
class CenterStatus implements EntityInterface
{
    /** @var int */
    private $centerstid = 0;

    /** @var string */
    private $name = '';

    public function setCenterstid(int $centerstid): self
    {
        $this->centerstid = $centerstid;

        return $this;
    }

    public function getCenterstid(): int
    {
        return $this->centerstid;
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
    public function getElasticSearchDocumentType(): string
    {
        return 'CenterStatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->centerstid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'centerstid' => $this->centerstid,
            'name' => $this->name,
        ];
    }
}
