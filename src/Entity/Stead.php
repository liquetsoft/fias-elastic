<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения о земельных участках.
 */
class Stead
{
    /** @var string */
    protected $steadguid = '';

    /** @var string|null */
    protected $number;

    /** @var string */
    protected $regioncode = '';

    /** @var string|null */
    protected $postalcode;

    /** @var string */
    protected $ifnsfl = '';

    /** @var string */
    protected $ifnsul = '';

    /** @var string */
    protected $okato = '';

    /** @var string */
    protected $oktmo = '';

    /** @var string|null */
    protected $parentguid;

    /** @var string|null */
    protected $steadid;

    /** @var string */
    protected $operstatus = '';

    /** @var DateTimeInterface */
    protected $startdate;

    /** @var DateTimeInterface */
    protected $enddate;

    /** @var DateTimeInterface */
    protected $updatedate;

    /** @var string */
    protected $livestatus = '';

    /** @var string */
    protected $divtype = '';

    /** @var string|null */
    protected $normdoc;

    public function setSteadguid(string $steadguid): self
    {
        $this->steadguid = $steadguid;

        return $this;
    }

    public function getSteadguid(): string
    {
        return $this->steadguid;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setRegioncode(string $regioncode): self
    {
        $this->regioncode = $regioncode;

        return $this;
    }

    public function getRegioncode(): string
    {
        return $this->regioncode;
    }

    public function setPostalcode(?string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setIfnsfl(string $ifnsfl): self
    {
        $this->ifnsfl = $ifnsfl;

        return $this;
    }

    public function getIfnsfl(): string
    {
        return $this->ifnsfl;
    }

    public function setIfnsul(string $ifnsul): self
    {
        $this->ifnsul = $ifnsul;

        return $this;
    }

    public function getIfnsul(): string
    {
        return $this->ifnsul;
    }

    public function setOkato(string $okato): self
    {
        $this->okato = $okato;

        return $this;
    }

    public function getOkato(): string
    {
        return $this->okato;
    }

    public function setOktmo(string $oktmo): self
    {
        $this->oktmo = $oktmo;

        return $this;
    }

    public function getOktmo(): string
    {
        return $this->oktmo;
    }

    public function setParentguid(?string $parentguid): self
    {
        $this->parentguid = $parentguid;

        return $this;
    }

    public function getParentguid(): ?string
    {
        return $this->parentguid;
    }

    public function setSteadid(?string $steadid): self
    {
        $this->steadid = $steadid;

        return $this;
    }

    public function getSteadid(): ?string
    {
        return $this->steadid;
    }

    public function setOperstatus(string $operstatus): self
    {
        $this->operstatus = $operstatus;

        return $this;
    }

    public function getOperstatus(): string
    {
        return $this->operstatus;
    }

    public function setStartdate(DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getStartdate(): DateTimeInterface
    {
        return $this->startdate;
    }

    public function setEnddate(DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getEnddate(): DateTimeInterface
    {
        return $this->enddate;
    }

    public function setUpdatedate(DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setLivestatus(string $livestatus): self
    {
        $this->livestatus = $livestatus;

        return $this;
    }

    public function getLivestatus(): string
    {
        return $this->livestatus;
    }

    public function setDivtype(string $divtype): self
    {
        $this->divtype = $divtype;

        return $this;
    }

    public function getDivtype(): string
    {
        return $this->divtype;
    }

    public function setNormdoc(?string $normdoc): self
    {
        $this->normdoc = $normdoc;

        return $this;
    }

    public function getNormdoc(): ?string
    {
        return $this->normdoc;
    }
}
