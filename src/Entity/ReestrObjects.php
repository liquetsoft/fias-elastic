<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения об адресном элементе в части его идентификаторов.
 */
class ReestrObjects
{
    /**
     * Уникальный идентификатор объекта.
     */
    protected int $objectid = 0;

    /**
     * Дата создания.
     */
    protected ?\DateTimeInterface $createdate = null;

    /**
     * ID изменившей транзакции.
     */
    protected int $changeid = 0;

    /**
     * Уровень объекта.
     */
    protected int $levelid = 0;

    /**
     * Дата обновления.
     */
    protected ?\DateTimeInterface $updatedate = null;

    /**
     * GUID объекта.
     */
    protected string $objectguid = '';

    /**
     * Признак действующего объекта (1 - действующий, 0 - не действующий).
     */
    protected int $isactive = 0;

    public function setObjectid(int $objectid): self
    {
        $this->objectid = $objectid;

        return $this;
    }

    public function getObjectid(): int
    {
        return $this->objectid;
    }

    public function setCreatedate(\DateTimeInterface $createdate): self
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setChangeid(int $changeid): self
    {
        $this->changeid = $changeid;

        return $this;
    }

    public function getChangeid(): int
    {
        return $this->changeid;
    }

    public function setLevelid(int $levelid): self
    {
        $this->levelid = $levelid;

        return $this;
    }

    public function getLevelid(): int
    {
        return $this->levelid;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setObjectguid(string $objectguid): self
    {
        $this->objectguid = $objectguid;

        return $this;
    }

    public function getObjectguid(): string
    {
        return $this->objectguid;
    }

    public function setIsactive(int $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getIsactive(): int
    {
        return $this->isactive;
    }
}
