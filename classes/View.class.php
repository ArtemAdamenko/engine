<?php
class View {
    /**
     * @param string имя модуля
     */
    private static $module;
    /**
     * @param string название шаблона
     */
    private static $template;
    /**
     * @param array параметры шаблона
     */
    private static $params = array();

    /**получить отренедеренный шаблон с параметрами $params
     * @return mixed шаблон
     */
    private static function fetchPartial(){
        extract(self::$params);
        ob_start();
        include self::$template.'.php';
        return ob_get_clean();
    }

    /**вывести отренедеренный шаблон с параметрами $params
     */
    private static function renderPartial(){
        echo self::fetchPartial();
    }

    /**получить отренедеренный шаблон с параметрами $params в переменную $content layout-а
     * @return mixed шаблон
     */
    private static function fetch(){
        self::$template = '/modules/'.self::$module.'/view/'.self::$template;
        $content = self::fetchPartial();
        self::$template = '/modules/'.self::$module.'/view/layout';
        self::$params = array('content' => $content);
        return self::fetchPartial();
    }

    /**вывести отренедеренный шаблон с параметрами $params в переменную $content layout-а
     * @param $module string имя модуля
     * @param $template string название шаблона
     * @param $params array() параметры шаблона
     * @return mixed шаблон
     */
    public static function render($module, $template, $params = array()){
        self::$module = $module;
        self::$template = $template;
        self::$params = $params;
        echo self::fetch($params);
    }
}
?>