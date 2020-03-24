<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень типов помещения или офиса.
 */
class FlatType implements EntityInterface
{
    /** @var int */
    private $fltypeid = 0;

    /** @var string */
    private $name = '';

    /** @var string */
    private $shortname = '';

    public function setFltypeid(int $fltypeid): self
    {
        $this->fltypeid = $fltypeid;

        return $this;
    }

    public function getFltypeid(): int
    {
        return $this->fltypeid;
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

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname(): string
    {
        return $this->shortname;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'FlatType';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->fltypeid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'fltypeid' => $this->fltypeid,
            'name' => $this->name,
            'shortname' => $this->shortname,
        ];
    }
}
