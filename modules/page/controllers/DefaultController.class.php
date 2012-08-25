<?php
include_once(ROOT.'/config/define.inc.php');
/**
 * класс Контроллер страниц
 * @author Artem Adamenko <artem.adamenko@gmail.com>
 */
class DefaultController extends Controller {
    /**
     * действие контроллера по умолчанию
     * @param
     * @return
     */
    public static function actionIndex()
    {
        View::render('Page','index', array());
    }

    /**
     * вывод данных в представление
     * @param $url
     * @return
     */
    public static function actionShow($url = null){
        //$pageModel = new PageModel();
        //$page = $pageModel->getPage($url);
        $page['title'] = "Title";
        $page['content'] = "Content";
        View::render('Page','index', array('title' => $page['title'], 'content'=>$page['content']));
    }
}
?>