<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень типов помещения или офиса.
 */
class FlatType
{
    /** @var int */
    private $fltypeid = 0;

    /** @var string */
    private $name = '';

    /** @var string */
    private $shortname = '';

    public function setFltypeid(int $fltypeid): self
    {
        $this->fltypeid = $fltypeid;

        return $this;
    }

    public function getFltypeid(): int
    {
        return $this->fltypeid;
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

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname(): string
    {
        return $this->shortname;
    }
}
