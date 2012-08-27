<?php
/**
 * Класс Cookie
 *
 * Использование:
 *  Cookie::setExpire(time()+30); - Создание экземпляра объект, задание длительности cookie
 *  Cookie::set('login','John');
 *          1 параметр $key - наименование cookie
 *          2 параметр $value - значение cookie
 *
 * @author "Ruslan Riskulov <rusmcr@mail.ru>"
 */
class cookie
{
    /**
     * @param $expire string статическая переменная содержащая длительность cookie
     */
    private static $expire = 0;
    /**
     * @param $path string статическая переменная содержащая путь на сервере,
     * в котором cookie будет доступна
     */
    private static $path = '/';
    /**
     * @param $domain string статическая переменная содержащая домен, в котором
     * cookie доступна
     */
    private static $domain = null;
    /**
     * @param $secure string статическая переменная указывает, что куки должны быть
     * переданы только через защищенное соединение HTTPS с клиентом.
     */
    private static $secure = false;
    /**
     * @param $instance string статическая переменная, в которой
     * будет храниться экземпляр класса
     */
    private static $instance = null;

    private function __construct()
    {

        get_instance();

    }

    /**
     * Возвращает экземпляр класса или создает
     * новый при необходимости
     * @return
     */
    public static function get_instance()
    {
        if (is_null(Cookie::$instance)) Cookie::$instance = new Cookie;
        return Cookie::$instance;
    }

    /**
     * определяет куки для отправки вместе с остальной частью заголовков HTTP.
     * @param $key string имя куки
     * @param $value string значение куки
     */
    public static function set($key, $value)
    {
        setcookie($key, $value, self::$expire, self::$path, self::$domain,
            self::$secure);
    }

    /**
     * определяет длителность куки
     * @param $time string
     * @return bool
     */
    public static function setExpire($time)
    {
        self::$expire = $time;
        return true;
    }

    /**
     * определяет путь на сервере,
     * в котором cookie будет доступна
     * @param $path string
     * @return bool
     */
    public static function setPath($path)
    {
        self::$path = $path;
        return true;
    }

    /**
     * определяет домен, в котором
     * cookie доступна
     * @param $domain string
     * @return bool
     */
    public static function setDomain($domain)
    {
        if (!is_null($domain)) {
            self::$domain = $domain;
        }
        return true;
    }

    /**
     * указывает, что куки должны быть
     * переданы только через защищенное соединение HTTPS с клиентом.
     * @param $secure
     * @return bool
     */
    public static function setSecure($secure)
    {
        self::$secure = (bool)$secure;
        return true;
    }

    /**
     * Функция возвращающая значение длительности cookie
     * @return string
     */
    public static function getExpire()
    {
        return self::$expire;
    }

    /**
     * Функция возвращающая путь на сервере
     * @return string
     */
    public static function getPath()
    {
        return self::$path;
    }

    /**
     * Функция возвращающая значение переменной $domain
     * @return string
     */
    public static function getDomain()
    {
        return self::$domain;
    }

    /**
     * Функция возвращающая значение переменной $secure
     * @return string
     */
    public static function getSecure()
    {
        return self::$secure;
    }

    /**
     * Функция возвращающая значение куки
     * @param $key string
     * @return string
     */
    public static function get($key)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    /**
     * Функция удаления куки
     * @param $key string
     */
    public static function delete($key)
    {
        if (isset($_COOKIE[$key])) {
            setcookie($key, null, time() - 1000000);
        }
    }
}

