<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Перечень возможных состояний объектов недвижимости.
 */
class HouseStateStatus
{
    /** @var int */
    private $housestid = 0;

    /** @var string */
    private $name = '';

    public function setHousestid(int $housestid): self
    {
        $this->housestid = $housestid;

        return $this;
    }

    public function getHousestid(): int
    {
        return $this->housestid;
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
