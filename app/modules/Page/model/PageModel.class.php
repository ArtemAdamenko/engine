<?php
include_once('/config/define.inc.php');
/**
 * класс Модель страниц
 * @author Artem Adamenko <artem.adamenko@gmail.com>
 */
class pageModel{
    public function __construct(){
        DB::connect('localhost', 'root', '', 'my');
    }
    public function __clone(){

    }
    /**
     * Получение данных для представления
     * @param $url int
     * @return $result array
     */
    public function getPage($url){
        $condition['id'] = $url;
        DB::select("title, content", $condition);
        $result = DB::getResult();
        return $result;
    }
}
?>