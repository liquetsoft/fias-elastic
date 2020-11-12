<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Serializer;

use DateTime;
use Exception;
use Liquetsoft\Fias\Elastic\Entity\ActualStatus;
use Liquetsoft\Fias\Elastic\Entity\AddressObject;
use Liquetsoft\Fias\Elastic\Entity\AddressObjectType;
use Liquetsoft\Fias\Elastic\Entity\CenterStatus;
use Liquetsoft\Fias\Elastic\Entity\CurrentStatus;
use Liquetsoft\Fias\Elastic\Entity\EstateStatus;
use Liquetsoft\Fias\Elastic\Entity\FlatType;
use Liquetsoft\Fias\Elastic\Entity\House;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocument;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocumentType;
use Liquetsoft\Fias\Elastic\Entity\OperationStatus;
use Liquetsoft\Fias\Elastic\Entity\Room;
use Liquetsoft\Fias\Elastic\Entity\RoomType;
use Liquetsoft\Fias\Elastic\Entity\Stead;
use Liquetsoft\Fias\Elastic\Entity\StructureStatus;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Скомпилированный класс для денормализации сущностей ФИАС в модели для elasticsearch.
 */
class CompiledFiasEntitiesDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return is_subclass_of($type, FlatType::class)
            || is_subclass_of($type, ActualStatus::class)
            || is_subclass_of($type, OperationStatus::class)
            || is_subclass_of($type, Room::class)
            || is_subclass_of($type, AddressObjectType::class)
            || is_subclass_of($type, RoomType::class)
            || is_subclass_of($type, Stead::class)
            || is_subclass_of($type, CenterStatus::class)
            || is_subclass_of($type, NormativeDocument::class)
            || is_subclass_of($type, CurrentStatus::class)
            || is_subclass_of($type, NormativeDocumentType::class)
            || is_subclass_of($type, EstateStatus::class)
            || is_subclass_of($type, AddressObject::class)
            || is_subclass_of($type, House::class)
            || is_subclass_of($type, StructureStatus::class);
    }

    /**
     * {@inheritDoc}
     *
     * @psalm-suppress InvalidStringClass
     *
     * @throws Exception
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $data = is_array($data) ? $data : [];
        $type = trim($type, " \t\n\r\0\x0B\\/");

        $entity = $context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? new $type();

        if ($entity instanceof FlatType) {
            $this->fillFlatTypeEntityWithData($entity, $data);
        } elseif ($entity instanceof ActualStatus) {
            $this->fillActualStatusEntityWithData($entity, $data);
        } elseif ($entity instanceof OperationStatus) {
            $this->fillOperationStatusEntityWithData($entity, $data);
        } elseif ($entity instanceof Room) {
            $this->fillRoomEntityWithData($entity, $data);
        } elseif ($entity instanceof AddressObjectType) {
            $this->fillAddressObjectTypeEntityWithData($entity, $data);
        } elseif ($entity instanceof RoomType) {
            $this->fillRoomTypeEntityWithData($entity, $data);
        } elseif ($entity instanceof Stead) {
            $this->fillSteadEntityWithData($entity, $data);
        } elseif ($entity instanceof CenterStatus) {
            $this->fillCenterStatusEntityWithData($entity, $data);
        } elseif ($entity instanceof NormativeDocument) {
            $this->fillNormativeDocumentEntityWithData($entity, $data);
        } elseif ($entity instanceof CurrentStatus) {
            $this->fillCurrentStatusEntityWithData($entity, $data);
        } elseif ($entity instanceof NormativeDocumentType) {
            $this->fillNormativeDocumentTypeEntityWithData($entity, $data);
        } elseif ($entity instanceof EstateStatus) {
            $this->fillEstateStatusEntityWithData($entity, $data);
        } elseif ($entity instanceof AddressObject) {
            $this->fillAddressObjectEntityWithData($entity, $data);
        } elseif ($entity instanceof House) {
            $this->fillHouseEntityWithData($entity, $data);
        } elseif ($entity instanceof StructureStatus) {
            $this->fillStructureStatusEntityWithData($entity, $data);
        } else {
            throw new Exception('Wrong entity object.');
        }

        return $entity;
    }

    /**
     * Задает все свойства модели 'FlatType' из массива, полученного от ФИАС.
     *
     * @param FlatType $entity
     * @param array    $data
     *
     * @throws Exception
     */
    protected function fillFlatTypeEntityWithData(FlatType $entity, array $data): void
    {
        if (($value = $data['@FLTYPEID'] ?? ($data['fltypeid'] ?? null)) !== null) {
            $entity->setFltypeid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'ActualStatus' из массива, полученного от ФИАС.
     *
     * @param ActualStatus $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillActualStatusEntityWithData(ActualStatus $entity, array $data): void
    {
        if (($value = $data['@ACTSTATID'] ?? ($data['actstatid'] ?? null)) !== null) {
            $entity->setActstatid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'OperationStatus' из массива, полученного от ФИАС.
     *
     * @param OperationStatus $entity
     * @param array           $data
     *
     * @throws Exception
     */
    protected function fillOperationStatusEntityWithData(OperationStatus $entity, array $data): void
    {
        if (($value = $data['@OPERSTATID'] ?? ($data['operstatid'] ?? null)) !== null) {
            $entity->setOperstatid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'Room' из массива, полученного от ФИАС.
     *
     * @param Room  $entity
     * @param array $data
     *
     * @throws Exception
     */
    protected function fillRoomEntityWithData(Room $entity, array $data): void
    {
        if (($value = $data['@ROOMID'] ?? ($data['roomid'] ?? null)) !== null) {
            $entity->setRoomid(trim($value));
        }

        if (($value = $data['@ROOMGUID'] ?? ($data['roomguid'] ?? null)) !== null) {
            $entity->setRoomguid(trim($value));
        }

        if (($value = $data['@HOUSEGUID'] ?? ($data['houseguid'] ?? null)) !== null) {
            $entity->setHouseguid(trim($value));
        }

        if (($value = $data['@REGIONCODE'] ?? ($data['regioncode'] ?? null)) !== null) {
            $entity->setRegioncode(trim($value));
        }

        if (($value = $data['@FLATNUMBER'] ?? ($data['flatnumber'] ?? null)) !== null) {
            $entity->setFlatnumber(trim($value));
        }

        if (($value = $data['@FLATTYPE'] ?? ($data['flattype'] ?? null)) !== null) {
            $entity->setFlattype((int) $value);
        }

        if (($value = $data['@POSTALCODE'] ?? ($data['postalcode'] ?? null)) !== null) {
            $entity->setPostalcode(trim($value));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTime(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTime(trim($value)));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTime(trim($value)));
        }

        if (($value = $data['@OPERSTATUS'] ?? ($data['operstatus'] ?? null)) !== null) {
            $entity->setOperstatus((int) $value);
        }

        if (($value = $data['@LIVESTATUS'] ?? ($data['livestatus'] ?? null)) !== null) {
            $entity->setLivestatus((int) $value);
        }

        if (($value = $data['@NORMDOC'] ?? ($data['normdoc'] ?? null)) !== null) {
            $entity->setNormdoc(trim($value));
        }

        if (($value = $data['@ROOMNUMBER'] ?? ($data['roomnumber'] ?? null)) !== null) {
            $entity->setRoomnumber(trim($value));
        }

        if (($value = $data['@ROOMTYPE'] ?? ($data['roomtype'] ?? null)) !== null) {
            $entity->setRoomtype((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid(trim($value));
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid(trim($value));
        }

        if (($value = $data['@CADNUM'] ?? ($data['cadnum'] ?? null)) !== null) {
            $entity->setCadnum(trim($value));
        }

        if (($value = $data['@ROOMCADNUM'] ?? ($data['roomcadnum'] ?? null)) !== null) {
            $entity->setRoomcadnum(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'AddressObjectType' из массива, полученного от ФИАС.
     *
     * @param AddressObjectType $entity
     * @param array             $data
     *
     * @throws Exception
     */
    protected function fillAddressObjectTypeEntityWithData(AddressObjectType $entity, array $data): void
    {
        if (($value = $data['@KODTST'] ?? ($data['kodtst'] ?? null)) !== null) {
            $entity->setKodtst(trim($value));
        }

        if (($value = $data['@LEVEL'] ?? ($data['level'] ?? null)) !== null) {
            $entity->setLevel((int) $value);
        }

        if (($value = $data['@SOCRNAME'] ?? ($data['socrname'] ?? null)) !== null) {
            $entity->setSocrname(trim($value));
        }

        if (($value = $data['@SCNAME'] ?? ($data['scname'] ?? null)) !== null) {
            $entity->setScname(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'RoomType' из массива, полученного от ФИАС.
     *
     * @param RoomType $entity
     * @param array    $data
     *
     * @throws Exception
     */
    protected function fillRoomTypeEntityWithData(RoomType $entity, array $data): void
    {
        if (($value = $data['@RMTYPEID'] ?? ($data['rmtypeid'] ?? null)) !== null) {
            $entity->setRmtypeid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'Stead' из массива, полученного от ФИАС.
     *
     * @param Stead $entity
     * @param array $data
     *
     * @throws Exception
     */
    protected function fillSteadEntityWithData(Stead $entity, array $data): void
    {
        if (($value = $data['@STEADGUID'] ?? ($data['steadguid'] ?? null)) !== null) {
            $entity->setSteadguid(trim($value));
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@REGIONCODE'] ?? ($data['regioncode'] ?? null)) !== null) {
            $entity->setRegioncode(trim($value));
        }

        if (($value = $data['@POSTALCODE'] ?? ($data['postalcode'] ?? null)) !== null) {
            $entity->setPostalcode(trim($value));
        }

        if (($value = $data['@IFNSFL'] ?? ($data['ifnsfl'] ?? null)) !== null) {
            $entity->setIfnsfl(trim($value));
        }

        if (($value = $data['@IFNSUL'] ?? ($data['ifnsul'] ?? null)) !== null) {
            $entity->setIfnsul(trim($value));
        }

        if (($value = $data['@OKATO'] ?? ($data['okato'] ?? null)) !== null) {
            $entity->setOkato(trim($value));
        }

        if (($value = $data['@OKTMO'] ?? ($data['oktmo'] ?? null)) !== null) {
            $entity->setOktmo(trim($value));
        }

        if (($value = $data['@PARENTGUID'] ?? ($data['parentguid'] ?? null)) !== null) {
            $entity->setParentguid(trim($value));
        }

        if (($value = $data['@STEADID'] ?? ($data['steadid'] ?? null)) !== null) {
            $entity->setSteadid(trim($value));
        }

        if (($value = $data['@OPERSTATUS'] ?? ($data['operstatus'] ?? null)) !== null) {
            $entity->setOperstatus((int) $value);
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTime(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTime(trim($value)));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTime(trim($value)));
        }

        if (($value = $data['@LIVESTATUS'] ?? ($data['livestatus'] ?? null)) !== null) {
            $entity->setLivestatus((int) $value);
        }

        if (($value = $data['@DIVTYPE'] ?? ($data['divtype'] ?? null)) !== null) {
            $entity->setDivtype((int) $value);
        }

        if (($value = $data['@NORMDOC'] ?? ($data['normdoc'] ?? null)) !== null) {
            $entity->setNormdoc(trim($value));
        }

        if (($value = $data['@TERRIFNSFL'] ?? ($data['terrifnsfl'] ?? null)) !== null) {
            $entity->setTerrifnsfl(trim($value));
        }

        if (($value = $data['@TERRIFNSUL'] ?? ($data['terrifnsul'] ?? null)) !== null) {
            $entity->setTerrifnsul(trim($value));
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid(trim($value));
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid(trim($value));
        }

        if (($value = $data['@CADNUM'] ?? ($data['cadnum'] ?? null)) !== null) {
            $entity->setCadnum(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'CenterStatus' из массива, полученного от ФИАС.
     *
     * @param CenterStatus $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillCenterStatusEntityWithData(CenterStatus $entity, array $data): void
    {
        if (($value = $data['@CENTERSTID'] ?? ($data['centerstid'] ?? null)) !== null) {
            $entity->setCenterstid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'NormativeDocument' из массива, полученного от ФИАС.
     *
     * @param NormativeDocument $entity
     * @param array             $data
     *
     * @throws Exception
     */
    protected function fillNormativeDocumentEntityWithData(NormativeDocument $entity, array $data): void
    {
        if (($value = $data['@NORMDOCID'] ?? ($data['normdocid'] ?? null)) !== null) {
            $entity->setNormdocid(trim($value));
        }

        if (($value = $data['@DOCNAME'] ?? ($data['docname'] ?? null)) !== null) {
            $entity->setDocname(trim($value));
        }

        if (($value = $data['@DOCDATE'] ?? ($data['docdate'] ?? null)) !== null) {
            $entity->setDocdate(new DateTime(trim($value)));
        }

        if (($value = $data['@DOCNUM'] ?? ($data['docnum'] ?? null)) !== null) {
            $entity->setDocnum(trim($value));
        }

        if (($value = $data['@DOCTYPE'] ?? ($data['doctype'] ?? null)) !== null) {
            $entity->setDoctype((int) $value);
        }

        if (($value = $data['@DOCIMGID'] ?? ($data['docimgid'] ?? null)) !== null) {
            $entity->setDocimgid(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'CurrentStatus' из массива, полученного от ФИАС.
     *
     * @param CurrentStatus $entity
     * @param array         $data
     *
     * @throws Exception
     */
    protected function fillCurrentStatusEntityWithData(CurrentStatus $entity, array $data): void
    {
        if (($value = $data['@CURENTSTID'] ?? ($data['curentstid'] ?? null)) !== null) {
            $entity->setCurentstid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'NormativeDocumentType' из массива, полученного от ФИАС.
     *
     * @param NormativeDocumentType $entity
     * @param array                 $data
     *
     * @throws Exception
     */
    protected function fillNormativeDocumentTypeEntityWithData(NormativeDocumentType $entity, array $data): void
    {
        if (($value = $data['@NDTYPEID'] ?? ($data['ndtypeid'] ?? null)) !== null) {
            $entity->setNdtypeid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'EstateStatus' из массива, полученного от ФИАС.
     *
     * @param EstateStatus $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillEstateStatusEntityWithData(EstateStatus $entity, array $data): void
    {
        if (($value = $data['@ESTSTATID'] ?? ($data['eststatid'] ?? null)) !== null) {
            $entity->setEststatid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'AddressObject' из массива, полученного от ФИАС.
     *
     * @param AddressObject $entity
     * @param array         $data
     *
     * @throws Exception
     */
    protected function fillAddressObjectEntityWithData(AddressObject $entity, array $data): void
    {
        if (($value = $data['@AOID'] ?? ($data['aoid'] ?? null)) !== null) {
            $entity->setAoid(trim($value));
        }

        if (($value = $data['@AOGUID'] ?? ($data['aoguid'] ?? null)) !== null) {
            $entity->setAoguid(trim($value));
        }

        if (($value = $data['@PARENTGUID'] ?? ($data['parentguid'] ?? null)) !== null) {
            $entity->setParentguid(trim($value));
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid(trim($value));
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid(trim($value));
        }

        if (($value = $data['@CODE'] ?? ($data['code'] ?? null)) !== null) {
            $entity->setCode(trim($value));
        }

        if (($value = $data['@FORMALNAME'] ?? ($data['formalname'] ?? null)) !== null) {
            $entity->setFormalname(trim($value));
        }

        if (($value = $data['@OFFNAME'] ?? ($data['offname'] ?? null)) !== null) {
            $entity->setOffname(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@AOLEVEL'] ?? ($data['aolevel'] ?? null)) !== null) {
            $entity->setAolevel((int) $value);
        }

        if (($value = $data['@REGIONCODE'] ?? ($data['regioncode'] ?? null)) !== null) {
            $entity->setRegioncode(trim($value));
        }

        if (($value = $data['@AREACODE'] ?? ($data['areacode'] ?? null)) !== null) {
            $entity->setAreacode(trim($value));
        }

        if (($value = $data['@AUTOCODE'] ?? ($data['autocode'] ?? null)) !== null) {
            $entity->setAutocode(trim($value));
        }

        if (($value = $data['@CITYCODE'] ?? ($data['citycode'] ?? null)) !== null) {
            $entity->setCitycode(trim($value));
        }

        if (($value = $data['@CTARCODE'] ?? ($data['ctarcode'] ?? null)) !== null) {
            $entity->setCtarcode(trim($value));
        }

        if (($value = $data['@PLACECODE'] ?? ($data['placecode'] ?? null)) !== null) {
            $entity->setPlacecode(trim($value));
        }

        if (($value = $data['@PLANCODE'] ?? ($data['plancode'] ?? null)) !== null) {
            $entity->setPlancode(trim($value));
        }

        if (($value = $data['@STREETCODE'] ?? ($data['streetcode'] ?? null)) !== null) {
            $entity->setStreetcode(trim($value));
        }

        if (($value = $data['@EXTRCODE'] ?? ($data['extrcode'] ?? null)) !== null) {
            $entity->setExtrcode(trim($value));
        }

        if (($value = $data['@SEXTCODE'] ?? ($data['sextcode'] ?? null)) !== null) {
            $entity->setSextcode(trim($value));
        }

        if (($value = $data['@PLAINCODE'] ?? ($data['plaincode'] ?? null)) !== null) {
            $entity->setPlaincode(trim($value));
        }

        if (($value = $data['@CURRSTATUS'] ?? ($data['currstatus'] ?? null)) !== null) {
            $entity->setCurrstatus((int) $value);
        }

        if (($value = $data['@ACTSTATUS'] ?? ($data['actstatus'] ?? null)) !== null) {
            $entity->setActstatus((int) $value);
        }

        if (($value = $data['@LIVESTATUS'] ?? ($data['livestatus'] ?? null)) !== null) {
            $entity->setLivestatus((int) $value);
        }

        if (($value = $data['@CENTSTATUS'] ?? ($data['centstatus'] ?? null)) !== null) {
            $entity->setCentstatus((int) $value);
        }

        if (($value = $data['@OPERSTATUS'] ?? ($data['operstatus'] ?? null)) !== null) {
            $entity->setOperstatus((int) $value);
        }

        if (($value = $data['@IFNSFL'] ?? ($data['ifnsfl'] ?? null)) !== null) {
            $entity->setIfnsfl(trim($value));
        }

        if (($value = $data['@IFNSUL'] ?? ($data['ifnsul'] ?? null)) !== null) {
            $entity->setIfnsul(trim($value));
        }

        if (($value = $data['@TERRIFNSFL'] ?? ($data['terrifnsfl'] ?? null)) !== null) {
            $entity->setTerrifnsfl(trim($value));
        }

        if (($value = $data['@TERRIFNSUL'] ?? ($data['terrifnsul'] ?? null)) !== null) {
            $entity->setTerrifnsul(trim($value));
        }

        if (($value = $data['@OKATO'] ?? ($data['okato'] ?? null)) !== null) {
            $entity->setOkato(trim($value));
        }

        if (($value = $data['@OKTMO'] ?? ($data['oktmo'] ?? null)) !== null) {
            $entity->setOktmo(trim($value));
        }

        if (($value = $data['@POSTALCODE'] ?? ($data['postalcode'] ?? null)) !== null) {
            $entity->setPostalcode(trim($value));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTime(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTime(trim($value)));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTime(trim($value)));
        }

        if (($value = $data['@DIVTYPE'] ?? ($data['divtype'] ?? null)) !== null) {
            $entity->setDivtype((int) $value);
        }

        if (($value = $data['@NORMDOC'] ?? ($data['normdoc'] ?? null)) !== null) {
            $entity->setNormdoc(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'House' из массива, полученного от ФИАС.
     *
     * @param House $entity
     * @param array $data
     *
     * @throws Exception
     */
    protected function fillHouseEntityWithData(House $entity, array $data): void
    {
        if (($value = $data['@HOUSEID'] ?? ($data['houseid'] ?? null)) !== null) {
            $entity->setHouseid(trim($value));
        }

        if (($value = $data['@HOUSEGUID'] ?? ($data['houseguid'] ?? null)) !== null) {
            $entity->setHouseguid(trim($value));
        }

        if (($value = $data['@AOGUID'] ?? ($data['aoguid'] ?? null)) !== null) {
            $entity->setAoguid(trim($value));
        }

        if (($value = $data['@HOUSENUM'] ?? ($data['housenum'] ?? null)) !== null) {
            $entity->setHousenum(trim($value));
        }

        if (($value = $data['@STRSTATUS'] ?? ($data['strstatus'] ?? null)) !== null) {
            $entity->setStrstatus((int) $value);
        }

        if (($value = $data['@ESTSTATUS'] ?? ($data['eststatus'] ?? null)) !== null) {
            $entity->setEststatus((int) $value);
        }

        if (($value = $data['@STATSTATUS'] ?? ($data['statstatus'] ?? null)) !== null) {
            $entity->setStatstatus((int) $value);
        }

        if (($value = $data['@IFNSFL'] ?? ($data['ifnsfl'] ?? null)) !== null) {
            $entity->setIfnsfl(trim($value));
        }

        if (($value = $data['@IFNSUL'] ?? ($data['ifnsul'] ?? null)) !== null) {
            $entity->setIfnsul(trim($value));
        }

        if (($value = $data['@OKATO'] ?? ($data['okato'] ?? null)) !== null) {
            $entity->setOkato(trim($value));
        }

        if (($value = $data['@OKTMO'] ?? ($data['oktmo'] ?? null)) !== null) {
            $entity->setOktmo(trim($value));
        }

        if (($value = $data['@POSTALCODE'] ?? ($data['postalcode'] ?? null)) !== null) {
            $entity->setPostalcode(trim($value));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTime(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTime(trim($value)));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTime(trim($value)));
        }

        if (($value = $data['@COUNTER'] ?? ($data['counter'] ?? null)) !== null) {
            $entity->setCounter((int) $value);
        }

        if (($value = $data['@DIVTYPE'] ?? ($data['divtype'] ?? null)) !== null) {
            $entity->setDivtype((int) $value);
        }

        if (($value = $data['@REGIONCODE'] ?? ($data['regioncode'] ?? null)) !== null) {
            $entity->setRegioncode(trim($value));
        }

        if (($value = $data['@TERRIFNSFL'] ?? ($data['terrifnsfl'] ?? null)) !== null) {
            $entity->setTerrifnsfl(trim($value));
        }

        if (($value = $data['@TERRIFNSUL'] ?? ($data['terrifnsul'] ?? null)) !== null) {
            $entity->setTerrifnsul(trim($value));
        }

        if (($value = $data['@BUILDNUM'] ?? ($data['buildnum'] ?? null)) !== null) {
            $entity->setBuildnum(trim($value));
        }

        if (($value = $data['@STRUCNUM'] ?? ($data['strucnum'] ?? null)) !== null) {
            $entity->setStrucnum(trim($value));
        }

        if (($value = $data['@NORMDOC'] ?? ($data['normdoc'] ?? null)) !== null) {
            $entity->setNormdoc(trim($value));
        }

        if (($value = $data['@CADNUM'] ?? ($data['cadnum'] ?? null)) !== null) {
            $entity->setCadnum(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'StructureStatus' из массива, полученного от ФИАС.
     *
     * @param StructureStatus $entity
     * @param array           $data
     *
     * @throws Exception
     */
    protected function fillStructureStatusEntityWithData(StructureStatus $entity, array $data): void
    {
        if (($value = $data['@STRSTATID'] ?? ($data['strstatid'] ?? null)) !== null) {
            $entity->setStrstatid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }
    }
}
