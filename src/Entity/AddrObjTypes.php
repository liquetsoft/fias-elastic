<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения по типам адресных объектов.
 */
class AddrObjTypes
{
    /**
     * Идентификатор записи.
     */
    protected int $id = 0;

    /**
     * Уровень адресного объекта.
     */
    protected int $level = 0;

    /**
     * Краткое наименование типа объекта.
     */
    protected string $shortname = '';

    /**
     * Полное наименование типа объекта.
     */
    protected string $name = '';

    /**
     * Описание.
     */
    protected ?string $desc = null;

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
     * Статус активности.
     */
    protected string $isactive = '';

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDesc(?string $desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    public function getDesc(): ?string
    {
        return $this->desc;
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

    public function setIsactive(string $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getIsactive(): string
    {
        return $this->isactive;
    }
}
