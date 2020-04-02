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
    public function testGetElasticSearchIndex()
    {
        $this->assertSame('normativedocument', $this->createEntity()->getElasticSearchIndex());
    }

    public function testGetElasticSearchId()
    {
        $value = $this->createFakeData()->word;

        $entity = $this->createEntity();
        $entity->setNormdocid($value);

        $this->assertSame((string) $value, $entity->getElasticSearchId());
    }

    public function testGetElasticSearchData()
    {
        $entity = $this->createEntity();
        $entity->setNormdocid($this->createFakeData()->word);
        $entity->setDocname($this->createFakeData()->word);
        $entity->setDocdate(new DateTime());
        $entity->setDocnum($this->createFakeData()->word);
        $entity->setDoctype($this->createFakeData()->word);

        $arrayToTest = [
            'normdocid' => $entity->getNormdocid(),
            'docname' => $entity->getDocname(),
            'docdate' => $entity->getDocdate()->format('Y-m-d\TH:i:s'),
            'docnum' => $entity->getDocnum(),
            'doctype' => $entity->getDoctype(),
        ];

        $this->assertSame($arrayToTest, $entity->getElasticSearchData());
    }

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
            'docdate' => new DateTime(),
            'docnum' => $this->createFakeData()->word,
            'doctype' => $this->createFakeData()->word,
        ];
    }
}
