<?php

$loader = new \Phalcon\Loader();

$adminPath = $config->application->controllersDir.'admin/';
$loader->registerNamespaces(
    [
       'Admin' => $adminPath,
    ]
);

$loader->registerDirs(
[
$config->application->controllersDir,
$adminPath,
$config->application->modelsDir,
$config->application->pluginsDir
]
)->register();
