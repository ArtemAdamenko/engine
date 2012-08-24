<?php
include_once('.../classes/DB.class.php');
class PageModel{
    // параметр отдаётся из правила 'page/([-_a-z0-9]+)' => 'page/show/$1',
    // получаем страницу
    public static function getPage($url){
        $condition['id'] = $url;
        $page = DB::select("title, content", $condition);
        $result = DB::getResult();
        return $result;
    }
}
?>