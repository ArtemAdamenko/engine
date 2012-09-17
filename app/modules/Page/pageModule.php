<?php
include_once('/config/define.inc.php');
/*Класс модуля страниц
@author Artem Adamenko <artem.adamenko@gmail.com>
*/
class pageModule extends Module{
    /*@param $routes Хранит конфигурацию маршрутов.*/
    private static $routes;
    /*@param $template шаблон по умолчанию.*/
    private static $template;
    /*@param MODULE Константа имени модуля.*/
    const MODULE = 'page';
    /*@param $uri URL.*/
    private static $uri ;

    /*
     * Маршрутизация по контроллерам
     */
    public static function pageRoute(){
        self::init();
        foreach(self::$routes as $pattern => $route){
            if(preg_match("~$pattern~", self::$uri)){                                     //парсинг урл
                $internalRoute = preg_replace("~$pattern~", $route, self::$uri);
                $parameters = explode('/', $internalRoute);
                if (in_array('engine', $parameters)){                             //потому что localhost
                    $site = array_shift($parameters);                             //(localhost/engine, должно быть engine,лишний элемент)
                }
                $controller = array_shift($parameters);
                parent::setTemplate(array_shift($parameters));

                $path = ROOT.'app/modules/'.self::MODULE.'/controllers/'.$controller.'.php';
                if (file_exists($path)){                                                                     //исключение на файл
                    try{
                        include($path);
                    }catch(Exception $e){
                        log::$instance[self::MODULE] = 'Controller not found in '.self::MODULE.'\n'.$e.'\n';
                        echo 'throw new exception '.$e.'\n';
                    }
                }else{
                    parent::redirect();
                }
            }//if end
        }//foreach end
    }
    private static function init(){
        parent::logging(self::MODULE);
        self::$routes = include('routes.php');
        self::$uri = parent::getURI();
    }
}
?>
