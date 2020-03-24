<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;
use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Сведения о помещениях (квартирах, офисах, комнатах и т.д.).
 */
class Room implements EntityInterface
{
    /** @var string */
    private $roomid = '';

    /** @var string|null */
    private $roomguid;

    /** @var string|null */
    private $houseguid;

    /** @var string */
    private $regioncode = '';

    /** @var string */
    private $flatnumber = '';

    /** @var int */
    private $flattype = 0;

    /** @var string|null */
    private $postalcode;

    /** @var DateTimeInterface */
    private $startdate;

    /** @var DateTimeInterface */
    private $enddate;

    /** @var DateTimeInterface */
    private $updatedate;

    /** @var string */
    private $operstatus = '';

    /** @var string */
    private $livestatus = '';

    /** @var string|null */
    private $normdoc;

    public function setRoomid(string $roomid): self
    {
        $this->roomid = $roomid;

        return $this;
    }

    public function getRoomid(): string
    {
        return $this->roomid;
    }

    public function setRoomguid(?string $roomguid): self
    {
        $this->roomguid = $roomguid;

        return $this;
    }

    public function getRoomguid(): ?string
    {
        return $this->roomguid;
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

    public function setRegioncode(string $regioncode): self
    {
        $this->regioncode = $regioncode;

        return $this;
    }

    public function getRegioncode(): string
    {
        return $this->regioncode;
    }

    public function setFlatnumber(string $flatnumber): self
    {
        $this->flatnumber = $flatnumber;

        return $this;
    }

    public function getFlatnumber(): string
    {
        return $this->flatnumber;
    }

    public function setFlattype(int $flattype): self
    {
        $this->flattype = $flattype;

        return $this;
    }

    public function getFlattype(): int
    {
        return $this->flattype;
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

    public function setOperstatus(string $operstatus): self
    {
        $this->operstatus = $operstatus;

        return $this;
    }

    public function getOperstatus(): string
    {
        return $this->operstatus;
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

    public function setNormdoc(?string $normdoc): self
    {
        $this->normdoc = $normdoc;

        return $this;
    }

    public function getNormdoc(): ?string
    {
        return $this->normdoc;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'Room';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return $this->roomid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'roomid' => $this->roomid,
            'roomguid' => $this->roomguid,
            'houseguid' => $this->houseguid,
            'regioncode' => $this->regioncode,
            'flatnumber' => $this->flatnumber,
            'flattype' => $this->flattype,
            'postalcode' => $this->postalcode,
            'startdate' => $this->startdate->format(DateTimeInterface::ATOM),
            'enddate' => $this->enddate->format(DateTimeInterface::ATOM),
            'updatedate' => $this->updatedate->format(DateTimeInterface::ATOM),
            'operstatus' => $this->operstatus,
            'livestatus' => $this->livestatus,
            'normdoc' => $this->normdoc,
        ];
    }
}
