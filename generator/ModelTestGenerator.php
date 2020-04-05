<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
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
        $baseName = $this->unifyClassName($descriptor->getName());
        $name = $baseName . 'Test';
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile;
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace, $descriptor, 'Liquetsoft\\Fias\\Elastic\\Entity', $baseName);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        $this->decorateCreateEntity($class->addMethod('createEntity'), $descriptor);
        $this->decorateCreateAccessors($class->addMethod('accessorsProvider'), $descriptor);

        file_put_contents($fullPath, (new PsrPrinter)->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace     $namespace
     * @param EntityDescriptor $descriptor
     * @param string           $baseNamespace
     * @param string           $baseName
     */
    protected function decorateNamespace(PhpNamespace $namespace, EntityDescriptor $descriptor, string $baseNamespace, string $baseName): void
    {
        $namespace->addUse('Liquetsoft\\Fias\\Elastic\\Tests\\EntityCase');
        $namespace->addUse($baseNamespace . '\\' . $baseName);
        foreach ($descriptor->getFields() as $field) {
            if ($field->getSubType() === 'date') {
                $namespace->addUse('DateTime');
                $namespace->addUse('DateTimeInterface');
            }
        }
    }

    /**
     * Добавляет всен необходимые для класса комментарии.
     *
     * @param ClassType        $class
     * @param EntityDescriptor $descriptor
     */
    protected function decorateClass(ClassType $class, EntityDescriptor $descriptor): void
    {
        $class->setExtends('Liquetsoft\\Fias\\Elastic\\Tests\\EntityCase');
        $description = trim($descriptor->getDescription(), " \t\n\r\0\x0B.");
        if ($description) {
            $class->addComment("Тест для сущности '{$description}'.\n");
        }
    }

    /**
     * Добавляет метод с созданием сущности.
     *
     * @param Method           $createEntityMethod
     * @param EntityDescriptor $descriptor
     */
    private function decorateCreateEntity(Method $createEntityMethod, EntityDescriptor $descriptor): void
    {
        $baseName = $this->unifyClassName($descriptor->getName());
        $createEntityMethod->addComment("@inheritdoc\n");
        $createEntityMethod->setVisibility('protected');
        $createEntityMethod->setBody("return new {$baseName}();");
    }

    /**
     * Добавляет метод с созданием сущности.
     *
     * @param Method           $accessorsProviderMethod
     * @param EntityDescriptor $descriptor
     */
    private function decorateCreateAccessors(Method $accessorsProviderMethod, EntityDescriptor $descriptor): void
    {
        $accessors = "return [\n";
        foreach ($descriptor->getFields() as $field) {
            $name = $this->unifyColumnName($field->getName());
            $value = '$this->createFakeData()->word';
            $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
            if ($type === 'int') {
                $value = '$this->createFakeData()->numberBetween(1, 1000000)';
            } elseif ($type === 'string_date') {
                $value = 'new DateTime()';
            }
            $accessors .= "    '{$name}' => {$value},\n";
        }
        $accessors .= '];';

        $accessorsProviderMethod->setVisibility('protected');
        $accessorsProviderMethod->setReturnType('array');
        $accessorsProviderMethod->setBody($accessors);
        $accessorsProviderMethod->addComment("@inheritdoc\n");
    }
}
