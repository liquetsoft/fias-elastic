<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень возможных значений интервалов домов (обычный, четный, нечетный).
 */
class IntervalStatus
{
    /** @var int */
    private $intvstatid = 0;

    /** @var string */
    private $name = '';

    public function setIntvstatid(int $intvstatid): self
    {
        $this->intvstatid = $intvstatid;

        return $this;
    }

    public function getIntvstatid(): int
    {
        return $this->intvstatid;
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
