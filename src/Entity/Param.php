<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения о классификаторе параметров адресообразующих элементов и объектов недвижимости.
 */
class Param
{
    /**
     * Идентификатор записи.
     */
    protected int $id = 0;

    /**
     * Глобальный уникальный идентификатор адресного объекта.
     */
    protected int $objectid = 0;

    /**
     * ID изменившей транзакции.
     */
    protected ?int $changeid = null;

    /**
     * ID завершившей транзакции.
     */
    protected int $changeidend = 0;

    /**
     * Тип параметра.
     */
    protected int $typeid = 0;

    /**
     * Значение параметра.
     */
    protected string $value = '';

    /**
     * Дата внесения (обновления) записи.
     */
    protected ?\DateTimeInterface $updatedate = null;

    /**
     * Дата начала действия записи.
     */
    protected ?\DateTimeInterface $startdate = null;

    /**
     * Дата окончания действия записи.
     */
    protected ?\DateTimeInterface $enddate = null;

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

    public function setChangeid(?int $changeid): self
    {
        $this->changeid = $changeid;

        return $this;
    }

    public function getChangeid(): ?int
    {
        return $this->changeid;
    }

    public function setChangeidend(int $changeidend): self
    {
        $this->changeidend = $changeidend;

        return $this;
    }

    public function getChangeidend(): int
    {
        return $this->changeidend;
    }

    public function setTypeid(int $typeid): self
    {
        $this->typeid = $typeid;

        return $this;
    }

    public function getTypeid(): int
    {
        return $this->typeid;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
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
}
