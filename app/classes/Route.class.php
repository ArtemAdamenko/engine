<?php
/*Класс маршрутизации
@author Artem Adamenko <artem.adamenko@gmail.com>
*/
class Router extends Module{
    /*@param $routes Хранит конфигурацию маршрутов.*/
    private $routes;
    /*@param $uri URL.*/
    private static $uri;

    /**Получаем конфигурацию из файла.
     * @param $routesPath путь до маршрутов
     */
    public function __construct($routesPath){
        $this->routes = include($routesPath);
        parent::logging('Router');
        self::$uri = parent::getURI();
    }

    /**
     * Распределение по модулям
     */
    public function run(){
        foreach($this->routes as $pattern => $route){
            if(preg_match("~$pattern~", self::$uri)){
                $internalRoute = preg_replace("~$pattern~", $route, self::$uri);
                $segments = explode('/', $internalRoute);
                if (in_array('engine', $segments)){                             //потому что localhost
                    $site = array_shift($segments);                             //(localhost/engine, должно быть engine,лишний элемент)
                }
                $module = array_shift($segments);
                $moduleFile = ROOT.'app\modules\\'.$module.'\\'.$module.'Module.php';
                if(file_exists($moduleFile)){
                    try{
                        include($moduleFile);
                        $action = $module.'Route';
                        call_user_func(array($module.'Module', $action));
                    }catch(Exception $e){
                        log::$instance['Router'] = 'Module not starting in '.$moduleFile.'\n'.$e.'\n';
                        echo 'throw new exception '.$e.'\n';
                    }
                }else{
                    parent::redirect();
                }
            }//if end
        }//foreach end
        parent::redirect();
    }
}
?>