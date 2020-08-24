<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации.
 */
class AddressObjectType
{
    protected int $kodtst = 0;
    protected int $level = 0;
    protected string $socrname = '';
    protected ?string $scname = null;

    public function setKodtst(int $kodtst): self
    {
        $this->kodtst = $kodtst;

        return $this;
    }

    public function getKodtst(): int
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
