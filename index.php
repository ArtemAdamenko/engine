<?php
include_once('/config/define.inc.php');
// подключаем конфигурацию URL
$routes= ROUTES;
// запускаем роутер
$router = new Router($routes);
$router->run();
?>