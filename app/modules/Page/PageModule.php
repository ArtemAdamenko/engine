<?php
include_once('/config/define.inc.php');
include_once('routes.php');

class pageModule{

    public static function pageRoute($parameters){
        $module = $parameters[2];
        $controller = $parameters[3];
        $path = ROOT.'app/modules/'.$module.'/controllers/'.$controller.'.php';
        if (file_exists($path)){
            include($path);
        }
    }
}
?>
