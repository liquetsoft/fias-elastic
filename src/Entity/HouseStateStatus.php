<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень возможных состояний объектов недвижимости.
 */
class HouseStateStatus implements EntityInterface
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

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'HouseStateStatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->housestid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'housestid' => $this->housestid,
            'name' => $this->name,
        ];
    }
}
