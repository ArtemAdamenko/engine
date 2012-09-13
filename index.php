<?php
include_once('/config/define.inc.php');
log::factory('run');
$routes= ROUTES;
$router = new Router($routes);
$router->run();
?>