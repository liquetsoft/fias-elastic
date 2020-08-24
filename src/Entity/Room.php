<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Классификатор помещениях.
 */
class Room
{
    /**
     * Уникальный идентификатор записи. Ключевое поле.
     */
    protected string $roomid = '';

    /**
     * Глобальный уникальный идентификатор адресного объекта (помещения).
     */
    protected string $roomguid = '';

    /**
     * Идентификатор родительского объекта (дома).
     */
    protected string $houseguid = '';

    /**
     * Код региона.
     */
    protected string $regioncode = '';

    /**
     * Номер помещения или офиса.
     */
    protected string $flatnumber = '';

    /**
     * Тип помещения.
     */
    protected int $flattype = 0;

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
     * Дата  внесения записи.
     */
    protected ?DateTimeInterface $updatedate = null;

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
     * Признак действующего адресного объекта.
     */
    protected int $livestatus = 0;

    /**
     * Внешний ключ на нормативный документ.
     */
    protected ?string $normdoc = null;

    /**
     * Номер комнаты.
     */
    protected ?string $roomnumber = null;

    /**
     * Тип комнаты.
     */
    protected ?int $roomtype = null;

    /**
     * Идентификатор записи связывания с предыдушей исторической записью.
     */
    protected ?string $previd = null;

    /**
     * Идентификатор записи  связывания с последующей исторической записью.
     */
    protected ?string $nextid = null;

    /**
     * Кадастровый номер помещения.
     */
    protected ?string $cadnum = null;

    /**
     * Кадастровый номер комнаты в помещении.
     */
    protected ?string $roomcadnum = null;

    public function setRoomid(string $roomid): self
    {
        $this->roomid = $roomid;

        return $this;
    }

    public function getRoomid(): string
    {
        return $this->roomid;
    }

    public function setRoomguid(string $roomguid): self
    {
        $this->roomguid = $roomguid;

        return $this;
    }

    public function getRoomguid(): string
    {
        return $this->roomguid;
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

    public function setOperstatus(int $operstatus): self
    {
        $this->operstatus = $operstatus;

        return $this;
    }

    public function getOperstatus(): int
    {
        return $this->operstatus;
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

    public function setNormdoc(?string $normdoc): self
    {
        $this->normdoc = $normdoc;

        return $this;
    }

    public function getNormdoc(): ?string
    {
        return $this->normdoc;
    }

    public function setRoomnumber(?string $roomnumber): self
    {
        $this->roomnumber = $roomnumber;

        return $this;
    }

    public function getRoomnumber(): ?string
    {
        return $this->roomnumber;
    }

    public function setRoomtype(?int $roomtype): self
    {
        $this->roomtype = $roomtype;

        return $this;
    }

    public function getRoomtype(): ?int
    {
        return $this->roomtype;
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

    public function setRoomcadnum(?string $roomcadnum): self
    {
        $this->roomcadnum = $roomcadnum;

        return $this;
    }

    public function getRoomcadnum(): ?string
    {
        return $this->roomcadnum;
    }
}
