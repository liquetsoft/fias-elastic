<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень статусов актуальности записи адресного элемента по ФИАС.
 */
class ActualStatus
{
    protected int $actstatid = 0;
    protected string $name = '';

    public function setActstatid(int $actstatid): self
    {
        $this->actstatid = $actstatid;

        return $this;
    }

    public function getActstatid(): int
    {
        return $this->actstatid;
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
