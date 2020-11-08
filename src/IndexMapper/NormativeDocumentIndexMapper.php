<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperAbstract;

/**
 * Описание полей индекса для сущности 'Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования'.
 */
class NormativeDocumentIndexMapper extends IndexMapperAbstract
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'normativedocument';
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryName(): string
    {
        return 'normdocid';
    }

    /**
     * @inheritDoc
     */
    public function getMappingProperties(): array
    {
        return [
            'normdocid' => [
                'type' => 'keyword',
            ],
            'docname' => [
                'type' => 'text',
            ],
            'docdate' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd\'T\'HH:mm:ss',
            ],
            'docnum' => [
                'type' => 'keyword',
            ],
            'doctype' => [
                'type' => 'integer',
            ],
            'docimgid' => [
                'type' => 'keyword',
            ],
        ];
    }
}
