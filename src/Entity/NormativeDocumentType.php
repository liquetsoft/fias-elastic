<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Тип нормативного документа.
 */
class NormativeDocumentType
{
    /**
     * Идентификатор записи (ключ).
     */
    protected int $ndtypeid = 0;

    /**
     * Наименование типа нормативного документа.
     */
    protected string $name = '';

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
