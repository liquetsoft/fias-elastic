<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по машино-местам.
 */
class Carplaces
{
    /**
     * Уникальный идентификатор записи. Ключевое поле.
     */
    protected int $id = 0;

    /**
     * Глобальный уникальный идентификатор объекта типа INTEGER.
     */
    protected int $objectid = 0;

    /**
     * Глобальный уникальный идентификатор адресного объекта типа UUID.
     */
    protected string $objectguid = '';

    /**
     * ID изменившей транзакции.
     */
    protected int $changeid = 0;

    /**
     * Номер машиноместа.
     */
    protected string $number = '';

    /**
     * Статус действия над записью – причина появления записи.
     */
    protected int $opertypeid = 0;

    /**
     * Идентификатор записи связывания с предыдущей исторической записью.
     */
    protected ?int $previd = null;

    /**
     * Идентификатор записи связывания с последующей исторической записью.
     */
    protected ?int $nextid = null;

    /**
     * Дата внесения (обновления) записи.
     */
    protected ?\DateTimeInterface $updatedate = null;

    /**
     * Начало действия записи.
     */
    protected ?\DateTimeInterface $startdate = null;

    /**
     * Окончание действия записи.
     */
    protected ?\DateTimeInterface $enddate = null;

    /**
     * Статус актуальности адресного объекта ФИАС.
     */
    protected int $isactual = 0;

    /**
     * Признак действующего адресного объекта.
     */
    protected int $isactive = 0;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function setObjectguid(string $objectguid): self
    {
        $this->objectguid = $objectguid;

        return $this;
    }

    public function getObjectguid(): string
    {
        return $this->objectguid;
    }

    public function setChangeid(int $changeid): self
    {
        $this->changeid = $changeid;

        return $this;
    }

    public function getChangeid(): int
    {
        return $this->changeid;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
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

    public function setPrevid(?int $previd): self
    {
        $this->previd = $previd;

        return $this;
    }

    public function getPrevid(): ?int
    {
        return $this->previd;
    }

    public function setNextid(?int $nextid): self
    {
        $this->nextid = $nextid;

        return $this;
    }

    public function getNextid(): ?int
    {
        return $this->nextid;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setIsactual(int $isactual): self
    {
        $this->isactual = $isactual;

        return $this;
    }

    public function getIsactual(): int
    {
        return $this->isactual;
    }

    public function setIsactive(int $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getIsactive(): int
    {
        return $this->isactive;
    }
}
