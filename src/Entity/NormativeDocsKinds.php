<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения по видам нормативных документов.
 */
class NormativeDocsKinds
{
    /**
     * Идентификатор записи.
     */
    protected int $id = 0;

    /**
     * Наименование.
     */
    protected string $name = '';

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
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
