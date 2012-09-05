<?php
/*Класс маршрутизации
@author Artem Adamenko <artem.adamenko@gmail.com>
*/
class Router {
    /*@param $routes Хранит конфигурацию маршрутов.*/
    private $routes;

    /**Получаем конфигурацию из файла.
     * @param $routesPath путь до маршрутов
     */
    function __construct($routesPath){
        $this->routes = include($routesPath);
    }

    /**Метод получает URI. Несколько вариантов представлены для надёжности.
     * @return string url
     */
    static function getURI(){
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

    /**
     * Распределение по модулям
     */
    function run(){
        $uri = $this->getURI();
        foreach($this->routes as $pattern => $route){
            if(preg_match("~$pattern~", $uri)){
                $internalRoute = preg_replace("~$pattern~", $route, $uri);
                $segments = explode('/', $internalRoute);
                if (in_array('engine', $segments)){                             //потому что localhost
                    $site = array_shift($segments);                             //(localhost/engine, должно быть engine,
                    unset($site);                                               //лишний элемент)
                }
                $module = array_shift($segments);
                $moduleFile = ROOT.'app\modules\\'.$module.'\\'.$module.'Module.php';
                if(file_exists($moduleFile)){
                    include($moduleFile);
                    $action = $module.'Route';
                    call_user_func(array($module.'Module', $action));
                }else{
                    $this->redirect();
                }
            }
        }
        $this->redirect();
    }
    /*
     * Перенаправление на 404 ошибку
     */
    static function redirect(){
        header("HTTP/1.0 404 Not Found");
        return;
    }
}
?>