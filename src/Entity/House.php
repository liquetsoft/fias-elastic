<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;
use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Элементы адреса, идентифицирующие адресуемые объекты.
 */
class House implements EntityInterface
{
    /** @var string */
    private $houseid = '';

    /** @var string|null */
    private $houseguid;

    /** @var string|null */
    private $aoguid;

    /** @var string|null */
    private $housenum;

    /** @var int */
    private $strstatus = 0;

    /** @var int */
    private $eststatus = 0;

    /** @var int */
    private $statstatus = 0;

    /** @var string|null */
    private $ifnsfl;

    /** @var string|null */
    private $ifnsul;

    /** @var string|null */
    private $okato;

    /** @var string|null */
    private $oktmo;

    /** @var string|null */
    private $postalcode;

    /** @var DateTimeInterface */
    private $startdate;

    /** @var DateTimeInterface */
    private $enddate;

    /** @var DateTimeInterface */
    private $updatedate;

    /** @var int */
    private $counter = 0;

    /** @var int */
    private $divtype = 0;

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

    /**
     * @inheritDoc
     */
    public function getElasticSearchIndex(): string
    {
        return 'house';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchId(): string
    {
        return $this->houseid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchData(): array
    {
        return [
            'houseid' => $this->houseid,
            'houseguid' => $this->houseguid,
            'aoguid' => $this->aoguid,
            'housenum' => $this->housenum,
            'strstatus' => $this->strstatus,
            'eststatus' => $this->eststatus,
            'statstatus' => $this->statstatus,
            'ifnsfl' => $this->ifnsfl,
            'ifnsul' => $this->ifnsul,
            'okato' => $this->okato,
            'oktmo' => $this->oktmo,
            'postalcode' => $this->postalcode,
            'startdate' => $this->startdate->format('Y-m-d\TH:i:s'),
            'enddate' => $this->enddate->format('Y-m-d\TH:i:s'),
            'updatedate' => $this->updatedate->format('Y-m-d\TH:i:s'),
            'counter' => $this->counter,
            'divtype' => $this->divtype,
        ];
    }
}
