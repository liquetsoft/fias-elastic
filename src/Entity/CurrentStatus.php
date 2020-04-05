<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0.
 */
class CurrentStatus
{
    /** @var int */
    private $curentstid = 0;

    /** @var string */
    private $name = '';

    public function setCurentstid(int $curentstid): self
    {
        $this->curentstid = $curentstid;

        return $this;
    }

    public function getCurentstid(): int
    {
        return $this->curentstid;
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
