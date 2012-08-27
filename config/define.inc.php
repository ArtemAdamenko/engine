<?php
if (!defined('ROOT'))
    define('ROOT', $_SERVER['DOCUMENT_ROOT'].'engine/');
if (!defined('ROUTES'))
    define('ROUTES', ROOT.'/config/routes.php');
require_once(ROOT.'app/classes/Route.class.php');
require_once(ROOT.'app/classes/View.class.php');
require_once(ROOT.'app/classes/DB.class.php');

require_once(ROOT.'app/modules/page/model/pageModel.class.php');

?>