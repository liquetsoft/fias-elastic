<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Типы нормативных документов.
 */
class NormativeDocumentType
{
    /** @var int */
    protected $ndtypeid = 0;

    /** @var string */
    protected $name = '';

    public function setNdtypeid(int $ndtypeid): self
    {
        $this->ndtypeid = $ndtypeid;

        return $this;
    }

    public function getNdtypeid(): int
    {
        return $this->ndtypeid;
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
}
