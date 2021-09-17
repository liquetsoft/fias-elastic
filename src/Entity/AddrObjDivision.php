<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по операциям переподчинения.
 */
class AddrObjDivision
{
    /**
     * Уникальный идентификатор записи. Ключевое поле.
     */
    protected int $id = 0;

    /**
     * Родительский ID.
     */
    protected int $parentid = 0;

    /**
     * Дочерний ID.
     */
    protected int $childid = 0;

    /**
     * ID изменившей транзакции.
     */
    protected int $changeid = 0;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setParentid(int $parentid): self
    {
        $this->parentid = $parentid;

        return $this;
    }

    public function getParentid(): int
    {
        return $this->parentid;
    }

    public function setChildid(int $childid): self
    {
        $this->childid = $childid;

        return $this;
    }

    public function getChildid(): int
    {
        return $this->childid;
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
}
