<?php

session_start();

define('ROOT', realpath(__DIR__ ));

require_once(ROOT . '/src/Core/Kernel.php');
spl_autoload_register('\App\Core\Kernel::classLoader');

$container = new \App\Core\Container();
require ROOT . '/config/services.php';

$kernel = new \App\Core\Kernel($container);
$kernel->run();