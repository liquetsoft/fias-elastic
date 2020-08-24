<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Сведения по номерам домов улиц городов и населенных пунктов.
 */
class House
{
    /**
     * Уникальный идентификатор записи дома.
     */
    protected string $houseid = '';

    /**
     * Глобальный уникальный идентификатор дома.
     */
    protected string $houseguid = '';

    /**
     * Guid записи родительского объекта (улицы, города, населенного пункта и т.п.).
     */
    protected string $aoguid = '';

    /**
     * Номер дома.
     */
    protected ?string $housenum = null;

    /**
     * Признак строения.
     */
    protected ?int $strstatus = null;

    /**
     * Признак владения.
     */
    protected int $eststatus = 0;

    /**
     * Состояние дома.
     */
    protected int $statstatus = 0;

    /**
     * Код ИФНС ФЛ.
     */
    protected ?string $ifnsfl = null;

    /**
     * Код ИФНС ЮЛ.
     */
    protected ?string $ifnsul = null;

    /**
     * OKATO.
     */
    protected ?string $okato = null;

    /**
     * OKTMO.
     */
    protected ?string $oktmo = null;

    /**
     * Почтовый индекс.
     */
    protected ?string $postalcode = null;

    /**
     * Начало действия записи.
     */
    protected ?DateTimeInterface $startdate = null;

    /**
     * Окончание действия записи.
     */
    protected ?DateTimeInterface $enddate = null;

    /**
     * Дата время внесения записи.
     */
    protected ?DateTimeInterface $updatedate = null;

    /**
     * Счетчик записей домов для КЛАДР 4.
     */
    protected int $counter = 0;

    /**
     * Тип адресации:
     * 0 - не определено
     * 1 - муниципальный;
     * 2 - административно-территориальный.
     */
    protected int $divtype = 0;

    /**
     * Код региона.
     */
    protected ?string $regioncode = null;

    /**
     * Код территориального участка ИФНС ФЛ.
     */
    protected ?string $terrifnsfl = null;

    /**
     * Код территориального участка ИФНС ЮЛ.
     */
    protected ?string $terrifnsul = null;

    /**
     * Номер корпуса.
     */
    protected ?string $buildnum = null;

    /**
     * Номер строения.
     */
    protected ?string $strucnum = null;

    /**
     * Внешний ключ на нормативный документ.
     */
    protected ?string $normdoc = null;

    /**
     * Кадастровый номер.
     */
    protected ?string $cadnum = null;

    public function setHouseid(string $houseid): self
    {
        $this->houseid = $houseid;

        return $this;
    }

    public function getHouseid(): string
    {
        return $this->houseid;
    }

    public function setHouseguid(string $houseguid): self
    {
        $this->houseguid = $houseguid;

        return $this;
    }

    public function getHouseguid(): string
    {
        return $this->houseguid;
    }

    public function setAoguid(string $aoguid): self
    {
        $this->aoguid = $aoguid;

        return $this;
    }

    public function getAoguid(): string
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

    public function setStrstatus(?int $strstatus): self
    {
        $this->strstatus = $strstatus;

        return $this;
    }

    public function getStrstatus(): ?int
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

    public function setUpdatedate(DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): ?DateTimeInterface
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

    public function setRegioncode(?string $regioncode): self
    {
        $this->regioncode = $regioncode;

        return $this;
    }

    public function getRegioncode(): ?string
    {
        return $this->regioncode;
    }

    public function setTerrifnsfl(?string $terrifnsfl): self
    {
        $this->terrifnsfl = $terrifnsfl;

        return $this;
    }

    public function getTerrifnsfl(): ?string
    {
        return $this->terrifnsfl;
    }

    public function setTerrifnsul(?string $terrifnsul): self
    {
        $this->terrifnsul = $terrifnsul;

        return $this;
    }

    public function getTerrifnsul(): ?string
    {
        return $this->terrifnsul;
    }

    public function setBuildnum(?string $buildnum): self
    {
        $this->buildnum = $buildnum;

        return $this;
    }

    public function getBuildnum(): ?string
    {
        return $this->buildnum;
    }

    public function setStrucnum(?string $strucnum): self
    {
        $this->strucnum = $strucnum;

        return $this;
    }

    public function getStrucnum(): ?string
    {
        return $this->strucnum;
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

    public function setCadnum(?string $cadnum): self
    {
        $this->cadnum = $cadnum;

        return $this;
    }

    public function getCadnum(): ?string
    {
        return $this->cadnum;
    }
}
