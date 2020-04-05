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
 * Объект, который создает классы тестов для мапперов.
 */
class MapperTestGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
        $baseName = $this->unifyClassName($descriptor->getName()) . 'IndexMapper';
        $name = $baseName . 'Test';
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile;
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace, 'Liquetsoft\\Fias\\Elastic\\IndexMapper', $baseName);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        $this->decorateNameTest($class->addMethod('testGetName'), $descriptor);
        $this->decorateGetPrimaryNameTest($class->addMethod('testGetPrimaryName'), $descriptor);
        $this->decorateMapTest($class->addMethod('testGetMappingProperties'), $descriptor);
        $this->decorateExtractPrimaryFromEntityTest($class->addMethod('testExtractPrimaryFromEntity'), $descriptor);
        $this->decorateExtractDataFromEntityTest($class->addMethod('testExtractDataFromEntity'), $descriptor);

        file_put_contents($fullPath, (new PsrPrinter)->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace $namespace
     * @param string       $baseNamespace
     * @param string       $baseName
     */
    protected function decorateNamespace(PhpNamespace $namespace, string $baseNamespace, string $baseName): void
    {
        $namespace->addUse('Liquetsoft\\Fias\\Elastic\\Tests\\BaseCase');
        $namespace->addUse('stdClass');
        $namespace->addUse('DateTime');
        $namespace->addUse($baseNamespace . '\\' . $baseName);
    }

    /**
     * Добавляет всен необходимые для класса комментарии.
     *
     * @param ClassType        $class
     * @param EntityDescriptor $descriptor
     */
    protected function decorateClass(ClassType $class, EntityDescriptor $descriptor): void
    {
        $class->setExtends('Liquetsoft\\Fias\\Elastic\\Tests\\BaseCase');
        $description = trim($descriptor->getDescription(), " \t\n\r\0\x0B.");
        if ($description) {
            $class->addComment("Тест для описания индекса сущности '{$description}'.\n");
        }
    }

    /**
     * Создает метод для проверки того, что маппер вернет правильное имя индекса.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateNameTest(Method $method, EntityDescriptor $descriptor): void
    {
        $name = $this->getTestedObjectName($descriptor);
        $lowerName = strtolower($descriptor->getName());

        $method->addBody("\$mapper = new $name();");
        $method->addBody('');
        $method->addBody("\$this->assertSame('{$lowerName}', \$mapper->getName());");
    }

    /**
     * Создает метод для проверки того, что маппер вернет правильное описание индекса.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateMapTest(Method $method, EntityDescriptor $descriptor): void
    {
        $name = $this->getTestedObjectName($descriptor);

        $method->addBody("\$mapper = new $name();");
        $method->addBody('$map = $mapper->getMappingProperties();');
        $method->addBody('');
        $method->addBody('$this->assertIsArray($map);');
        foreach ($descriptor->getFields() as $field) {
            $name = $this->unifyColumnName($field->getName());
            $method->addBody("\$this->assertArrayHasKey('{$name}', \$map);");
        }
    }

    /**
     * Создает метод для проверки того, что маппер вернет правильное имя первичного ключа.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateGetPrimaryNameTest(Method $method, EntityDescriptor $descriptor): void
    {
        $name = $this->getTestedObjectName($descriptor);

        $method->addBody("\$mapper = new $name();");
        $method->addBody('');

        foreach ($descriptor->getFields() as $field) {
            if ($field->isPrimary()) {
                $name = $this->unifyColumnName($field->getName());
                $method->addBody("\$this->assertSame('{$name}', \$mapper->getPrimaryName());");
                break;
            }
        }
    }

    /**
     * Создает метод для проверки того, что маппер вернет правильное значение первичного ключа.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateExtractPrimaryFromEntityTest(Method $method, EntityDescriptor $descriptor): void
    {
        $entityName = $this->getTestedObjectName($descriptor);

        $primaryName = null;
        foreach ($descriptor->getFields() as $field) {
            if ($field->isPrimary()) {
                $primaryName = $this->unifyColumnName($field->getName());
                break;
            }
        }

        $method->addBody('$entity = new stdClass();');
        $method->addBody("\$entity->{$primaryName} = 'primary_value';");
        $method->addBody('');
        $method->addBody("\$mapper = new $entityName();");
        $method->addBody('');
        $method->addBody('$this->assertSame(\'primary_value\', $mapper->extractPrimaryFromEntity($entity));');
    }

    /**
     * Создает метод для проверки того, что маппер получит данные из объекта для записи.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    private function decorateExtractDataFromEntityTest(Method $method, EntityDescriptor $descriptor): void
    {
        $entityName = $this->getTestedObjectName($descriptor);

        $method->addBody('$entity = new stdClass();');
        foreach ($descriptor->getFields() as $field) {
            $fieldName = $this->unifyColumnName($field->getName());
            if ($field->getSubType() === 'date') {
                $method->addBody("\$entity->{$fieldName} = new DateTime();");
            } elseif ($field->getType() === 'int') {
                $method->addBody("\$entity->{$fieldName} = \$this->createFakeData()->numberBetween(1, 100000);");
            } else {
                $method->addBody("\$entity->{$fieldName} = \$this->createFakeData()->word;");
            }
        }

        $method->addBody('');
        $method->addBody("\$mapper = new $entityName();");
        $method->addBody('$dataForElastic = $mapper->extractDataFromEntity($entity);');
        $method->addBody('');
        $method->addBody('$this->assertIsArray($dataForElastic);');
        foreach ($descriptor->getFields() as $field) {
            $fieldName = $this->unifyColumnName($field->getName());
            $method->addBody("\$this->assertArrayHasKey('{$fieldName}', \$dataForElastic);");
            if ($field->getSubType() === 'date') {
                $method->addBody("\$this->assertSame(\$entity->{$fieldName}->format('Y-m-d\TH:i:s'), \$dataForElastic['{$fieldName}'], 'Test {$fieldName} field conversion.');");
            } elseif ($field->isPrimary() || $field->isIndex()) {
                $method->addBody("\$this->assertSame((string) \$entity->{$fieldName}, \$dataForElastic['{$fieldName}'], 'Test {$fieldName} field conversion.');");
            } else {
                $method->addBody("\$this->assertSame(\$entity->{$fieldName}, \$dataForElastic['{$fieldName}'], 'Test {$fieldName} field conversion.');");
            }
        }
    }

    /**
     * Возвращает имя класса для тестов.
     *
     * @param EntityDescriptor $descriptor
     *
     * @return string
     */
    private function getTestedObjectName(EntityDescriptor $descriptor): string
    {
        $baseName = $this->unifyClassName($descriptor->getName());

        return $baseName . 'IndexMapper';
    }
}
