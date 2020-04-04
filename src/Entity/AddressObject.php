<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use DateTimeInterface;

/**
 * Реестр адресообразующих элементов.
 */
class AddressObject
{
    /**
     * Уникальный идентификатор записи. Ключевое поле.
     *
     * @var string
     */
    private $aoid = '';

    /**
     * Глобальный уникальный идентификатор адресного объекта.
     *
     * @var string|null
     */
    private $aoguid;

    /**
     * Идентификатор родительского объекта.
     *
     * @var string|null
     */
    private $parentguid;

    /**
     * Идентификатор записи связывания с предыдушей исторической записью.
     *
     * @var string|null
     */
    private $previd;

    /**
     * Идентификатор записи связывания с последующей исторической записью.
     *
     * @var string|null
     */
    private $nextid;

    /**
     * Код адресного объекта одной строкой с признаком актуальности из КЛАДР 4.0.
     *
     * @var string|null
     */
    private $code;

    /**
     * Формализованное наименование.
     *
     * @var string
     */
    private $formalname = '';

    /**
     * Официальное наименование.
     *
     * @var string
     */
    private $offname = '';

    /**
     * Краткое наименование типа объекта.
     *
     * @var string
     */
    private $shortname = '';

    /**
     * Уровень адресного объекта.
     *
     * @var int
     */
    private $aolevel = 0;

    /**
     * Код региона.
     *
     * @var string
     */
    private $regioncode = '';

    /**
     * Код района.
     *
     * @var string
     */
    private $areacode = '';

    /**
     * Код автономии.
     *
     * @var string
     */
    private $autocode = '';

    /**
     * Код города.
     *
     * @var string
     */
    private $citycode = '';

    /**
     * Код внутригородского района.
     *
     * @var string
     */
    private $ctarcode = '';

    /**
     * Код населенного пункта.
     *
     * @var string
     */
    private $placecode = '';

    /**
     * Код элемента планировочной структуры.
     *
     * @var string
     */
    private $plancode = '';

    /**
     * Код улицы.
     *
     * @var string
     */
    private $streetcode = '';

    /**
     * Код дополнительного адресообразующего элемента.
     *
     * @var string
     */
    private $extrcode = '';

    /**
     * Код подчиненного дополнительного адресообразующего элемента.
     *
     * @var string
     */
    private $sextcode = '';

    /**
     * Код адресного объекта из КЛАДР 4.0 одной строкой без признака актуальности (последних двух цифр).
     *
     * @var string|null
     */
    private $plaincode;

    /**
     * Статус актуальности КЛАДР 4 (последние две цифры в коде).
     *
     * @var int
     */
    private $currstatus = 0;

    /**
     * Статус актуальности адресного объекта ФИАС. Актуальный адрес на текущую дату. Обычно последняя запись об адресном объекте.
     *
     * @var int
     */
    private $actstatus = 0;

    /**
     * Признак действующего адресного объекта.
     *
     * @var int
     */
    private $livestatus = 0;

    /**
     * Статус центра.
     *
     * @var int
     */
    private $centstatus = 0;

    /**
     * Статус действия над записью – причина появления записи.
     *
     * @var int
     */
    private $operstatus = 0;

    /**
     * Код ИФНС ФЛ.
     *
     * @var string|null
     */
    private $ifnsfl;

    /**
     * Код ИФНС ЮЛ.
     *
     * @var string|null
     */
    private $ifnsul;

    /**
     * Код территориального участка ИФНС ФЛ.
     *
     * @var string|null
     */
    private $terrifnsfl;

    /**
     * Код территориального участка ИФНС ЮЛ.
     *
     * @var string|null
     */
    private $terrifnsul;

    /**
     * OKATO.
     *
     * @var string|null
     */
    private $okato;

    /**
     * OKTMO.
     *
     * @var string|null
     */
    private $oktmo;

    /**
     * Почтовый индекс.
     *
     * @var string|null
     */
    private $postalcode;

    /**
     * Начало действия записи.
     *
     * @var DateTimeInterface
     */
    private $startdate;

    /**
     * Окончание действия записи.
     *
     * @var DateTimeInterface
     */
    private $enddate;

    /**
     * Дата внесения (обновления) записи.
     *
     * @var DateTimeInterface
     */
    private $updatedate;

    /**
     * Признак адресации.
     *
     * @var int
     */
    private $divtype = 0;

    public function setAoid(string $aoid): self
    {
        $this->aoid = $aoid;

        return $this;
    }

    public function getAoid(): string
    {
        return $this->aoid;
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

    public function setOffname(string $offname): self
    {
        $this->offname = $offname;

        return $this;
    }

    public function getOffname(): string
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

    public function setStreetcode(string $streetcode): self
    {
        $this->streetcode = $streetcode;

        return $this;
    }

    public function getStreetcode(): string
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

    public function setCurrstatus(int $currstatus): self
    {
        $this->currstatus = $currstatus;

        return $this;
    }

    public function getCurrstatus(): int
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
