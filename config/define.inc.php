<?php
if (!defined('ROOT'))
    define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/engine');
if (!defined('ROUTES'))
    define('ROUTES', ROOT.'/config/routes.php');
require_once(ROOT.'/classes/Route.class.php');
require_once(ROOT.'/modules/Page/model/PageModel.class.php');
require_once(ROOT.'/classes/Controller.class.php');
require_once(ROOT.'/classes/View.class.php');
require_once(ROOT.'/classes/DB.class.php');
?>