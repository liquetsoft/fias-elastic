<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Тип адресного объекта.
 */
class AddressObjectType
{
    /**
     * Ключевое поле.
     */
    protected string $kodtst = '';

    /**
     * Уровень адресного объекта.
     */
    protected int $level = 0;

    /**
     * Полное наименование типа объекта.
     */
    protected string $socrname = '';

    /**
     * Краткое наименование типа объекта.
     */
    protected ?string $scname = null;

    public function setKodtst(string $kodtst): self
    {
        $this->kodtst = $kodtst;

        return $this;
    }

    public function getKodtst(): string
    {
        return $this->kodtst;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setSocrname(string $socrname): self
    {
        $this->socrname = $socrname;

        return $this;
    }

    public function getSocrname(): string
    {
        return $this->socrname;
    }

    public function setScname(?string $scname): self
    {
        $this->scname = $scname;

        return $this;
    }

    public function getScname(): ?string
    {
        return $this->scname;
    }
}
