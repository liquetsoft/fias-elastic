<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Классификатор земельных участков.
 */
class Stead
{
    /**
     * Глобальный уникальный идентификатор адресного объекта (земельного участка).
     */
    protected string $steadguid = '';

    /**
     * Номер земельного участка.
     */
    protected ?string $number = null;

    /**
     * Код региона.
     */
    protected string $regioncode = '';

    /**
     * Почтовый индекс.
     */
    protected ?string $postalcode = null;

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
     * Идентификатор объекта родительского объекта.
     */
    protected ?string $parentguid = null;

    /**
     * Уникальный идентификатор записи. Ключевое поле.
     */
    protected string $steadid = '';

    /**
     * Статус действия над записью – причина появления записи (см. описание таблицы OperationStatus):
     * 01 – Инициация;
     * 10 – Добавление;
     * 20 – Изменение;
     * 21 – Групповое изменение;
     * 30 – Удаление;
     * 31 - Удаление вследствие удаления вышестоящего объекта;
     * 40 – Присоединение адресного объекта (слияние);
     * 41 – Переподчинение вследствие слияния вышестоящего объекта;
     * 42 - Прекращение существования вследствие присоединения к другому адресному объекту;
     * 43 - Создание нового адресного объекта в результате слияния адресных объектов;
     * 50 – Переподчинение;
     * 51 – Переподчинение вследствие переподчинения вышестоящего объекта;
     * 60 – Прекращение существования вследствие дробления;
     * 61 – Создание нового адресного объекта в результате дробления.
     */
    protected int $operstatus = 0;

    /**
     * Начало действия записи.
     */
    protected ?DateTimeInterface $startdate = null;

    /**
     * Окончание действия записи.
     */
    protected ?DateTimeInterface $enddate = null;

    /**
     * Дата  внесения записи.
     */
    protected ?DateTimeInterface $updatedate = null;

    /**
     * Признак действующего адресного объекта.
     */
    protected int $livestatus = 0;

    /**
     * Тип адресации:
     * 0 - не определено
     * 1 - муниципальный;
     * 2 - административно-территориальный.
     */
    protected int $divtype = 0;

    /**
     * Внешний ключ на нормативный документ.
     */
    protected ?string $normdoc = null;

    /**
     * Код территориального участка ИФНС ФЛ.
     */
    protected ?string $terrifnsfl = null;

    /**
     * Код территориального участка ИФНС ЮЛ.
     */
    protected ?string $terrifnsul = null;

    /**
     * Идентификатор записи связывания с предыдушей исторической записью.
     */
    protected ?string $previd = null;

    /**
     * Идентификатор записи  связывания с последующей исторической записью.
     */
    protected ?string $nextid = null;

    /**
     * Кадастровый номер.
     */
    protected ?string $cadnum = null;

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

    public function setParentguid(?string $parentguid): self
    {
        $this->parentguid = $parentguid;

        return $this;
    }

    public function getParentguid(): ?string
    {
        return $this->parentguid;
    }

    public function setSteadid(string $steadid): self
    {
        $this->steadid = $steadid;

        return $this;
    }

    public function getSteadid(): string
    {
        return $this->steadid;
    }

    public function setOperstatus(int $operstatus): self
    {
        $this->operstatus = $operstatus;

        return $this;
    }

    public function getOperstatus(): int
    {
        return $this->operstatus;
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

    public function setLivestatus(int $livestatus): self
    {
        $this->livestatus = $livestatus;

        return $this;
    }

    public function getLivestatus(): int
    {
        return $this->livestatus;
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

    public function setNormdoc(?string $normdoc): self
    {
        $this->normdoc = $normdoc;

        return $this;
    }

    public function getNormdoc(): ?string
    {
        return $this->normdoc;
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

    public function setPrevid(?string $previd): self
    {
        $this->previd = $previd;

        return $this;
    }

    public function getPrevid(): ?string
    {
        return $this->previd;
    }

    public function setNextid(?string $nextid): self
    {
        $this->nextid = $nextid;

        return $this;
    }

    public function getNextid(): ?string
    {
        return $this->nextid;
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
