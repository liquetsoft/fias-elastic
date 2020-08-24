<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования.
 */
class NormativeDocument
{
    /**
     * Идентификатор нормативного документа.
     */
    protected string $normdocid = '';

    /**
     * Наименование документа.
     */
    protected ?string $docname = null;

    /**
     * Дата документа.
     */
    protected ?DateTimeInterface $docdate = null;

    /**
     * Номер документа.
     */
    protected ?string $docnum = null;

    /**
     * Тип документа.
     */
    protected int $doctype = 0;

    /**
     * Идентификатор образа (внешний ключ).
     */
    protected ?string $docimgid = null;

    public function setNormdocid(string $normdocid): self
    {
        $this->normdocid = $normdocid;

        return $this;
    }

    public function getNormdocid(): string
    {
        return $this->normdocid;
    }

    public function setDocname(?string $docname): self
    {
        $this->docname = $docname;

        return $this;
    }

    public function getDocname(): ?string
    {
        return $this->docname;
    }

    public function setDocdate(?DateTimeInterface $docdate): self
    {
        $this->docdate = $docdate;

        return $this;
    }

    public function getDocdate(): ?DateTimeInterface
    {
        return $this->docdate;
    }

    public function setDocnum(?string $docnum): self
    {
        $this->docnum = $docnum;

        return $this;
    }

    public function getDocnum(): ?string
    {
        return $this->docnum;
    }

    public function setDoctype(int $doctype): self
    {
        $this->doctype = $doctype;

        return $this;
    }

    public function getDoctype(): int
    {
        return $this->doctype;
    }

    public function setDocimgid(?string $docimgid): self
    {
        $this->docimgid = $docimgid;

        return $this;
    }

    public function getDocimgid(): ?string
    {
        return $this->docimgid;
    }
}
