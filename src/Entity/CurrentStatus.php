<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Статус актуальности КЛАДР 4.0.
 */
class CurrentStatus
{
    /**
     * Идентификатор статуса (ключ).
     */
    protected int $curentstid = 0;

    /**
     * Наименование (0 - актуальный, 1-50, 2-98 – исторический (кроме 51), 51 - переподчиненный, 99 - несуществующий).
     */
    protected string $name = '';

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
