<?php

require_once __DIR__ . '/core/AutoLoader.php';

$loader = new AutoLoader();
$loader->setDirs(__DIR__ . '/core');
$loader->setDirs(__DIR__ . '/controllers');
$loader->setDirs(__DIR__ . '/models');
$loader->register();
