<?php
require_once('controllers/PageController.class.php');
require_once('model/PageModel.class.php');
require_once('routes.php');
// подключаем необходимые файлы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/classes/Route.class.php');

// подключаем конфигурацию URL
$routes=ROOT.'routes.php';

// запускаем роутер
$router = new Router($routes);
$router->run();

?>
