<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;
use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования.
 */
class NormativeDocument implements EntityInterface
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

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'NormativeDocument';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return $this->normdocid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'normdocid' => $this->normdocid,
            'docname' => $this->docname,
            'docdate' => $this->docdate ? $this->docdate->format(DateTimeInterface::ATOM) : null,
            'docnum' => $this->docnum,
            'doctype' => $this->doctype,
        ];
    }
}
