<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по уровням адресных объектов.
 */
class ObjectLevels
{
    /**
     * Уникальный идентификатор записи. Ключевое поле. Номер уровня объекта.
     */
    protected int $level = 0;

    /**
     * Наименование.
     */
    protected string $name = '';

    /**
     * Краткое наименование.
     */
    protected ?string $shortname = null;

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
     * Признак действующего адресного объекта.
     */
    protected string $isactive = '';

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
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

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
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
