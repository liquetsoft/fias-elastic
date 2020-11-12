<?php

use Liquetsoft\Fias\Component\EntityRegistry\PhpArrayFileRegistry;
use Liquetsoft\Fias\Component\Helper\FileSystemHelper;
use Liquetsoft\Fias\Elastic\Generator\MapperGenerator;
use Liquetsoft\Fias\Elastic\Generator\MapperTestGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelTestGenerator;
use Liquetsoft\Fias\Elastic\Generator\NormalizerGenerator;
use Liquetsoft\Fias\Elastic\Generator\SerializerGenerator;

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$registry = new PhpArrayFileRegistry();

$dir = $root . '/src/Entity';
if (is_dir($dir)) {
    FileSystemHelper::remove(new SplFileInfo($dir));
}
mkdir($dir, 0777, true);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Entity';
$generator = new ModelGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/Entity';
if (is_dir($dir)) {
    FileSystemHelper::remove(new SplFileInfo($dir));
}
mkdir($dir, 0777, true);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\Entity';
$generator = new ModelTestGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/src/IndexMapper';
if (is_dir($dir)) {
    FileSystemHelper::remove(new SplFileInfo($dir));
}
mkdir($dir, 0777, true);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\IndexMapper';
$generator = new MapperGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/IndexMapper';
if (is_dir($dir)) {
    FileSystemHelper::remove(new SplFileInfo($dir));
}
mkdir($dir, 0777, true);
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\IndexMapper';
$generator = new MapperTestGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = new SplFileInfo($root . '/src/Serializer');
if (is_dir($dir)) {
    FileSystemHelper::remove(new SplFileInfo($dir));
}
mkdir($dir, 0777, true);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Serializer';
$generator = new SerializerGenerator($registry);
$generator->run($dir, $namespace);
$generator = new NormalizerGenerator($registry);
$generator->run($dir, $namespace);
