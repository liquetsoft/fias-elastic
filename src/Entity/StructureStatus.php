<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень видов строений.
 */
class StructureStatus
{
    protected int $strstatid = 0;
    protected string $name = '';
    protected ?string $shortname = null;

    public function setStrstatid(int $strstatid): self
    {
        $this->strstatid = $strstatid;

        return $this;
    }

    public function getStrstatid(): int
    {
        return $this->strstatid;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }
}
