<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по типам нормативных документов.
 */
class NormativeDocsTypes
{
    /**
     * Идентификатор записи.
     */
    protected int $id = 0;

    /**
     * Наименование.
     */
    protected string $name = '';

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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
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
