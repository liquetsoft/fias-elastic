<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень кодов операций над адресными объектами.
 */
class OperationStatus
{
    protected int $operstatid = 0;
    protected string $name = '';

    public function setOperstatid(int $operstatid): self
    {
        $this->operstatid = $operstatid;

        return $this;
    }

    public function getOperstatid(): int
    {
        return $this->operstatid;
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
