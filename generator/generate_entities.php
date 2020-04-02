<?php

use Liquetsoft\Fias\Component\EntityRegistry\ArrayEntityRegistry;
use Liquetsoft\Fias\Component\EntityRegistry\YamlEntityRegistry;
use Liquetsoft\Fias\Elastic\Generator\MapperGenerator;
use Liquetsoft\Fias\Elastic\Generator\MapperTestGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelGenerator;
use Liquetsoft\Fias\Elastic\Generator\ModelTestGenerator;

$root = dirname(__DIR__);
$entitiesYaml = $root . '/vendor/liquetsoft/fias-component/resources/fias_entities.yaml';

require_once $root . '/vendor/autoload.php';

$yamlRegistry = new YamlEntityRegistry($entitiesYaml);
$registry = new ArrayEntityRegistry($yamlRegistry->getDescriptors());

$dir = $root . '/src/Entity';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Entity';
$generator = new ModelGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/Entity';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\Entity';
$generator = new ModelTestGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/src/IndexMapper';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\IndexMapper';
$generator = new MapperGenerator($registry);
$generator->run($dirObject, $namespace);

$dir = $root . '/tests/IndexMapper';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$dirObject = new SplFileInfo($dir);
$namespace = 'Liquetsoft\\Fias\\Elastic\\Tests\\IndexMapper';
$generator = new MapperTestGenerator($registry);
$generator->run($dirObject, $namespace);
