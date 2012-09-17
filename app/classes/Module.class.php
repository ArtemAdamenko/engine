<?php
/*Класс Модуля
@author Artem Adamenko <artem.adamenko@gmail.com>
*/
class Module{
    /**Метод получает URI. Несколько вариантов представлены для надёжности.
     * @return string url
     */
    protected  static function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

        if(!empty($_SERVER['PATH_INFO'])) {
            return trim($_SERVER['PATH_INFO'], '/');
        }

        if(!empty($_SERVER['QUERY_STRING'])) {
            return trim($_SERVER['QUERY_STRING'], '/');
        }
    }
    /**Логирование в файл
     */
    protected static function logging($module){
        log::factory($module);
        log::$instance[$module]->setPath(ROOT);
        log::$instance[$module]->setChannel($module);
        log::$instance[$module]->write("Start ".$module."module routing");
    }
    /**Назначение шаблона
     * @param $urlParam Часть URL
     */
    protected static function setTemplate($urlParam){
        if (validation::isInteger($urlParam)){
            self::$template = 'default';
        }else{
            self::$template = $urlParam;
        }
    }
    /*
    * Перенаправление на 404 ошибку
    */
    protected function redirect(){
        header("HTTP/1.0 404 Not Found");
        return;
    }
}
?>