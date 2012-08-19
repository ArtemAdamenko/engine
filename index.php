<?php
// подключаем необходимые файлы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/../lib/Router.php');

// подключаем конфигурацию URL
$routes=ROOT.'/../app/config/routes.php';

// запускаем роутер
$router = new Router($routes);
$router->run();
?>