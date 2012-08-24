<?php
include_once('.../classes/DB.class.php');
/**
 * класс Модель страниц
 * @author Artem Adamenko <artem.adamenko@gmail.com>
 */
class PageModel{
    public function __construct(){

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
        $page = DB::select("title, content", $condition);
        $result = DB::getResult();
        return $result;
    }
}
?>