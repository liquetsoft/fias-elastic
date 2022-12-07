<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по истории изменений.
 */
class ChangeHistory
{
    /**
     * ID изменившей транзакции.
     */
    protected int $changeid = 0;

    /**
     * Уникальный ID объекта.
     */
    protected int $objectid = 0;

    /**
     * Уникальный ID изменившей транзакции (GUID).
     */
    protected string $adrobjectid = '';

    /**
     * Тип операции.
     */
    protected int $opertypeid = 0;

    /**
     * ID документа.
     */
    protected ?int $ndocid = null;

    /**
     * Дата изменения.
     */
    protected ?\DateTimeInterface $changedate = null;

    public function setChangeid(int $changeid): self
    {
        $this->changeid = $changeid;

        return $this;
    }

    public function getChangeid(): int
    {
        return $this->changeid;
    }

    public function setObjectid(int $objectid): self
    {
        $this->objectid = $objectid;

        return $this;
    }

    public function getObjectid(): int
    {
        return $this->objectid;
    }

    public function setAdrobjectid(string $adrobjectid): self
    {
        $this->adrobjectid = $adrobjectid;

        return $this;
    }

    public function getAdrobjectid(): string
    {
        return $this->adrobjectid;
    }

    public function setOpertypeid(int $opertypeid): self
    {
        $this->opertypeid = $opertypeid;

        return $this;
    }

    public function getOpertypeid(): int
    {
        return $this->opertypeid;
    }

    public function setNdocid(?int $ndocid): self
    {
        $this->ndocid = $ndocid;

        return $this;
    }

    public function getNdocid(): ?int
    {
        return $this->ndocid;
    }

    public function setChangedate(\DateTimeInterface $changedate): self
    {
        $this->changedate = $changedate;

        return $this;
    }

    public function getChangedate(): ?\DateTimeInterface
    {
        return $this->changedate;
    }
}
