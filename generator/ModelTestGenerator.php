<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use SplFileInfo;

/**
 * Объект, который создает классы тестов для моделей из описания моделей в yaml.
 */
class ModelTestGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
    }
}
