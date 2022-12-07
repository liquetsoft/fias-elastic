<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Liquetsoft\Fias\Component\Exception\EntityRegistryException;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpLiteral;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Объект, который создает класс для сериализатора сущностей ФИАС.
 */
class SerializerGenerator extends AbstractGenerator
{
    /**
     * {@inheritDoc}
     */
    protected function generate(\SplFileInfo $dir, string $namespace): void
    {
        $name = 'CompiledFiasEntitiesDenormalizer';
        $fullPath = "{$dir->getPathname()}/{$name}.php";

        $phpFile = new PhpFile();
        $phpFile->setStrictTypes();

        $namespace = $phpFile->addNamespace($namespace);
        $this->decorateNamespace($namespace);

        $class = $namespace->addClass($name)->addImplement(DenormalizerInterface::class);
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
        $namespace->addUse(DenormalizerInterface::class);
        $namespace->addUse(AbstractNormalizer::class);
        $namespace->addUse(\Exception::class);

        $descriptors = $this->registry->getDescriptors();
        foreach ($descriptors as $descriptor) {
            $namespace->addUse($this->createModelClass($descriptor));
            foreach ($descriptor->getFields() as $field) {
                if ($field->getSubType() === 'date') {
                    $namespace->addUse(\DateTimeImmutable::class);
                    break;
                }
            }
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
        $denormalizeBody = '$data = \\is_array($data) ? $data : [];' . "\n";
        $denormalizeBody .= '$type = trim($type, " \t\n\r\0\x0B\\\\/");' . "\n\n";
        $denormalizeBody .= "\$entity = \$context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? new \$type();\n\n";
        foreach ($descriptors as $descriptor) {
            $className = $this->unifyClassName($descriptor->getName());
            $supports = [
                $className,
            ];
            if ($count === 0) {
                $denormalizeBody .= "if (\$entity instanceof {$className}) {\n";
                $supportsBody .= "is_subclass_of(\$type, {$className}::class)";
            } else {
                $denormalizeBody .= " elseif (\$entity instanceof {$className}) {\n";
                $supportsBody .= "\n    || is_subclass_of(\$type, {$className}::class)";
            }
            $denormalizeBody .= "    \$this->fill{$className}EntityWithData(\$entity, \$data);\n";
            $denormalizeBody .= '}';
            ++$count;
        }
        $supportsBody .= ';';
        $denormalizeBody .= " else {\n";
        $denormalizeBody .= "    throw new Exception('Wrong entity object.');\n";
        $denormalizeBody .= "}\n\n";
        $denormalizeBody .= 'return $entity;';

        $class->addComment('Скомпилированный класс для денормализации сущностей ФИАС в модели для elasticsearch.');

        $supports = $class->addMethod('supportsDenormalization')
            ->addComment('{@inheritDoc}')
            ->setVisibility('public')
            ->setBody($supportsBody);
        $supports->addParameter('data');
        $supports->addParameter('type')->setType('string');
        $supports->addParameter('format', new PhpLiteral('null'))->setType('string');

        $denormalize = $class->addMethod('denormalize')
            ->addComment("{@inheritDoc}\n")
            ->addComment("@psalm-suppress InvalidStringClass\n")
            ->addComment('@throws Exception')
            ->setVisibility('public')
            ->setBody($denormalizeBody);
        $denormalize->addParameter('data');
        $denormalize->addParameter('type')->setType('string');
        $denormalize->addParameter('format', new PhpLiteral('null'))->setType('string');
        $denormalize->addParameter('context', new PhpLiteral('[]'))->setType('array');

        foreach ($descriptors as $descriptor) {
            $className = $this->unifyClassName($descriptor->getName());
            $entityMethod = $class->addMethod("fill{$className}EntityWithData");
            $this->decorateModelDataFiller($entityMethod, $descriptor);
        }
    }

    /**
     * Создает метод для денормализации одной конкретной модели.
     *
     * @param Method           $method
     * @param EntityDescriptor $descriptor
     */
    protected function decorateModelDataFiller(Method $method, EntityDescriptor $descriptor): void
    {
        $className = $this->unifyClassName($descriptor->getName());

        $body = '';
        foreach ($descriptor->getFields() as $field) {
            $column = $this->unifyColumnName($field->getName());
            $xmlAttribute = '@' . strtoupper($column);
            $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
            switch ($type) {
                case 'int':
                    $varType = '(int) $value';
                    break;
                case 'string_date':
                    $varType = 'new DateTimeImmutable(trim((string) $value))';
                    break;
                default:
                    $varType = 'trim((string) $value)';
                    break;
            }
            $body .= "\n\nif ((\$value = \$data['{$xmlAttribute}'] ?? (\$data['{$column}'] ?? null)) !== null) {\n";
            $body .= '    $entity->set' . ucfirst($column) . "($varType);\n";
            $body .= '}';
        }

        $method->addComment("Задает все свойства модели '{$className}' из массива, полученного от ФИАС.\n");
        $method->addComment("@param {$className} \$entity");
        $method->addComment("@param array \$data\n");
        $method->addComment('@throws Exception');
        $method->addParameter('entity')->setType($this->createModelClass($descriptor));
        $method->addParameter('data')->setType('array');
        $method->setVisibility('protected');
        $method->setReturnType('void');
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
     * {@inheritDoc}
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, \SplFileInfo $dir, string $namespace): void
    {
    }
}
