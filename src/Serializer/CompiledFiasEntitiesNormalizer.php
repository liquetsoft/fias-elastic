<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Serializer;

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
        return $data instanceof FlatType
            || $data instanceof ActualStatus
            || $data instanceof OperationStatus
            || $data instanceof Room
            || $data instanceof AddressObjectType
            || $data instanceof RoomType
            || $data instanceof Stead
            || $data instanceof CenterStatus
            || $data instanceof NormativeDocument
            || $data instanceof CurrentStatus
            || $data instanceof NormativeDocumentType
            || $data instanceof EstateStatus
            || $data instanceof AddressObject
            || $data instanceof House
            || $data instanceof StructureStatus;
    }

    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        if ($object instanceof FlatType) {
            $data = $this->getDataFromFlatTypeEntity($object);
        } elseif ($object instanceof ActualStatus) {
            $data = $this->getDataFromActualStatusEntity($object);
        } elseif ($object instanceof OperationStatus) {
            $data = $this->getDataFromOperationStatusEntity($object);
        } elseif ($object instanceof Room) {
            $data = $this->getDataFromRoomEntity($object);
        } elseif ($object instanceof AddressObjectType) {
            $data = $this->getDataFromAddressObjectTypeEntity($object);
        } elseif ($object instanceof RoomType) {
            $data = $this->getDataFromRoomTypeEntity($object);
        } elseif ($object instanceof Stead) {
            $data = $this->getDataFromSteadEntity($object);
        } elseif ($object instanceof CenterStatus) {
            $data = $this->getDataFromCenterStatusEntity($object);
        } elseif ($object instanceof NormativeDocument) {
            $data = $this->getDataFromNormativeDocumentEntity($object);
        } elseif ($object instanceof CurrentStatus) {
            $data = $this->getDataFromCurrentStatusEntity($object);
        } elseif ($object instanceof NormativeDocumentType) {
            $data = $this->getDataFromNormativeDocumentTypeEntity($object);
        } elseif ($object instanceof EstateStatus) {
            $data = $this->getDataFromEstateStatusEntity($object);
        } elseif ($object instanceof AddressObject) {
            $data = $this->getDataFromAddressObjectEntity($object);
        } elseif ($object instanceof House) {
            $data = $this->getDataFromHouseEntity($object);
        } elseif ($object instanceof StructureStatus) {
            $data = $this->getDataFromStructureStatusEntity($object);
        } else {
            throw new Exception('Wrong entity object.');
        }

        return $data;
    }

    /**
     * Возвращает все свойства модели 'FlatType'.
     *
     * @param FlatType $object
     *
     * @return array
     */
    protected function getDataFromFlatTypeEntity(FlatType $object): array
    {
        return [
            'fltypeid' => $object->getFltypeid(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
        ];
    }

    /**
     * Возвращает все свойства модели 'ActualStatus'.
     *
     * @param ActualStatus $object
     *
     * @return array
     */
    protected function getDataFromActualStatusEntity(ActualStatus $object): array
    {
        return [
            'actstatid' => $object->getActstatid(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'OperationStatus'.
     *
     * @param OperationStatus $object
     *
     * @return array
     */
    protected function getDataFromOperationStatusEntity(OperationStatus $object): array
    {
        return [
            'operstatid' => $object->getOperstatid(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'Room'.
     *
     * @param Room $object
     *
     * @return array
     */
    protected function getDataFromRoomEntity(Room $object): array
    {
        return [
            'roomid' => $object->getRoomid(),
            'roomguid' => $object->getRoomguid(),
            'houseguid' => $object->getHouseguid(),
            'regioncode' => $object->getRegioncode(),
            'flatnumber' => $object->getFlatnumber(),
            'flattype' => $object->getFlattype(),
            'postalcode' => $object->getPostalcode(),
            'startdate' => ($date = $object->getStartdate()) ? $date->format(DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(DATE_ATOM) : null,
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(DATE_ATOM) : null,
            'operstatus' => $object->getOperstatus(),
            'livestatus' => $object->getLivestatus(),
            'normdoc' => $object->getNormdoc(),
            'roomnumber' => $object->getRoomnumber(),
            'roomtype' => $object->getRoomtype(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'cadnum' => $object->getCadnum(),
            'roomcadnum' => $object->getRoomcadnum(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AddressObjectType'.
     *
     * @param AddressObjectType $object
     *
     * @return array
     */
    protected function getDataFromAddressObjectTypeEntity(AddressObjectType $object): array
    {
        return [
            'kodtst' => $object->getKodtst(),
            'level' => $object->getLevel(),
            'socrname' => $object->getSocrname(),
            'scname' => $object->getScname(),
        ];
    }

    /**
     * Возвращает все свойства модели 'RoomType'.
     *
     * @param RoomType $object
     *
     * @return array
     */
    protected function getDataFromRoomTypeEntity(RoomType $object): array
    {
        return [
            'rmtypeid' => $object->getRmtypeid(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
        ];
    }

    /**
     * Возвращает все свойства модели 'Stead'.
     *
     * @param Stead $object
     *
     * @return array
     */
    protected function getDataFromSteadEntity(Stead $object): array
    {
        return [
            'steadguid' => $object->getSteadguid(),
            'number' => $object->getNumber(),
            'regioncode' => $object->getRegioncode(),
            'postalcode' => $object->getPostalcode(),
            'ifnsfl' => $object->getIfnsfl(),
            'ifnsul' => $object->getIfnsul(),
            'okato' => $object->getOkato(),
            'oktmo' => $object->getOktmo(),
            'parentguid' => $object->getParentguid(),
            'steadid' => $object->getSteadid(),
            'operstatus' => $object->getOperstatus(),
            'startdate' => ($date = $object->getStartdate()) ? $date->format(DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(DATE_ATOM) : null,
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(DATE_ATOM) : null,
            'livestatus' => $object->getLivestatus(),
            'divtype' => $object->getDivtype(),
            'normdoc' => $object->getNormdoc(),
            'terrifnsfl' => $object->getTerrifnsfl(),
            'terrifnsul' => $object->getTerrifnsul(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'cadnum' => $object->getCadnum(),
        ];
    }

    /**
     * Возвращает все свойства модели 'CenterStatus'.
     *
     * @param CenterStatus $object
     *
     * @return array
     */
    protected function getDataFromCenterStatusEntity(CenterStatus $object): array
    {
        return [
            'centerstid' => $object->getCenterstid(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'NormativeDocument'.
     *
     * @param NormativeDocument $object
     *
     * @return array
     */
    protected function getDataFromNormativeDocumentEntity(NormativeDocument $object): array
    {
        return [
            'normdocid' => $object->getNormdocid(),
            'docname' => $object->getDocname(),
            'docdate' => ($date = $object->getDocdate()) ? $date->format(DATE_ATOM) : null,
            'docnum' => $object->getDocnum(),
            'doctype' => $object->getDoctype(),
            'docimgid' => $object->getDocimgid(),
        ];
    }

    /**
     * Возвращает все свойства модели 'CurrentStatus'.
     *
     * @param CurrentStatus $object
     *
     * @return array
     */
    protected function getDataFromCurrentStatusEntity(CurrentStatus $object): array
    {
        return [
            'curentstid' => $object->getCurentstid(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'NormativeDocumentType'.
     *
     * @param NormativeDocumentType $object
     *
     * @return array
     */
    protected function getDataFromNormativeDocumentTypeEntity(NormativeDocumentType $object): array
    {
        return [
            'ndtypeid' => $object->getNdtypeid(),
            'name' => $object->getName(),
        ];
    }

    /**
     * Возвращает все свойства модели 'EstateStatus'.
     *
     * @param EstateStatus $object
     *
     * @return array
     */
    protected function getDataFromEstateStatusEntity(EstateStatus $object): array
    {
        return [
            'eststatid' => $object->getEststatid(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
        ];
    }

    /**
     * Возвращает все свойства модели 'AddressObject'.
     *
     * @param AddressObject $object
     *
     * @return array
     */
    protected function getDataFromAddressObjectEntity(AddressObject $object): array
    {
        return [
            'aoid' => $object->getAoid(),
            'aoguid' => $object->getAoguid(),
            'parentguid' => $object->getParentguid(),
            'previd' => $object->getPrevid(),
            'nextid' => $object->getNextid(),
            'code' => $object->getCode(),
            'formalname' => $object->getFormalname(),
            'offname' => $object->getOffname(),
            'shortname' => $object->getShortname(),
            'aolevel' => $object->getAolevel(),
            'regioncode' => $object->getRegioncode(),
            'areacode' => $object->getAreacode(),
            'autocode' => $object->getAutocode(),
            'citycode' => $object->getCitycode(),
            'ctarcode' => $object->getCtarcode(),
            'placecode' => $object->getPlacecode(),
            'plancode' => $object->getPlancode(),
            'streetcode' => $object->getStreetcode(),
            'extrcode' => $object->getExtrcode(),
            'sextcode' => $object->getSextcode(),
            'plaincode' => $object->getPlaincode(),
            'currstatus' => $object->getCurrstatus(),
            'actstatus' => $object->getActstatus(),
            'livestatus' => $object->getLivestatus(),
            'centstatus' => $object->getCentstatus(),
            'operstatus' => $object->getOperstatus(),
            'ifnsfl' => $object->getIfnsfl(),
            'ifnsul' => $object->getIfnsul(),
            'terrifnsfl' => $object->getTerrifnsfl(),
            'terrifnsul' => $object->getTerrifnsul(),
            'okato' => $object->getOkato(),
            'oktmo' => $object->getOktmo(),
            'postalcode' => $object->getPostalcode(),
            'startdate' => ($date = $object->getStartdate()) ? $date->format(DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(DATE_ATOM) : null,
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(DATE_ATOM) : null,
            'divtype' => $object->getDivtype(),
            'normdoc' => $object->getNormdoc(),
        ];
    }

    /**
     * Возвращает все свойства модели 'House'.
     *
     * @param House $object
     *
     * @return array
     */
    protected function getDataFromHouseEntity(House $object): array
    {
        return [
            'houseid' => $object->getHouseid(),
            'houseguid' => $object->getHouseguid(),
            'aoguid' => $object->getAoguid(),
            'housenum' => $object->getHousenum(),
            'strstatus' => $object->getStrstatus(),
            'eststatus' => $object->getEststatus(),
            'statstatus' => $object->getStatstatus(),
            'ifnsfl' => $object->getIfnsfl(),
            'ifnsul' => $object->getIfnsul(),
            'okato' => $object->getOkato(),
            'oktmo' => $object->getOktmo(),
            'postalcode' => $object->getPostalcode(),
            'startdate' => ($date = $object->getStartdate()) ? $date->format(DATE_ATOM) : null,
            'enddate' => ($date = $object->getEnddate()) ? $date->format(DATE_ATOM) : null,
            'updatedate' => ($date = $object->getUpdatedate()) ? $date->format(DATE_ATOM) : null,
            'counter' => $object->getCounter(),
            'divtype' => $object->getDivtype(),
            'regioncode' => $object->getRegioncode(),
            'terrifnsfl' => $object->getTerrifnsfl(),
            'terrifnsul' => $object->getTerrifnsul(),
            'buildnum' => $object->getBuildnum(),
            'strucnum' => $object->getStrucnum(),
            'normdoc' => $object->getNormdoc(),
            'cadnum' => $object->getCadnum(),
        ];
    }

    /**
     * Возвращает все свойства модели 'StructureStatus'.
     *
     * @param StructureStatus $object
     *
     * @return array
     */
    protected function getDataFromStructureStatusEntity(StructureStatus $object): array
    {
        return [
            'strstatid' => $object->getStrstatid(),
            'name' => $object->getName(),
            'shortname' => $object->getShortname(),
        ];
    }
}
