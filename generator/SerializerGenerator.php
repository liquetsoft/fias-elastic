<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use DateTime;
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
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Объект, который создает класс для сериализатора сущностей ФИАС.
 */
class SerializerGenerator extends AbstractGenerator
{
    /**
     * @inheritDoc
     */
    protected function generate(SplFileInfo $dir, string $namespace): void
    {
        $name = 'CompiledFiasEntitesDenormalizer';
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
        $namespace->addUse(InvalidArgumentException::class);
        $namespace->addUse(Exception::class);

        $descriptors = $this->registry->getDescriptors();
        foreach ($descriptors as $descriptor) {
            $namespace->addUse($this->createModelClass($descriptor));
            foreach ($descriptor->getFields() as $field) {
                if ($field->getSubType() === 'date') {
                    $namespace->addUse(DateTime::class);
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
        $constants = [];

        $denormalizeBody = '$data = is_array($data) ? $data : [];' . "\n";
        $denormalizeBody .= '$type = trim($type, " \t\n\r\0\x0B\\\\/");' . "\n\n";
        $denormalizeBody .= "\$entity = \$context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? new \$type();\n\n";
        $denormalizeBody .= "switch (\$type) {\n";

        $descriptors = $this->registry->getDescriptors();
        foreach ($descriptors as $descriptor) {
            $className = $this->unifyClassName($descriptor->getName());
            $constants[] = new PhpLiteral("{$className}::class");
            $denormalizeBody .= "    case {$className}::class:\n";
            $denormalizeBody .= "        \$this->fill{$className}EntityWithData(\$entity, \$data);\n";
            $denormalizeBody .= "        break;\n";
        }

        $denormalizeBody .= "    default:\n";
        $denormalizeBody .= "        \$message = sprintf(\"Can't find data extractor for '%s' type.\", \$type);\n";
        $denormalizeBody .= "        throw new InvalidArgumentException(\$message);\n";
        $denormalizeBody .= "}\n\n";
        $denormalizeBody .= 'return $entity;';

        $class->addComment('Скомпилированный класс для денормализации сущностей ФИАС в модели для elasticsearch.');
        $class->addConstant('ALLOWED_ENTITIES', $constants)->setPrivate();

        $supports = $class->addMethod('supportsDenormalization')
            ->addComment("@inheritDoc\n")
            ->setVisibility('public')
            ->setBody('return in_array(trim($type, " \t\n\r\0\x0B\\\\/"), self::ALLOWED_ENTITIES);');
        $supports->addParameter('data');
        $supports->addParameter('type')->setType('string');
        $supports->addParameter('format', new PhpLiteral('null'))->setType('string');

        $denormalize = $class->addMethod('denormalize')
            ->addComment("{@inheritDoc}\n")
            ->addComment("@psalm-suppress InvalidStringClass\n")
            ->addComment("\n")
            ->addComment("@throws Exception\n")
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

        $body = "if (!(\$entity instanceof {$className})) {";
        $body .= "    throw new InvalidArgumentException('Wrong entity to denormalize.');";
        $body .= '}';

        foreach ($descriptor->getFields() as $field) {
            $column = $this->unifyColumnName($field->getName());
            $xmlAttribute = '@' . strtoupper($column);
            $type = trim($field->getType() . '_' . $field->getSubType(), ' _');
            switch ($type) {
                case 'int':
                    $varType = "(int) \$data['{$xmlAttribute}']";
                    break;
                case 'string_date':
                    $varType = "new DateTime(trim(\$data['{$xmlAttribute}']))";
                    break;
                default:
                    $varType = "trim(\$data['{$xmlAttribute}'])";
                    break;
            }
            $body .= "\n\nif ((\$value = \$data['{$xmlAttribute}'] ?? (\$data['{$column}'] ?? null)) !== null) {";
            $body .= '    $entity->set' . ucfirst($column) . "($varType);";
            $body .= '}';
        }

        $method->addComment("Задает все свойства модели '{$className}' из массива, полученного от ФИАС.\n");
        $method->addComment("@param object \$entity\n");
        $method->addComment("@param array \$data\n");
        $method->addComment("\n");
        $method->addComment('@throws Exception');
        $method->addParameter('entity')->setType('object');
        $method->addParameter('data')->setType('array');
        $method->setVisibility('private');
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
     * @inheritDoc
     */
    protected function generateClassByDescriptor(EntityDescriptor $descriptor, SplFileInfo $dir, string $namespace): void
    {
    }
}
