<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Liquetsoft\Fias\Component\EntityField\EntityField;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use SplFileInfo;

/**
 * Объект, который создает классы мапперов для индексов elasticsearch.
 */
class MapperGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
        $name = $this->unifyClassName($descriptor->getName()) . 'IndexMapper';
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile;
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        $this->decorateNameGetter($class->addMethod('getName'), $descriptor);
        $this->decoratePrimaryNameGetter($class->addMethod('getPrimaryName'), $descriptor);
        $this->decorateMapGetter($class->addMethod('getMappingProperties'), $descriptor);

        file_put_contents($fullPath, (new PsrPrinter)->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace $namespace
     */
    protected function decorateNamespace(PhpNamespace $namespace): void
    {
        $namespace->addUse('\\Liquetsoft\\Fias\\Elastic\\IndexMapperAbstract');
    }

    /**
     * Добавляет всен необходимые для класса комментарии.
     *
     * @param ClassType        $class
     * @param EntityDescriptor $descriptor
     */
    protected function decorateClass(ClassType $class, EntityDescriptor $descriptor): void
    {
        $class->setExtends('\\Liquetsoft\\Fias\\Elastic\\IndexMapperAbstract');

        $description = ucfirst(trim($descriptor->getDescription(), " \t\n\r\0\x0B."));
        if ($description) {
            $class->addComment("Описание полей индекса для сущности '{$description}'.\n");
        }
    }

    /**
     * Задает метод для возвращения имени индекса.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateNameGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $name = strtolower($this->unifyClassName($descriptor->getName()));

        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('string');
        $method->setBody("return '{$name}';");
    }

    /**
     * Задает метод для возвращения описание полей индекса.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateMapGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('array');

        $body = [];
        foreach ($descriptor->getFields() as $field) {
            $fieldName = $this->unifyColumnName($field->getName());
            $type = $this->convertFieldTypeToElasticType($field);
            $format = $this->convertFieldTypeToElasticFormat($field);
            $body[] = "'{$fieldName}' => [";
            $body[] = "    'type' => '{$type}',";
            if ($format !== null) {
                $body[] = "    'format' => {$format},";
            }
            $body[] = '],';
        }

        $method->setBody("return [\n    " . implode("\n    ", $body) . "\n];");
    }

    /**
     * Задает метод для возвращения имени первичного ключа.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decoratePrimaryNameGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $method->addComment('@inheritDoc');
        $method->setVisibility('public');
        $method->setReturnType('string');

        foreach ($descriptor->getFields() as $field) {
            if ($field->isPrimary()) {
                $name = $this->unifyColumnName($field->getName());
                $method->setBody("return '{$name}';");
                break;
            }
        }
    }

    /**
     * Возвращает для поля его тип
     *
     * @param EntityField $field
     *
     * @return string
     */
    private function convertFieldTypeToElasticType(EntityField $field): string
    {
        if ($field->isPrimary() || $field->isIndex()) {
            return 'keyword';
        }

        $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
        switch ($type) {
            case 'int':
                $returnHint = 'integer';
                break;
            case 'string_date':
                $returnHint = 'date';
                break;
            default:
                $returnHint = 'text';
                break;
        }

        return $returnHint;
    }

    /**
     * Возвращает для поля его тип
     *
     * @param EntityField $field
     *
     * @return string
     */
    private function convertFieldTypeToElasticFormat(EntityField $field): ?string
    {
        if ($field->getSubType() === 'date') {
            return "'yyyy-mm-dd\'T\'HH:mm:ss'";
        }

        return null;
    }
}
