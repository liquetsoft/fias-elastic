<?php

declare(strict_types=1);

use Liquetsoft\Fias\Component\EntityRegistry\PhpArrayFileRegistry;
use Liquetsoft\Fias\Elastic\Generator\MapperGenerator;
use Liquetsoft\Fias\Elastic\Generator\MapperTestGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelTestGenerator;
use Liquetsoft\Fias\Elastic\Generator\NormalizerGenerator;
use Liquetsoft\Fias\Elastic\Generator\SerializerGenerator;
use Marvin255\FileSystemHelper\FileSystemFactory;

$root = dirname(__DIR__);

require_once dirname(__DIR__) . '/vendor/autoload.php';

$fs = FileSystemFactory::create();
$registry = new PhpArrayFileRegistry();

$dir = $root . '/src/Entity';
$fs->mkdirIfNotExist($dir);
$fs->emptyDir($dir);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Entity';
$generator = new ModelGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/Entity';
$fs->mkdirIfNotExist($dir);
$fs->emptyDir($dir);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\Entity';
$generator = new ModelTestGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/src/IndexMapper';
$fs->mkdirIfNotExist($dir);
$fs->emptyDir($dir);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\IndexMapper';
$generator = new MapperGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/IndexMapper';
$fs->mkdirIfNotExist($dir);
$fs->emptyDir($dir);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\IndexMapper';
$generator = new MapperTestGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = new SplFileInfo($root . '/src/Serializer');
$fs->mkdirIfNotExist($dir);
$fs->emptyDir($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Serializer';
$generator = new SerializerGenerator($registry);
$generator->run($dir, $namespace);
$generator = new NormalizerGenerator($registry);
$generator->run($dir, $namespace);
