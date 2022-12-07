<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use Liquetsoft\Fias\Elastic\Entity\ChangeHistory;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по истории изменений'.
 *
 * @internal
 */
class ChangeHistoryTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new ChangeHistory();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'changeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'objectid' => $this->createFakeData()->numberBetween(1, 1000000),
            'adrobjectid' => $this->createFakeData()->word,
            'opertypeid' => $this->createFakeData()->numberBetween(1, 1000000),
            'ndocid' => $this->createFakeData()->numberBetween(1, 1000000),
            'changedate' => new \DateTimeImmutable(),
        ];
    }
}
