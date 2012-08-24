<?php
include_once('./model/PageModel.class.php');
/**
 * класс Контроллер страниц
 * @author Artem Adamenko <artem.adamenko@gmail.com>
 */
class PageController extends Controller {
    /**
     * действие контроллера по умолчанию
     * @param
     * @return
     */
    public function actionIndex()
    {
        $this->view->render('page/view/index.php', array());
    }
    // параметр отдаётся из правила 'page/([-_a-z0-9]+)' => 'page/show/$1',
    /**
     * вывод данных в представление
     * @param $url
     * @return
     */
    function actionShow($url = null){
        // получаем страницу
        $pageModel = new PageModel();
        $page = $pageModel->getPage($url);
        // выводим её при помощи View
        $this->view->render('page/view/index.php', array('title' => $page['title'], 'content'=>$page['content']));
    }
}
?>