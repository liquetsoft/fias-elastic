<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень статусов актуальности записи адресного элемента по ФИАС.
 */
class ActualStatus implements EntityInterface
{
    /** @var int */
    private $actstatid = 0;

    /** @var string */
    private $name = '';

    public function setActstatid(int $actstatid): self
    {
        $this->actstatid = $actstatid;

        return $this;
    }

    public function getActstatid(): int
    {
        return $this->actstatid;
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
        return 'ActualStatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->actstatid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'actstatid' => $this->actstatid,
            'name' => $this->name,
        ];
    }
}
