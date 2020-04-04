<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования.
 */
class NormativeDocument
{
    /** @var string */
    private $normdocid = '';

    /** @var string|null */
    private $docname;

    /** @var DateTimeInterface|null */
    private $docdate;

    /** @var string|null */
    private $docnum;

    /** @var string */
    private $doctype = '';

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

    public function setDoctype(string $doctype): self
    {
        $this->doctype = $doctype;

        return $this;
    }

    public function getDoctype(): string
    {
        return $this->doctype;
    }
}
