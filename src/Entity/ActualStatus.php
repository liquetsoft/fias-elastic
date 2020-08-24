<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Статус актуальности ФИАС.
 */
class ActualStatus
{
    /**
     * Идентификатор статуса (ключ).
     */
    protected int $actstatid = 0;

    /**
     * Наименование
     * 0 – Не актуальный
     * 1 – Актуальный (последняя запись по адресному объекту).
     */
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
