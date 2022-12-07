<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Serializer;

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
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Скомпилированный класс для нормализации сущностей ФИАС в модели для elasticsearch.
 */
class CompiledFiasEntitiesNormalizer implements NormalizerInterface
{
    /**
     * {@inheritDoc}
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Rooms
            || $data instanceof AddrObjTypes
            || $data instanceof Param
            || $data instanceof Steads
            || $data instanceof Carplaces
            || $data instanceof MunHierarchy
            || $data instanceof NormativeDocsTypes
            || $data instanceof ApartmentTypes
            || $data instanceof OperationTypes
            || $data instanceof Houses
            || $data instanceof ChangeHistory
            || $data instanceof Apartments
            || $data instanceof HouseTypes
            || $data instanceof NormativeDocsKinds
            || $data instanceof ParamTypes
            || $data instanceof RoomTypes
            || $data instanceof NormativeDocs
            || $data instanceof ObjectLevels
            || $data instanceof AdmHierarchy
            || $data instanceof AddrObjDivision
            || $data instanceof ReestrObjects
            || $data instanceof AddrObj;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Exception
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        if ($object instanceof Rooms) {
            $data = $this->getDataFromRoomsEntity($object);
        } elseif ($object instanceof AddrObjTypes) {
            $data = $this->getDataFromAddrObjTypesEntity($object);
        } elseif ($object instanceof Param) {
            $data = $this->getDataFromParamEntity($object);
        } elseif ($object instanceof Steads) {
            $data = $this->getDataFromSteadsEntity($object);
        } elseif ($object instanceof Carplaces) {
            $data = $this->getDataFromCarplacesEntity($object);
        } elseif ($object instanceof MunHierarchy) {
            $data = $this->getDataFromMunHierarchyEntity($object);
        } elseif ($object instanceof NormativeDocsTypes) {
            $data = $this->getDataFromNormativeDocsTypesEntity($object);
        } elseif ($object instanceof ApartmentTypes) {
            $data = $this->getDataFromApartmentTypesEntity($object);
        } elseif ($object instanceof OperationTypes) {
            $data = $this->getDataFromOperationTypesEntity($object);
        } elseif ($object instanceof Houses) {
            $data = $this->getDataFromHousesEntity($object);
        } elseif ($object instanceof ChangeHistory) {
            $data = $this->getDataFromChangeHistoryEntity($object);
        } elseif ($object instanceof Apartments) {
            $data = $this->getDataFromApartmentsEntity($object);
        } elseif ($object instanceof HouseTypes) {
            $data = $this->getDataFromHouseTypesEntity($object);
        } elseif ($object instanceof NormativeDocsKinds) {
            $data = $this->getDataFromNormativeDocsKindsEntity($object);
        } elseif ($object instanceof ParamTypes) {
            $data = $this->getDataFromParamTypesEntity($object);
        } elseif ($object instanceof RoomTypes) {
            $data = $this->getDataFromRoomTypesEntity($object);
        } elseif ($object instanceof NormativeDocs) {
            $data = $this->getDataFromNormativeDocsEntity($object);
        } elseif ($object instanceof ObjectLevels) {
            $data = $this->getDataFromObjectLevelsEntity($object);
        } elseif ($object instanceof AdmHierarchy) {
            $data = $this->getDataFromAdmHierarchyEntity($object);
        } elseif ($object instanceof AddrObjDivision) {
            $data = $this->getDataFromAddrObjDivisionEntity($object);
        } elseif ($object instanceof ReestrObjects) {
            $data = $this->getDataFromReestrObjectsEntity($object);
        } elseif ($object instanceof AddrObj) {
            $data = $this->getDataFromAddrObjEntity($object);
        } else {
            throw new \Exception('Wrong entity object.');
        }

        return $data;
    }

    /**
     * Возвращает все свойства модели 'Rooms'.
     *
     * @param Rooms $object
     *
     * @return array
     */
    protected function getDataFromRoomsEntity(Rooms $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'number' => $object->getNumber(),
            'roomtype' => $object->getRoomtype(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AddrObjTypes'.
     *
     * @param AddrObjTypes $object
     *
     * @return array
     */
    protected function getDataFromAddrObjTypesEntity(AddrObjTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'level' => $object->getLevel(),
            'shortname' => $object->getShortname(),
            'name' => $object->getName(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'Param'.
     *
     * @param Param $object
     *
     * @return array
     */
    protected function getDataFromParamEntity(Param $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'changeid' => $object->getChangeid(),
            'changeidend' => $object->getChangeidend(),
            'typeid' => $object->getTypeid(),
            'value' => $object->getValue(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
        ];
    }

    /**
     * Возвращает все свойства модели 'Steads'.
     *
     * @param Steads $object
     *
     * @return array
     */
    protected function getDataFromSteadsEntity(Steads $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'number' => $object->getNumber(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'Carplaces'.
     *
     * @param Carplaces $object
     *
     * @return array
     */
    protected function getDataFromCarplacesEntity(Carplaces $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'number' => $object->getNumber(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'MunHierarchy'.
     *
     * @param MunHierarchy $object
     *
     * @return array
     */
    protected function getDataFromMunHierarchyEntity(MunHierarchy $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'parentobjid' => $object->getParentobjid(),
            'changeid' => $object->getChangeid(),
            'oktmo' => $object->getOktmo(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'NormativeDocsTypes'.
     *
     * @param NormativeDocsTypes $object
     *
     * @return array
     */
    protected function getDataFromNormativeDocsTypesEntity(NormativeDocsTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
        ];
    }

    /**
     * Возвращает все свойства модели 'ApartmentTypes'.
     *
     * @param ApartmentTypes $object
     *
     * @return array
     */
    protected function getDataFromApartmentTypesEntity(ApartmentTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'OperationTypes'.
     *
     * @param OperationTypes $object
     *
     * @return array
     */
    protected function getDataFromOperationTypesEntity(OperationTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'Houses'.
     *
     * @param Houses $object
     *
     * @return array
     */
    protected function getDataFromHousesEntity(Houses $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'housenum' => $object->getHousenum(),
            'addnum1' => $object->getAddnum1(),
            'addnum2' => $object->getAddnum2(),
            'housetype' => $object->getHousetype(),
            'addtype1' => $object->getAddtype1(),
            'addtype2' => $object->getAddtype2(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'ChangeHistory'.
     *
     * @param ChangeHistory $object
     *
     * @return array
     */
    protected function getDataFromChangeHistoryEntity(ChangeHistory $object): array
    {
        return [
            'changeid' => $object->getChangeid(),
            'objectid' => $object->getObjectid(),
            'adrobjectid' => $object->getAdrobjectid(),
            'opertypeid' => $object->getOpertypeid(),
            'ndocid' => $object->getNdocid(),
            'changedate' => ($date = $object->getChangedate()) ? $date->format(\DATE_ATOM) : null,
        ];
    }

    /**
     * Возвращает все свойства модели 'Apartments'.
     *
     * @param Apartments $object
     *
     * @return array
     */
    protected function getDataFromApartmentsEntity(Apartments $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'number' => $object->getNumber(),
            'aparttype' => $object->getAparttype(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'HouseTypes'.
     *
     * @param HouseTypes $object
     *
     * @return array
     */
    protected function getDataFromHouseTypesEntity(HouseTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'NormativeDocsKinds'.
     *
     * @param NormativeDocsKinds $object
     *
     * @return array
     */
    protected function getDataFromNormativeDocsKindsEntity(NormativeDocsKinds $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'ParamTypes'.
     *
     * @param ParamTypes $object
     *
     * @return array
     */
    protected function getDataFromParamTypesEntity(ParamTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'code' => $object->getCode(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'RoomTypes'.
     *
     * @param RoomTypes $object
     *
     * @return array
     */
    protected function getDataFromRoomTypesEntity(RoomTypes $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
            'desc' => $object->getDesc(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'NormativeDocs'.
     *
     * @param NormativeDocs $object
     *
     * @return array
     */
    protected function getDataFromNormativeDocsEntity(NormativeDocs $object): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'date' => ($date = $object->getDate()) ? $date->format(\DATE_ATOM) : null,
            'number' => $object->getNumber(),
            'type' => $object->getType(),
            'kind' => $object->getKind(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'orgname' => $object->getOrgname(),
            'regnum' => $object->getRegnum(),
            'regdate' => ($date = $object->getRegdate()) ? $date->format(\DATE_ATOM) : null,
            'accdate' => ($date = $object->getAccdate()) ? $date->format(\DATE_ATOM) : null,
            'comment' => $object->getComment(),
        ];
    }

    /**
     * Возвращает все свойства модели 'ObjectLevels'.
     *
     * @param ObjectLevels $object
     *
     * @return array
     */
    protected function getDataFromObjectLevelsEntity(ObjectLevels $object): array
    {
        return [
            'level' => $object->getLevel(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AdmHierarchy'.
     *
     * @param AdmHierarchy $object
     *
     * @return array
     */
    protected function getDataFromAdmHierarchyEntity(AdmHierarchy $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'parentobjid' => $object->getParentobjid(),
            'changeid' => $object->getChangeid(),
            'regioncode' => $object->getRegioncode(),
            'areacode' => $object->getAreacode(),
            'citycode' => $object->getCitycode(),
            'placecode' => $object->getPlacecode(),
            'plancode' => $object->getPlancode(),
            'streetcode' => $object->getStreetcode(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AddrObjDivision'.
     *
     * @param AddrObjDivision $object
     *
     * @return array
     */
    protected function getDataFromAddrObjDivisionEntity(AddrObjDivision $object): array
    {
        return [
            'id' => $object->getId(),
            'parentid' => $object->getParentid(),
            'childid' => $object->getChildid(),
            'changeid' => $object->getChangeid(),
        ];
    }

    /**
     * Возвращает все свойства модели 'ReestrObjects'.
     *
     * @param ReestrObjects $object
     *
     * @return array
     */
    protected function getDataFromReestrObjectsEntity(ReestrObjects $object): array
    {
        return [
            'objectid' => $object->getObjectid(),
            'createdate' => ($date = $object->getCreatedate()) ? $date->format(\DATE_ATOM) : null,
            'changeid' => $object->getChangeid(),
            'levelid' => $object->getLevelid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'objectguid' => $object->getObjectguid(),
            'isactive' => $object->getIsactive(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AddrObj'.
     *
     * @param AddrObj $object
     *
     * @return array
     */
    protected function getDataFromAddrObjEntity(AddrObj $object): array
    {
        return [
            'id' => $object->getId(),
            'objectid' => $object->getObjectid(),
            'objectguid' => $object->getObjectguid(),
            'changeid' => $object->getChangeid(),
            'name' => $object->getName(),
            'typename' => $object->getTypename(),
            'level' => $object->getLevel(),
            'opertypeid' => $object->getOpertypeid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(\DATE_ATOM) : null,
            'startdate' => ($date = $object->getStartdate()) ? $date->format(\DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(\DATE_ATOM) : null,
            'isactual' => $object->getIsactual(),
            'isactive' => $object->getIsactive(),
        ];
    }
}
