<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень возможных значений интервалов домов (обычный, четный, нечетный).
 */
class IntervalStatus implements EntityInterface
{
    /** @var int */
    private $intvstatid = 0;

    /** @var string */
    private $name = '';

    public function setIntvstatid(int $intvstatid): self
    {
        $this->intvstatid = $intvstatid;

        return $this;
    }

    public function getIntvstatid(): int
    {
        return $this->intvstatid;
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
        return 'IntervalStatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->intvstatid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'intvstatid' => $this->intvstatid,
            'name' => $this->name,
        ];
    }
}
