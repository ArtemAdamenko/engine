<?php
include_once('/config/define.inc.php');
$routes= ROUTES;
$router = new Router($routes);
$router->run();
?>