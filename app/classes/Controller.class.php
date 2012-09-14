<?php
class Controller{

    public static function logging($module){
        log::factory($module);
        log::$instance[$module]->setPath(ROOT);
        log::$instance[$module]->setChannel($module);
        log::$instance[$module]->write("Start ".$module."module routing");
    }

    public static function setTemplate($urlParam){
        if (validation::isInteger($urlParam)){
            self::$template = 'default';
        }else{
            self::$template = $urlParam;
        }
    }

    public function redirect(){
        header("HTTP/1.0 404 Not Found");
        return;
    }
}
?>