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
use SplFileInfo;

/**
 * Объект, который создает классы моделей из описания моделей в yaml.
 */
class ModelGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
        $name = $this->unifyClassName($descriptor->getName());
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile;
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace, $descriptor);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        $primary = null;
        foreach ($descriptor->getFields() as $field) {
            $name = $this->unifyColumnName($field->getName());
            $setter = 'set' . ucfirst($name);
            $getter = 'get' . ucfirst($name);

            $this->decorateProperty($class->addProperty($name), $field);
            $this->decorateSetter($class->addMethod($setter), $field);
            $this->decorateGetter($class->addMethod($getter), $field);

            if ($field->isPrimary()) {
                $primary = $field;
            }
        }

        $this->decorateElasticIndexGetter($class->addMethod('getElasticSearchIndex'), $descriptor);
        if ($primary) {
            $this->decorateElasticIdGetter($class->addMethod('getElasticSearchId'), $primary);
        }
        $this->decorateElasticDataGetter($class->addMethod('getElasticSearchData'), $descriptor);

        file_put_contents($fullPath, (new PsrPrinter)->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace     $namespace
     * @param EntityDescriptor $descriptor
     */
    protected function decorateNamespace(PhpNamespace $namespace, EntityDescriptor $descriptor): void
    {
        $namespace->addUse('\\Liquetsoft\\Fias\\Elastic\\EntityInterface');
        foreach ($descriptor->getFields() as $field) {
            if ($field->getSubType() === 'date') {
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
        $class->addImplement('\\Liquetsoft\\Fias\\Elastic\\EntityInterface');

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
                $defaultValue = $field->isNullable() ? null : 0;
                $varType = 'int' . ($field->isNullable() ? '|null' : '');
                break;
            case 'string_date':
                $defaultValue = null;
                $varType = 'DateTimeInterface' . ($field->isNullable() ? '|null' : '');
                break;
            default:
                $defaultValue = $field->isNullable() ? null : '';
                $varType = 'string' . ($field->isNullable() ? '|null' : '');
                break;
        }

        $property->setValue($defaultValue);
        $property->setVisibility('private');
        if ($field->getDescription()) {
            $description = ucfirst(rtrim($field->getDescription(), " \t\n\r\0\x0B.")) . '.';
            $property->addComment("{$description}\n");
        }
        $property->addComment("@var {$varType}");
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
                break;
            case 'string_date':
                $returnHint = 'DateTimeInterface';
                break;
            default:
                $returnHint = 'string';
                break;
        }

        $parameterName = $this->unifyColumnName($field->getName());

        $method->setVisibility('public');
        $method->setReturnType($returnHint);
        if ($field->isNullable()) {
            $method->setReturnNullable();
        }
        $method->setBody("return \$this->{$parameterName};");
    }

    /**
     * Задает метод для возвращения уникального ключа документа.
     *
     * @param Method      $method
     * @param EntityField $field
     */
    private function decorateElasticIdGetter(Method $method, EntityField $field): void
    {
        $parameterName = $this->unifyColumnName($field->getName());

        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('string');
        if ($field->getType() === 'string') {
            $method->setBody("return \$this->{$parameterName};");
        } else {
            $method->setBody("return (string) \$this->{$parameterName};");
        }
    }

    /**
     * Задает метод для возвращения типа документа.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateElasticIndexGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $name = strtolower($this->unifyClassName($descriptor->getName()));

        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('string');
        $method->setBody("return \"{$name}\";");
    }

    /**
     * Задает метод для возвращения данных документа.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateElasticDataGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('array');

        $fields = [];
        foreach ($descriptor->getFields() as $field) {
            $fieldName = $this->unifyColumnName($field->getName());
            $type = trim($field->getType() . '_' . $field->getSubType(), ' _');

            $value = "'{$fieldName}' => \$this->{$fieldName}";
            if ($type === 'string_date') {
                if ($field->isNullable()) {
                    $value = "'{$fieldName}' => \$this->{$fieldName} ? \$this->{$fieldName}->format('Y-m-d\TH:i:s') : null";
                } else {
                    $value = "'{$fieldName}' => \$this->{$fieldName}->format('Y-m-d\TH:i:s')";
                }
            }

            $fields[] = $value;
        }

        $body = "return [\n    " . implode(",\n    ", $fields) . "\n];";
        $method->addBody($body);
    }
}
