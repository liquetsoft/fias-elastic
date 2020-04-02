<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень полных, сокращённых наименований типов адресных элементов и уровней их классификации.
 */
class AddressObjectType implements EntityInterface
{
    /** @var int */
    private $kodtst = 0;

    /** @var int */
    private $level = 0;

    /** @var string */
    private $socrname = '';

    /** @var string|null */
    private $scname;

    public function setKodtst(int $kodtst): self
    {
        $this->kodtst = $kodtst;

        return $this;
    }

    public function getKodtst(): int
    {
        return $this->kodtst;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setSocrname(string $socrname): self
    {
        $this->socrname = $socrname;

        return $this;
    }

    public function getSocrname(): string
    {
        return $this->socrname;
    }

    public function setScname(?string $scname): self
    {
        $this->scname = $scname;

        return $this;
    }

    public function getScname(): ?string
    {
        return $this->scname;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchIndex(): string
    {
        return 'addressobjecttype';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchId(): string
    {
        return (string) $this->kodtst;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchData(): array
    {
        return [
            'kodtst' => $this->kodtst,
            'level' => $this->level,
            'socrname' => $this->socrname,
            'scname' => $this->scname,
        ];
    }
}
