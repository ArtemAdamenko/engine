<?php
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
    function getURI(){
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
                //потому что localhost(localhost/engine, должно быть engine, лишний элемент)
                if (in_array('engine', $segments)){
                    $site = array_shift($segments);
                }
                $module = $segments[0];
                $parameters = $segments;
                $moduleFile = ROOT.'app\modules\\'.$module.'\\'.$module.'Module.php';
                if(file_exists($moduleFile)){
                    include($moduleFile);
                }
                $action = $module.'Route';
                call_user_func_array(array($module.'Module', $action), $param = array($parameters));
            }
        }
        header("HTTP/1.0 404 Not Found");
        return;
    }
}
?>