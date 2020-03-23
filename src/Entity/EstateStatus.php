<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень возможных видов владений.
 */
class EstateStatus
{
    /** @var int */
    private $eststatid = 0;

    /** @var string */
    private $name = '';

    public function setEststatid(int $eststatid): self
    {
        $this->eststatid = $eststatid;

        return $this;
    }

    public function getEststatid(): int
    {
        return $this->eststatid;
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
