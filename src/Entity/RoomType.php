<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень типов комнат.
 */
class RoomType
{
    /** @var int */
    protected $rmtypeid = 0;

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $shortname = '';

    public function setRmtypeid(int $rmtypeid): self
    {
        $this->rmtypeid = $rmtypeid;

        return $this;
    }

    public function getRmtypeid(): int
    {
        return $this->rmtypeid;
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
