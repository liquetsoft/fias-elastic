<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\IndexMapper;

use Liquetsoft\Fias\Elastic\IndexMapperInterface;

/**
 * Описание полей индекса для сущности 'Сведения по нормативному документу, являющемуся основанием присвоения адресному элементу наименования'.
 */
class NormativeDocumentIndexMapper implements IndexMapperInterface
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
    public function getMap(): array
    {
        return [
            'dynamic' => 'strict',
            '_doc' => [
                'properties' => [
                    'normdocid' => [
                        'type' => 'keyword',
                    ],
                    'docname' => [
                        'type' => 'text',
                    ],
                    'docdate' => [
                        'type' => 'date',
                        'format' => 'yyyy-mm-dd\'T\'HH:mm:ss',
                    ],
                    'docnum' => [
                        'type' => 'text',
                    ],
                    'doctype' => [
                        'type' => 'text',
                    ],
                ],
            ],
        ];
    }
}
