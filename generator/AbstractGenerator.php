<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Generator;

use Liquetsoft\Fias\Component\EntityDescriptor\EntityDescriptor;
use Liquetsoft\Fias\Component\EntityRegistry\EntityRegistry;

/**
 * Абстрактный класс для генераторов сущностей.
 */
abstract class AbstractGenerator
{
    protected EntityRegistry $registry;

    public function __construct(EntityRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Создает php класс для указанного дескриптора.
     *
     * @param EntityDescriptor $descriptor
     * @param \SplFileInfo     $dir
     * @param string           $namespace
     *
     * @throws \Throwable
     */
    abstract protected function generateClassByDescriptor(EntityDescriptor $descriptor, \SplFileInfo $dir, string $namespace): void;

    /**
     * Создает классы сущностей в указанной папке с указанным пространством имен.
     *
     * @param \SplFileInfo $dir
     * @param string       $namespace
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function run(\SplFileInfo $dir, string $namespace = ''): void
    {
        $this->checkDir($dir);
        $unifiedNamespace = $this->unifyNamespace($namespace);

        try {
            $this->generate($dir, $unifiedNamespace);
        } catch (\Throwable $e) {
            $message = 'Error while class generation.';
            throw new \RuntimeException($message, 0, $e);
        }
    }

    /**
     * Процесс генерации классов.
     *
     * @param \SplFileInfo $dir
     * @param string       $namespace
     *
     * @throws \Throwable
     */
    protected function generate(\SplFileInfo $dir, string $namespace): void
    {
        $descriptors = $this->registry->getDescriptors();
        foreach ($descriptors as $descriptor) {
            $this->generateClassByDescriptor($descriptor, $dir, $namespace);
        }
    }

    /**
     * Проверяет, что каталог существует и доступен на запись.
     *
     * @param \SplFileInfo $dir
     *
     * @throws \InvalidArgumentException
     */
    protected function checkDir(\SplFileInfo $dir): void
    {
        if (!$dir->isDir() || !$dir->isWritable()) {
            throw new \InvalidArgumentException(
                "Destination folder '" . $dir->getPathname() . "' isn't writable or doesn't exist."
            );
        }
    }

    /**
     * Приводит пространсва имен к единообразному виду.
     *
     * @param string $namespace
     *
     * @return string
     */
    protected function unifyClassName(string $name): string
    {
        $arName = array_map('ucfirst', array_map('strtolower', explode('_', $name)));

        return implode('', $arName);
    }

    /**
     * Приводит пространства имен к единообразному виду.
     *
     * @param string $namespace
     *
     * @return string
     */
    protected function unifyNamespace(string $namespace): string
    {
        return trim($namespace, " \t\n\r\0\x0B\\");
    }

    /**
     * Приводит имена колонок к единообразному виду.
     *
     * @param string $name
     *
     * @return string
     */
    protected function unifyColumnName(string $name): string
    {
        return str_replace('_', '', trim(strtolower($name)));
    }
}
