<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Exception;
use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Liquetsoft\Fias\Component\Exception\EntityRegistryException;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpLiteral;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use SplFileInfo;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Объект, который создает класс для сериализатора сущностей ФИАС.
 */
class NormalizerGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generate(SplFileInfo $dir, string $namespace): void
    {
        $name = 'CompiledFiasEntitiesNormalizer';
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile();
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace);

        $class = $namespace->addClass($name)->addImplement(NormalizerInterface::class);
        $this->decorateClass($class);

        file_put_contents($fullPath, (new PsrPrinter())->printFile($phpFile));
    }

    /**
     * Добавляет все необходимые импорты в пространство имен.
     *
     * @param PhpNamespace $namespace
     *
     * @throws EntityRegistryException
     */
    protected function decorateNamespace(PhpNamespace $namespace): void
    {
        $namespace->addUse(NormalizerInterface::class);
        $namespace->addUse(InvalidArgumentException::class);
        $namespace->addUse(Exception::class);

        $descriptors = $this->registry->getDescriptors();
        foreach ($descriptors as $descriptor) {
            $namespace->addUse($this->createModelClass($descriptor));
        }
    }

    /**
     * Добавляет в класс все необходимые методы и константы.
     *
     * @param ClassType $class
     *
     * @throws EntityRegistryException
     */
    protected function decorateClass(ClassType $class): void
    {
        $descriptors = $this->registry->getDescriptors();

        $count = 0;
        $supportsBody = 'return ';
        $denormalizeBody = '';
        foreach ($descriptors as $descriptor) {
            $className = $this->unifyClassName($descriptor->getName());
            if ($count === 0) {
                $denormalizeBody .= "if (\$object instanceof {$className}) {\n";
                $supportsBody .= "\$data instanceof {$className}";
            } else {
                $denormalizeBody .= " elseif (\$object instanceof {$className}) {\n";
                $supportsBody .= "\n    || \$data instanceof {$className}";
            }
            $denormalizeBody .= "    \$data = \$this->getDataFrom{$className}Entity(\$object);\n";
            $denormalizeBody .= '}';
            ++$count;
        }
        $supportsBody .= ';';
        $denormalizeBody .= " else {\n";
        $denormalizeBody .= "    throw new Exception('Wrong entity object.');\n";
        $denormalizeBody .= "}\n\n";
        $denormalizeBody .= 'return $data;';

        $class->addComment('Скомпилированный класс для нормализации сущностей ФИАС в модели для elasticsearch.');

        $supports = $class->addMethod('supportsNormalization')
            ->addComment("@inheritDoc\n")
            ->setVisibility('public')
            ->setBody($supportsBody);
        $supports->addParameter('data');
        $supports->addParameter('format', new PhpLiteral('null'))->setType('string');

        $denormalize = $class->addMethod('normalize')
            ->addComment("{@inheritDoc}\n")
            ->addComment("\n")
            ->addComment("@throws Exception\n")
            ->setVisibility('public')
            ->setBody($denormalizeBody);
        $denormalize->addParameter('object');
        $denormalize->addParameter('format', new PhpLiteral('null'))->setType('string');
        $denormalize->addParameter('context', new PhpLiteral('[]'))->setType('array');

        foreach ($descriptors as $descriptor) {
            $className = $this->unifyClassName($descriptor->getName());
            $entityMethod = $class->addMethod("getDataFrom{$className}Entity");
            $this->decorateModelDataGetter($entityMethod, $descriptor);
        }
    }

    /**
     * Создает метод для нормализации одной конкретной модели.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    protected function decorateModelDataGetter(Method $method, EntityDescriptor $descriptor): void
    {
        $className = $this->unifyClassName($descriptor->getName());

        $body = "return [\n";
        foreach ($descriptor->getFields() as $field) {
            $column = $this->unifyColumnName($field->getName());
            $getter = 'get' . ucfirst($column);
            $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
            switch ($type) {
                case 'string_date':
                    $varType = "'{$column}' => (\$date = \$object->{$getter}()) ? \$date->format(DATE_ATOM) : null";
                    break;
                default:
                    $varType = "'{$column}' => \$object->{$getter}()";
                    break;
            }
            $body .= "    {$varType},\n";
        }
        $body .= '];';

        $method->addComment("Возвращает все свойства модели '{$className}'.\n");
        $method->addComment("@param {$className} \$object\n");
        $method->addComment("\n");
        $method->addComment('@return array');
        $method->addParameter('object')->setType($this->createModelClass($descriptor));
        $method->setVisibility('protected');
        $method->setReturnType('array');
        $method->setBody($body);
    }

    /**
     * Создает имя класса для модели дескриптора.
     *
     * @param EntityDescriptor $descriptor
     *
     * @return string
     */
    protected function createModelClass(EntityDescriptor $descriptor): string
    {
        return 'Liquetsoft\\Fias\\Elastic\\Entity\\' . $this->unifyClassName($descriptor->getName());
    }

    /**
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
    }
}
