<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень возможных статусов (центров) адресных объектов административных единиц.
 */
class CenterStatus
{
    /** @var int */
    protected $centerstid = 0;

    /** @var string */
    protected $name = '';

    public function setCenterstid(int $centerstid): self
    {
        $this->centerstid = $centerstid;

        return $this;
    }

    public function getCenterstid(): int
    {
        return $this->centerstid;
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
}
