<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Liquetsoft\Fias\Component\EntityField\EntityField;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Property;
use Nette\PhpGenerator\PsrPrinter;

/**
 * Объект, который создает классы моделей из описания моделей в yaml.
 */
class ModelGenerator extends AbstractGenerator
{
    /**
     * {@inheritDoc}
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, \SplFileInfo $dir, string $namespace): void
    {
        $name = $this->unifyClassName($descriptor->getName());
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile();
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace, $descriptor);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        foreach ($descriptor->getFields() as $field) {
            $name = $this->unifyColumnName($field->getName());
            $setter = 'set' . ucfirst($name);
            $getter = 'get' . ucfirst($name);

            $this->decorateProperty($class->addProperty($name), $field);
            $this->decorateSetter($class->addMethod($setter), $field);
            $this->decorateGetter($class->addMethod($getter), $field);
        }

        file_put_contents($fullPath, (new PsrPrinter())->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace     $namespace
     * @param EntityDescriptor $descriptor
     */
    protected function decorateNamespace(PhpNamespace $namespace, EntityDescriptor $descriptor): void
    {
        foreach ($descriptor->getFields() as $field) {
            if ($field->getSubType() === 'date') {
                $namespace->addUse(\DateTimeInterface::class);
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
        $description = ucfirst(trim($descriptor->getDescription(), " \t\n\r\0\x0B."));
        if ($description) {
            $class->addComment("{$description}.\n");
        }
    }

    /**
     * Добавляет все необходимые для свойства комментарии.
     *
     * @param Property    $property
     * @param EntityField $field
     */
    protected function decorateProperty(Property $property, EntityField $field): void
    {
        $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
        switch ($type) {
            case 'int':
                $property->setValue($field->isNullable() ? null : 0);
                $property->setType('int');
                if ($field->isNullable()) {
                    $property->setNullable();
                }
                break;
            case 'string_date':
                $property->setValue(null);
                $property->setType(\DateTimeInterface::class);
                $property->setNullable();
                break;
            default:
                $property->setValue($field->isNullable() ? null : '');
                $property->setType('string');
                if ($field->isNullable()) {
                    $property->setNullable();
                }
                break;
        }

        $property->setVisibility('protected');
        $property->setInitialized();
        if ($field->getDescription()) {
            $description = ucfirst(rtrim($field->getDescription(), " \t\n\r\0\x0B.")) . '.';
            $property->addComment("{$description}\n");
        }
    }

    /**
     * Добавляет все необходимые для сеттера комментарии.
     *
     * @param Method      $method
     * @param EntityField $field
     */
    protected function decorateSetter(Method $method, EntityField $field): void
    {
        $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
        switch ($type) {
            case 'int':
                $paramHint = 'int';
                break;
            case 'string_date':
                $paramHint = 'DateTimeInterface';
                break;
            default:
                $paramHint = 'string';
                break;
        }

        $parameterName = $this->unifyColumnName($field->getName());
        $parameter = $method->addParameter($parameterName);
        $parameter->setType($paramHint);
        if ($field->isNullable()) {
            $parameter->setNullable();
        }

        $method->setVisibility('public');
        $method->setReturnType('self');
        $method->setBody("\$this->{$parameterName} = \${$parameterName};\n\nreturn \$this;");
    }

    /**
     * Добавляет все необходимые для геттера комментарии.
     *
     * @param Method      $method
     * @param EntityField $field
     */
    protected function decorateGetter(Method $method, EntityField $field): void
    {
        $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
        switch ($type) {
            case 'int':
                $returnHint = 'int';
                $method->setReturnType($returnHint);
                if ($field->isNullable()) {
                    $method->setReturnNullable();
                }
                break;
            case 'string_date':
                $returnHint = 'DateTimeInterface';
                $method->setReturnType($returnHint);
                $method->setReturnNullable();
                break;
            default:
                $returnHint = 'string';
                $method->setReturnType($returnHint);
                if ($field->isNullable()) {
                    $method->setReturnNullable();
                }
                break;
        }

        $parameterName = $this->unifyColumnName($field->getName());

        $method->setVisibility('public');
        $method->setBody("return \$this->{$parameterName};");
    }
}
