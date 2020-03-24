<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

use Liquetsoft\Fias\Elastic\EntityInterface;

/**
 * Перечень статусов актуальности записи адресного элемента по классификатору КЛАДР4.0.
 */
class CurrentStatus implements EntityInterface
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

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentType(): string
    {
        return 'CurrentStatus';
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentId(): string
    {
        return (string) $this->curentstid;
    }

    /**
     * @inheritDoc
     */
    public function getElasticSearchDocumentData(): array
    {
        return [
            'curentstid' => $this->curentstid,
            'name' => $this->name,
        ];
    }
}
