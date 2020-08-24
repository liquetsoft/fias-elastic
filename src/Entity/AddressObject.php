<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Классификатор адресообразующих элементов.
 */
class AddressObject
{
    /**
     * Уникальный идентификатор записи. Ключевое поле.
     */
    protected string $aoid = '';

    /**
     * Глобальный уникальный идентификатор адресного объекта.
     */
    protected string $aoguid = '';

    /**
     * Идентификатор объекта родительского объекта.
     */
    protected ?string $parentguid = null;

    /**
     * Идентификатор записи связывания с предыдушей исторической записью.
     */
    protected ?string $previd = null;

    /**
     * Идентификатор записи  связывания с последующей исторической записью.
     */
    protected ?string $nextid = null;

    /**
     * Код адресного объекта одной строкой с признаком актуальности из КЛАДР 4.0.
     */
    protected ?string $code = null;

    /**
     * Формализованное наименование.
     */
    protected string $formalname = '';

    /**
     * Официальное наименование.
     */
    protected ?string $offname = null;

    /**
     * Краткое наименование типа объекта.
     */
    protected string $shortname = '';

    /**
     * Уровень адресного объекта.
     */
    protected int $aolevel = 0;

    /**
     * Код региона.
     */
    protected string $regioncode = '';

    /**
     * Код района.
     */
    protected string $areacode = '';

    /**
     * Код автономии.
     */
    protected string $autocode = '';

    /**
     * Код города.
     */
    protected string $citycode = '';

    /**
     * Код внутригородского района.
     */
    protected string $ctarcode = '';

    /**
     * Код населенного пункта.
     */
    protected string $placecode = '';

    /**
     * Код элемента планировочной структуры.
     */
    protected string $plancode = '';

    /**
     * Код улицы.
     */
    protected ?string $streetcode = null;

    /**
     * Код дополнительного адресообразующего элемента.
     */
    protected string $extrcode = '';

    /**
     * Код подчиненного дополнительного адресообразующего элемента.
     */
    protected string $sextcode = '';

    /**
     * Код адресного объекта из КЛАДР 4.0 одной строкой без признака актуальности (последних двух цифр).
     */
    protected ?string $plaincode = null;

    /**
     * Статус актуальности КЛАДР 4 (последние две цифры в коде).
     */
    protected ?int $currstatus = null;

    /**
     * Статус актуальности адресного объекта ФИАС. Актуальный адрес на текущую дату. Обычно последняя запись об адресном объекте.
     * 0 – Не актуальный
     * 1 - Актуальный.
     */
    protected int $actstatus = 0;

    /**
     * Признак действующего адресного объекта.
     */
    protected int $livestatus = 0;

    /**
     * Статус центра.
     */
    protected int $centstatus = 0;

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
     * Код ИФНС ФЛ.
     */
    protected ?string $ifnsfl = null;

    /**
     * Код ИФНС ЮЛ.
     */
    protected ?string $ifnsul = null;

    /**
     * Код территориального участка ИФНС ФЛ.
     */
    protected ?string $terrifnsfl = null;

    /**
     * Код территориального участка ИФНС ЮЛ.
     */
    protected ?string $terrifnsul = null;

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
     * Дата  внесения записи.
     */
    protected ?DateTimeInterface $updatedate = null;

    /**
     * Тип адресации:
     *                   0 - не определено
     *                   1 - муниципальный;
     *                   2 - административно-территориальный.
     */
    protected int $divtype = 0;

    /**
     * Внешний ключ на нормативный документ.
     */
    protected ?string $normdoc = null;

    public function setAoid(string $aoid): self
    {
        $this->aoid = $aoid;

        return $this;
    }

    public function getAoid(): string
    {
        return $this->aoid;
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

    public function setParentguid(?string $parentguid): self
    {
        $this->parentguid = $parentguid;

        return $this;
    }

    public function getParentguid(): ?string
    {
        return $this->parentguid;
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

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setFormalname(string $formalname): self
    {
        $this->formalname = $formalname;

        return $this;
    }

    public function getFormalname(): string
    {
        return $this->formalname;
    }

    public function setOffname(?string $offname): self
    {
        $this->offname = $offname;

        return $this;
    }

    public function getOffname(): ?string
    {
        return $this->offname;
    }

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname(): string
    {
        return $this->shortname;
    }

    public function setAolevel(int $aolevel): self
    {
        $this->aolevel = $aolevel;

        return $this;
    }

    public function getAolevel(): int
    {
        return $this->aolevel;
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

    public function setAreacode(string $areacode): self
    {
        $this->areacode = $areacode;

        return $this;
    }

    public function getAreacode(): string
    {
        return $this->areacode;
    }

    public function setAutocode(string $autocode): self
    {
        $this->autocode = $autocode;

        return $this;
    }

    public function getAutocode(): string
    {
        return $this->autocode;
    }

    public function setCitycode(string $citycode): self
    {
        $this->citycode = $citycode;

        return $this;
    }

    public function getCitycode(): string
    {
        return $this->citycode;
    }

    public function setCtarcode(string $ctarcode): self
    {
        $this->ctarcode = $ctarcode;

        return $this;
    }

    public function getCtarcode(): string
    {
        return $this->ctarcode;
    }

    public function setPlacecode(string $placecode): self
    {
        $this->placecode = $placecode;

        return $this;
    }

    public function getPlacecode(): string
    {
        return $this->placecode;
    }

    public function setPlancode(string $plancode): self
    {
        $this->plancode = $plancode;

        return $this;
    }

    public function getPlancode(): string
    {
        return $this->plancode;
    }

    public function setStreetcode(?string $streetcode): self
    {
        $this->streetcode = $streetcode;

        return $this;
    }

    public function getStreetcode(): ?string
    {
        return $this->streetcode;
    }

    public function setExtrcode(string $extrcode): self
    {
        $this->extrcode = $extrcode;

        return $this;
    }

    public function getExtrcode(): string
    {
        return $this->extrcode;
    }

    public function setSextcode(string $sextcode): self
    {
        $this->sextcode = $sextcode;

        return $this;
    }

    public function getSextcode(): string
    {
        return $this->sextcode;
    }

    public function setPlaincode(?string $plaincode): self
    {
        $this->plaincode = $plaincode;

        return $this;
    }

    public function getPlaincode(): ?string
    {
        return $this->plaincode;
    }

    public function setCurrstatus(?int $currstatus): self
    {
        $this->currstatus = $currstatus;

        return $this;
    }

    public function getCurrstatus(): ?int
    {
        return $this->currstatus;
    }

    public function setActstatus(int $actstatus): self
    {
        $this->actstatus = $actstatus;

        return $this;
    }

    public function getActstatus(): int
    {
        return $this->actstatus;
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

    public function setCentstatus(int $centstatus): self
    {
        $this->centstatus = $centstatus;

        return $this;
    }

    public function getCentstatus(): int
    {
        return $this->centstatus;
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
}
