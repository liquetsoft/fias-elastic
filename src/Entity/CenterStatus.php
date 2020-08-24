<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Статус центра.
 */
class CenterStatus
{
    /**
     * Идентификатор статуса.
     */
    protected int $centerstid = 0;

    /**
     * Наименование.
     */
    protected string $name = '';

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
