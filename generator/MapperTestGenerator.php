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
        $this->decorateNamespace($namespace, $descriptor, 'Liquetsoft\\Fias\\Elastic\\IndexMapper', $baseName);

        $class = $namespace->addClass($name);
        $this->decorateClass($class, $descriptor);

        $this->decorateNameTest($class->addMethod('testGetName'), $descriptor);
        $this->decorateMapTest($class->addMethod('testGetMappingProperties'), $descriptor);

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
        $namespace->addUse('Liquetsoft\\Fias\\Elastic\\Tests\\BaseCase');
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
        $baseName = $this->unifyClassName($descriptor->getName());
        $name = $baseName . 'IndexMapper';
        $lowerName = strtolower($baseName);

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
        $baseName = $this->unifyClassName($descriptor->getName());
        $name = $baseName . 'IndexMapper';

        $method->addBody("\$mapper = new $name();");
        $method->addBody('$map = $mapper->getMappingProperties();');
        $method->addBody('');
        $method->addBody('$this->assertIsArray($map);');
        foreach ($descriptor->getFields() as $field) {
            $name = $this->unifyColumnName($field->getName());
            $method->addBody("\$this->assertArrayHasKey('{$name}', \$map);");
        }
    }
}
