<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Элементы адреса, идентифицирующие адресуемые объекты.
 */
class House
{
    protected string $houseid = '';
    protected ?string $houseguid = null;
    protected ?string $aoguid = null;
    protected ?string $housenum = null;
    protected int $strstatus = 0;
    protected int $eststatus = 0;
    protected int $statstatus = 0;
    protected ?string $ifnsfl = null;
    protected ?string $ifnsul = null;
    protected ?string $okato = null;
    protected ?string $oktmo = null;
    protected ?string $postalcode = null;
    protected ?DateTimeInterface $startdate = null;
    protected ?DateTimeInterface $enddate = null;
    protected ?DateTimeInterface $updatedate = null;
    protected int $counter = 0;
    protected int $divtype = 0;

    public function setHouseid(string $houseid): self
    {
        $this->houseid = $houseid;

        return $this;
    }

    public function getHouseid(): string
    {
        return $this->houseid;
    }

    public function setHouseguid(?string $houseguid): self
    {
        $this->houseguid = $houseguid;

        return $this;
    }

    public function getHouseguid(): ?string
    {
        return $this->houseguid;
    }

    public function setAoguid(?string $aoguid): self
    {
        $this->aoguid = $aoguid;

        return $this;
    }

    public function getAoguid(): ?string
    {
        return $this->aoguid;
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

    public function setStrstatus(int $strstatus): self
    {
        $this->strstatus = $strstatus;

        return $this;
    }

    public function getStrstatus(): int
    {
        return $this->strstatus;
    }

    public function setEststatus(int $eststatus): self
    {
        $this->eststatus = $eststatus;

        return $this;
    }

    public function getEststatus(): int
    {
        return $this->eststatus;
    }

    public function setStatstatus(int $statstatus): self
    {
        $this->statstatus = $statstatus;

        return $this;
    }

    public function getStatstatus(): int
    {
        return $this->statstatus;
    }

    public function setIfnsfl(?string $ifnsfl): self
    {
        $this->ifnsfl = $ifnsfl;

        return $this;
    }

    public function getIfnsfl(): ?string
    {
        return $this->ifnsfl;
    }

    public function setIfnsul(?string $ifnsul): self
    {
        $this->ifnsul = $ifnsul;

        return $this;
    }

    public function getIfnsul(): ?string
    {
        return $this->ifnsul;
    }

    public function setOkato(?string $okato): self
    {
        $this->okato = $okato;

        return $this;
    }

    public function getOkato(): ?string
    {
        return $this->okato;
    }

    public function setOktmo(?string $oktmo): self
    {
        $this->oktmo = $oktmo;

        return $this;
    }

    public function getOktmo(): ?string
    {
        return $this->oktmo;
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

    public function setCounter(int $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function setDivtype(int $divtype): self
    {
        $this->divtype = $divtype;

        return $this;
    }

    public function getDivtype(): int
    {
        return $this->divtype;
    }
}
