<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения по номерам домов улиц городов и населенных пунктов.
 */
class Houses
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
     * Основной номер дома.
     */
    protected ?string $housenum = null;

    /**
     * Дополнительный номер дома 1.
     */
    protected ?string $addnum1 = null;

    /**
     * Дополнительный номер дома 1.
     */
    protected ?string $addnum2 = null;

    /**
     * Основной тип дома.
     */
    protected ?int $housetype = null;

    /**
     * Дополнительный тип дома 1.
     */
    protected ?int $addtype1 = null;

    /**
     * Дополнительный тип дома 2.
     */
    protected ?int $addtype2 = null;

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
    protected ?DateTimeInterface $updatedate = null;

    /**
     * Начало действия записи.
     */
    protected ?DateTimeInterface $startdate = null;

    /**
     * Окончание действия записи.
     */
    protected ?DateTimeInterface $enddate = null;

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

    public function setHousenum(?string $housenum): self
    {
        $this->housenum = $housenum;

        return $this;
    }

    public function getHousenum(): ?string
    {
        return $this->housenum;
    }

    public function setAddnum1(?string $addnum1): self
    {
        $this->addnum1 = $addnum1;

        return $this;
    }

    public function getAddnum1(): ?string
    {
        return $this->addnum1;
    }

    public function setAddnum2(?string $addnum2): self
    {
        $this->addnum2 = $addnum2;

        return $this;
    }

    public function getAddnum2(): ?string
    {
        return $this->addnum2;
    }

    public function setHousetype(?int $housetype): self
    {
        $this->housetype = $housetype;

        return $this;
    }

    public function getHousetype(): ?int
    {
        return $this->housetype;
    }

    public function setAddtype1(?int $addtype1): self
    {
        $this->addtype1 = $addtype1;

        return $this;
    }

    public function getAddtype1(): ?int
    {
        return $this->addtype1;
    }

    public function setAddtype2(?int $addtype2): self
    {
        $this->addtype2 = $addtype2;

        return $this;
    }

    public function getAddtype2(): ?int
    {
        return $this->addtype2;
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

    public function setUpdatedate(DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): ?DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setStartdate(DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getStartdate(): ?DateTimeInterface
    {
        return $this->startdate;
    }

    public function setEnddate(DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getEnddate(): ?DateTimeInterface
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
