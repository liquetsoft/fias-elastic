<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\Entity;

use DateTime;
use Liquetsoft\Fias\Elastic\Entity\NormativeDocument;
use Liquetsoft\Fias\Elastic\Tests\EntityCase;

/**
 * Тест для сущности 'Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования'.
 */
class NormativeDocumentTest extends EntityCase
{
    /**
     * @inheritdoc
     */
    protected function createEntity()
    {
        return new NormativeDocument();
    }

    /**
     * @inheritdoc
     */
    protected function accessorsProvider(): array
    {
        return [
            'normdocid' => $this->createFakeData()->word,
            'docname' => $this->createFakeData()->word,
            'docdate' => new DateTime,
            'docnum' => $this->createFakeData()->word,
            'doctype' => $this->createFakeData()->word,
        ];
    }
}
