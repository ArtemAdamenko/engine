<?php
// подключаем необходимые файлы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/classes/Route.class.php');

// подключаем конфигурацию URL
$routes=ROOT.'/config/routes.php';

// запускаем роутер
$router = new Router($routes);
$router->run();
?>