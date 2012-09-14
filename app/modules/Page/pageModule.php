<?php
include_once('/config/define.inc.php');
/*Класс модуля страниц
@author Artem Adamenko <artem.adamenko@gmail.com>
*/
class pageModule extends Controller{
    /*@param $routes Хранит конфигурацию маршрутов.*/
    private static $routes;
    /*@param $template шаблон по умолчанию.*/
    private static $template;
    /*@param MODULE Константа имени модуля.*/
    const MODULE = 'page';

    /*
     * Маршрутизация по контроллерам
     */
    public static function pageRoute(){
        parent::logging(self::MODULE);
        self::$routes = include('routes.php');
        $uri = parent::getURI();

        foreach(self::$routes as $pattern => $route){
            if(preg_match("~$pattern~", $uri)){
                $internalRoute = preg_replace("~$pattern~", $route, $uri);
                $parameters = explode('/', $internalRoute);
                if (in_array('engine', $parameters)){                             //потому что localhost
                    $site = array_shift($parameters);                             //(localhost/engine, должно быть engine,лишний элемент)
                }
                $controller = array_shift($parameters);
                parent::setTemplate(array_shift($parameters));

                $path = ROOT.'app/modules/'.self::MODULE.'/controllers/'.$controller.'.php';
                if (file_exists($path)){
                    include($path);
                }else{
                    parent::redirect();
                }
            }
        }
    }
}
?>
