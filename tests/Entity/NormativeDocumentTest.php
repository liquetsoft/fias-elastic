<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTimeImmutable;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocument;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования'.
 *
 * @internal
 */
class NormativeDocumentTest extends EntityCase
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity()
    {
        return new NormativeDocument();
    }

    /**
     * {@inheritDoc}
     */
    protected function accessorsProvider(): array
    {
        return [
            'normdocid' => $this->createFakeData()->word,
            'docname' => $this->createFakeData()->word,
            'docdate' => new DateTimeImmutable(),
            'docnum' => $this->createFakeData()->word,
            'doctype' => $this->createFakeData()->numberBetween(1, 1000000),
            'docimgid' => $this->createFakeData()->word,
        ];
    }
}
