<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Serializer;

use DateTimeImmutable;
use Exception;
use Liquetsoft\Fias\Elastic\Entity\AddrObj;
use Liquetsoft\Fias\Elastic\Entity\AddrObjDivision;
use Liquetsoft\Fias\Elastic\Entity\AddrObjTypes;
use Liquetsoft\Fias\Elastic\Entity\AdmHierarchy;
use Liquetsoft\Fias\Elastic\Entity\Apartments;
use Liquetsoft\Fias\Elastic\Entity\ApartmentTypes;
use Liquetsoft\Fias\Elastic\Entity\Carplaces;
use Liquetsoft\Fias\Elastic\Entity\ChangeHistory;
use Liquetsoft\Fias\Elastic\Entity\Houses;
use Liquetsoft\Fias\Elastic\Entity\HouseTypes;
use Liquetsoft\Fias\Elastic\Entity\MunHierarchy;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocs;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocsKinds;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocsTypes;
use Liquetsoft\Fias\Elastic\Entity\ObjectLevels;
use Liquetsoft\Fias\Elastic\Entity\OperationTypes;
use Liquetsoft\Fias\Elastic\Entity\Param;
use Liquetsoft\Fias\Elastic\Entity\ParamTypes;
use Liquetsoft\Fias\Elastic\Entity\ReestrObjects;
use Liquetsoft\Fias\Elastic\Entity\Rooms;
use Liquetsoft\Fias\Elastic\Entity\RoomTypes;
use Liquetsoft\Fias\Elastic\Entity\Steads;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Скомпилированный класс для денормализации сущностей ФИАС в модели для elasticsearch.
 */
class CompiledFiasEntitiesDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritDoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return is_subclass_of($type, Rooms::class)
            || is_subclass_of($type, AddrObjTypes::class)
            || is_subclass_of($type, Param::class)
            || is_subclass_of($type, Steads::class)
            || is_subclass_of($type, Carplaces::class)
            || is_subclass_of($type, MunHierarchy::class)
            || is_subclass_of($type, NormativeDocsTypes::class)
            || is_subclass_of($type, ApartmentTypes::class)
            || is_subclass_of($type, OperationTypes::class)
            || is_subclass_of($type, Houses::class)
            || is_subclass_of($type, ChangeHistory::class)
            || is_subclass_of($type, Apartments::class)
            || is_subclass_of($type, HouseTypes::class)
            || is_subclass_of($type, NormativeDocsKinds::class)
            || is_subclass_of($type, ParamTypes::class)
            || is_subclass_of($type, RoomTypes::class)
            || is_subclass_of($type, NormativeDocs::class)
            || is_subclass_of($type, ObjectLevels::class)
            || is_subclass_of($type, AdmHierarchy::class)
            || is_subclass_of($type, AddrObjDivision::class)
            || is_subclass_of($type, ReestrObjects::class)
            || is_subclass_of($type, AddrObj::class);
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
        $data = \is_array($data) ? $data : [];
        $type = trim($type, " \t\n\r\0\x0B\\/");

        $entity = $context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? new $type();

        if ($entity instanceof Rooms) {
            $this->fillRoomsEntityWithData($entity, $data);
        } elseif ($entity instanceof AddrObjTypes) {
            $this->fillAddrObjTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof Param) {
            $this->fillParamEntityWithData($entity, $data);
        } elseif ($entity instanceof Steads) {
            $this->fillSteadsEntityWithData($entity, $data);
        } elseif ($entity instanceof Carplaces) {
            $this->fillCarplacesEntityWithData($entity, $data);
        } elseif ($entity instanceof MunHierarchy) {
            $this->fillMunHierarchyEntityWithData($entity, $data);
        } elseif ($entity instanceof NormativeDocsTypes) {
            $this->fillNormativeDocsTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof ApartmentTypes) {
            $this->fillApartmentTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof OperationTypes) {
            $this->fillOperationTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof Houses) {
            $this->fillHousesEntityWithData($entity, $data);
        } elseif ($entity instanceof ChangeHistory) {
            $this->fillChangeHistoryEntityWithData($entity, $data);
        } elseif ($entity instanceof Apartments) {
            $this->fillApartmentsEntityWithData($entity, $data);
        } elseif ($entity instanceof HouseTypes) {
            $this->fillHouseTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof NormativeDocsKinds) {
            $this->fillNormativeDocsKindsEntityWithData($entity, $data);
        } elseif ($entity instanceof ParamTypes) {
            $this->fillParamTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof RoomTypes) {
            $this->fillRoomTypesEntityWithData($entity, $data);
        } elseif ($entity instanceof NormativeDocs) {
            $this->fillNormativeDocsEntityWithData($entity, $data);
        } elseif ($entity instanceof ObjectLevels) {
            $this->fillObjectLevelsEntityWithData($entity, $data);
        } elseif ($entity instanceof AdmHierarchy) {
            $this->fillAdmHierarchyEntityWithData($entity, $data);
        } elseif ($entity instanceof AddrObjDivision) {
            $this->fillAddrObjDivisionEntityWithData($entity, $data);
        } elseif ($entity instanceof ReestrObjects) {
            $this->fillReestrObjectsEntityWithData($entity, $data);
        } elseif ($entity instanceof AddrObj) {
            $this->fillAddrObjEntityWithData($entity, $data);
        } else {
            throw new Exception('Wrong entity object.');
        }

        return $entity;
    }

    /**
     * Задает все свойства модели 'Rooms' из массива, полученного от ФИАС.
     *
     * @param Rooms $entity
     * @param array $data
     *
     * @throws Exception
     */
    protected function fillRoomsEntityWithData(Rooms $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@ROOMTYPE'] ?? ($data['roomtype'] ?? null)) !== null) {
            $entity->setRoomtype((int) $value);
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'AddrObjTypes' из массива, полученного от ФИАС.
     *
     * @param AddrObjTypes $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillAddrObjTypesEntityWithData(AddrObjTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@LEVEL'] ?? ($data['level'] ?? null)) !== null) {
            $entity->setLevel((int) $value);
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'Param' из массива, полученного от ФИАС.
     *
     * @param Param $entity
     * @param array $data
     *
     * @throws Exception
     */
    protected function fillParamEntityWithData(Param $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@CHANGEIDEND'] ?? ($data['changeidend'] ?? null)) !== null) {
            $entity->setChangeidend((int) $value);
        }

        if (($value = $data['@TYPEID'] ?? ($data['typeid'] ?? null)) !== null) {
            $entity->setTypeid((int) $value);
        }

        if (($value = $data['@VALUE'] ?? ($data['value'] ?? null)) !== null) {
            $entity->setValue(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }
    }

    /**
     * Задает все свойства модели 'Steads' из массива, полученного от ФИАС.
     *
     * @param Steads $entity
     * @param array  $data
     *
     * @throws Exception
     */
    protected function fillSteadsEntityWithData(Steads $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid(trim($value));
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'Carplaces' из массива, полученного от ФИАС.
     *
     * @param Carplaces $entity
     * @param array     $data
     *
     * @throws Exception
     */
    protected function fillCarplacesEntityWithData(Carplaces $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'MunHierarchy' из массива, полученного от ФИАС.
     *
     * @param MunHierarchy $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillMunHierarchyEntityWithData(MunHierarchy $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@PARENTOBJID'] ?? ($data['parentobjid'] ?? null)) !== null) {
            $entity->setParentobjid((int) $value);
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@OKTMO'] ?? ($data['oktmo'] ?? null)) !== null) {
            $entity->setOktmo(trim($value));
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'NormativeDocsTypes' из массива, полученного от ФИАС.
     *
     * @param NormativeDocsTypes $entity
     * @param array              $data
     *
     * @throws Exception
     */
    protected function fillNormativeDocsTypesEntityWithData(NormativeDocsTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }
    }

    /**
     * Задает все свойства модели 'ApartmentTypes' из массива, полученного от ФИАС.
     *
     * @param ApartmentTypes $entity
     * @param array          $data
     *
     * @throws Exception
     */
    protected function fillApartmentTypesEntityWithData(ApartmentTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'OperationTypes' из массива, полученного от ФИАС.
     *
     * @param OperationTypes $entity
     * @param array          $data
     *
     * @throws Exception
     */
    protected function fillOperationTypesEntityWithData(OperationTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'Houses' из массива, полученного от ФИАС.
     *
     * @param Houses $entity
     * @param array  $data
     *
     * @throws Exception
     */
    protected function fillHousesEntityWithData(Houses $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@HOUSENUM'] ?? ($data['housenum'] ?? null)) !== null) {
            $entity->setHousenum(trim($value));
        }

        if (($value = $data['@ADDNUM1'] ?? ($data['addnum1'] ?? null)) !== null) {
            $entity->setAddnum1(trim($value));
        }

        if (($value = $data['@ADDNUM2'] ?? ($data['addnum2'] ?? null)) !== null) {
            $entity->setAddnum2(trim($value));
        }

        if (($value = $data['@HOUSETYPE'] ?? ($data['housetype'] ?? null)) !== null) {
            $entity->setHousetype((int) $value);
        }

        if (($value = $data['@ADDTYPE1'] ?? ($data['addtype1'] ?? null)) !== null) {
            $entity->setAddtype1((int) $value);
        }

        if (($value = $data['@ADDTYPE2'] ?? ($data['addtype2'] ?? null)) !== null) {
            $entity->setAddtype2((int) $value);
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'ChangeHistory' из массива, полученного от ФИАС.
     *
     * @param ChangeHistory $entity
     * @param array         $data
     *
     * @throws Exception
     */
    protected function fillChangeHistoryEntityWithData(ChangeHistory $entity, array $data): void
    {
        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@ADROBJECTID'] ?? ($data['adrobjectid'] ?? null)) !== null) {
            $entity->setAdrobjectid(trim($value));
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@NDOCID'] ?? ($data['ndocid'] ?? null)) !== null) {
            $entity->setNdocid((int) $value);
        }

        if (($value = $data['@CHANGEDATE'] ?? ($data['changedate'] ?? null)) !== null) {
            $entity->setChangedate(new DateTimeImmutable(trim($value)));
        }
    }

    /**
     * Задает все свойства модели 'Apartments' из массива, полученного от ФИАС.
     *
     * @param Apartments $entity
     * @param array      $data
     *
     * @throws Exception
     */
    protected function fillApartmentsEntityWithData(Apartments $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@APARTTYPE'] ?? ($data['aparttype'] ?? null)) !== null) {
            $entity->setAparttype((int) $value);
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'HouseTypes' из массива, полученного от ФИАС.
     *
     * @param HouseTypes $entity
     * @param array      $data
     *
     * @throws Exception
     */
    protected function fillHouseTypesEntityWithData(HouseTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'NormativeDocsKinds' из массива, полученного от ФИАС.
     *
     * @param NormativeDocsKinds $entity
     * @param array              $data
     *
     * @throws Exception
     */
    protected function fillNormativeDocsKindsEntityWithData(NormativeDocsKinds $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'ParamTypes' из массива, полученного от ФИАС.
     *
     * @param ParamTypes $entity
     * @param array      $data
     *
     * @throws Exception
     */
    protected function fillParamTypesEntityWithData(ParamTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@CODE'] ?? ($data['code'] ?? null)) !== null) {
            $entity->setCode(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'RoomTypes' из массива, полученного от ФИАС.
     *
     * @param RoomTypes $entity
     * @param array     $data
     *
     * @throws Exception
     */
    protected function fillRoomTypesEntityWithData(RoomTypes $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@DESC'] ?? ($data['desc'] ?? null)) !== null) {
            $entity->setDesc(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'NormativeDocs' из массива, полученного от ФИАС.
     *
     * @param NormativeDocs $entity
     * @param array         $data
     *
     * @throws Exception
     */
    protected function fillNormativeDocsEntityWithData(NormativeDocs $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@DATE'] ?? ($data['date'] ?? null)) !== null) {
            $entity->setDate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@NUMBER'] ?? ($data['number'] ?? null)) !== null) {
            $entity->setNumber(trim($value));
        }

        if (($value = $data['@TYPE'] ?? ($data['type'] ?? null)) !== null) {
            $entity->setType((int) $value);
        }

        if (($value = $data['@KIND'] ?? ($data['kind'] ?? null)) !== null) {
            $entity->setKind((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ORGNAME'] ?? ($data['orgname'] ?? null)) !== null) {
            $entity->setOrgname(trim($value));
        }

        if (($value = $data['@REGNUM'] ?? ($data['regnum'] ?? null)) !== null) {
            $entity->setRegnum(trim($value));
        }

        if (($value = $data['@REGDATE'] ?? ($data['regdate'] ?? null)) !== null) {
            $entity->setRegdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ACCDATE'] ?? ($data['accdate'] ?? null)) !== null) {
            $entity->setAccdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@COMMENT'] ?? ($data['comment'] ?? null)) !== null) {
            $entity->setComment(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'ObjectLevels' из массива, полученного от ФИАС.
     *
     * @param ObjectLevels $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillObjectLevelsEntityWithData(ObjectLevels $entity, array $data): void
    {
        if (($value = $data['@LEVEL'] ?? ($data['level'] ?? null)) !== null) {
            $entity->setLevel((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@SHORTNAME'] ?? ($data['shortname'] ?? null)) !== null) {
            $entity->setShortname(trim($value));
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive(trim($value));
        }
    }

    /**
     * Задает все свойства модели 'AdmHierarchy' из массива, полученного от ФИАС.
     *
     * @param AdmHierarchy $entity
     * @param array        $data
     *
     * @throws Exception
     */
    protected function fillAdmHierarchyEntityWithData(AdmHierarchy $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@PARENTOBJID'] ?? ($data['parentobjid'] ?? null)) !== null) {
            $entity->setParentobjid((int) $value);
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@REGIONCODE'] ?? ($data['regioncode'] ?? null)) !== null) {
            $entity->setRegioncode(trim($value));
        }

        if (($value = $data['@AREACODE'] ?? ($data['areacode'] ?? null)) !== null) {
            $entity->setAreacode(trim($value));
        }

        if (($value = $data['@CITYCODE'] ?? ($data['citycode'] ?? null)) !== null) {
            $entity->setCitycode(trim($value));
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

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'AddrObjDivision' из массива, полученного от ФИАС.
     *
     * @param AddrObjDivision $entity
     * @param array           $data
     *
     * @throws Exception
     */
    protected function fillAddrObjDivisionEntityWithData(AddrObjDivision $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@PARENTID'] ?? ($data['parentid'] ?? null)) !== null) {
            $entity->setParentid((int) $value);
        }

        if (($value = $data['@CHILDID'] ?? ($data['childid'] ?? null)) !== null) {
            $entity->setChildid((int) $value);
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'ReestrObjects' из массива, полученного от ФИАС.
     *
     * @param ReestrObjects $entity
     * @param array         $data
     *
     * @throws Exception
     */
    protected function fillReestrObjectsEntityWithData(ReestrObjects $entity, array $data): void
    {
        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@CREATEDATE'] ?? ($data['createdate'] ?? null)) !== null) {
            $entity->setCreatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@LEVELID'] ?? ($data['levelid'] ?? null)) !== null) {
            $entity->setLevelid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }

    /**
     * Задает все свойства модели 'AddrObj' из массива, полученного от ФИАС.
     *
     * @param AddrObj $entity
     * @param array   $data
     *
     * @throws Exception
     */
    protected function fillAddrObjEntityWithData(AddrObj $entity, array $data): void
    {
        if (($value = $data['@ID'] ?? ($data['id'] ?? null)) !== null) {
            $entity->setId((int) $value);
        }

        if (($value = $data['@OBJECTID'] ?? ($data['objectid'] ?? null)) !== null) {
            $entity->setObjectid((int) $value);
        }

        if (($value = $data['@OBJECTGUID'] ?? ($data['objectguid'] ?? null)) !== null) {
            $entity->setObjectguid(trim($value));
        }

        if (($value = $data['@CHANGEID'] ?? ($data['changeid'] ?? null)) !== null) {
            $entity->setChangeid((int) $value);
        }

        if (($value = $data['@NAME'] ?? ($data['name'] ?? null)) !== null) {
            $entity->setName(trim($value));
        }

        if (($value = $data['@TYPENAME'] ?? ($data['typename'] ?? null)) !== null) {
            $entity->setTypename(trim($value));
        }

        if (($value = $data['@LEVEL'] ?? ($data['level'] ?? null)) !== null) {
            $entity->setLevel(trim($value));
        }

        if (($value = $data['@OPERTYPEID'] ?? ($data['opertypeid'] ?? null)) !== null) {
            $entity->setOpertypeid((int) $value);
        }

        if (($value = $data['@PREVID'] ?? ($data['previd'] ?? null)) !== null) {
            $entity->setPrevid((int) $value);
        }

        if (($value = $data['@NEXTID'] ?? ($data['nextid'] ?? null)) !== null) {
            $entity->setNextid((int) $value);
        }

        if (($value = $data['@UPDATEDATE'] ?? ($data['updatedate'] ?? null)) !== null) {
            $entity->setUpdatedate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@STARTDATE'] ?? ($data['startdate'] ?? null)) !== null) {
            $entity->setStartdate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ENDDATE'] ?? ($data['enddate'] ?? null)) !== null) {
            $entity->setEnddate(new DateTimeImmutable(trim($value)));
        }

        if (($value = $data['@ISACTUAL'] ?? ($data['isactual'] ?? null)) !== null) {
            $entity->setIsactual((int) $value);
        }

        if (($value = $data['@ISACTIVE'] ?? ($data['isactive'] ?? null)) !== null) {
            $entity->setIsactive((int) $value);
        }
    }
}
