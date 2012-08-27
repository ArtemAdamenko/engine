<?php
/**
 * Класс валидации
 *
 * @author Sultanov Damir <damir.s94777@gmail.com>
 */
class validation
{
    /**
     * Проверка на латинский алфавит
     * @param $str string
     * @return boolean
     */
    public static function isRomanAlphabet($str)
    {
        return (!preg_match("/^([a-z])+$/i", $str)) ? FALSE : $str;
    }

    /**
     * Проверка на кириллицу
     * @param $str string
     * @return boolean
     */
    public static function isCyrillic($str)
    {
        return (!preg_match("/^[а-я]+$/i", $str)) ? FALSE : $str;
    }

    /**
     * Проверка поля на целое цисло
     * @param $str string
     * @return boolean
     */
    public static function isInteger($str)
    {
        return filter_var($str, FILTER_VALIDATE_INT) ? $str : FALSE;
    }

    /**
     * Проверка поля на цисло c плавающей точкой
     * @param $str string
     * @return boolean
     */
    public static function isFloat($str)
    {
        return filter_var($str, FILTER_VALIDATE_FLOAT) ? $str : FALSE;
    }

    /**
     * Валидация URL
     * @param $str string
     * @return boolean
     */
    public static function isUrl($str)
    {
        return filter_var($str, FILTER_VALIDATE_URL) ? $str : FALSE;
    }

    /**
     * Валидация email-адреса
     * @param $str string
     * @return boolean
     */
    public static function isEmail($str)
    {
        return filter_var($str, FILTER_VALIDATE_EMAIL) ? $str : FALSE;
    }

    /**
     * Валидация IP-адреса
     * @param $str string
     * @return boolean
     */
    public static function isIp($str)
    {
        return filter_var($str, FILTER_VALIDATE_IP) ? $str : FALSE;
    }

    /**
     * Проверка даты
     * @param $str string
     * @return boolean
     */
    public static function isDate($str)
    {
        $stamp = strtotime($str);
        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date('m', $stamp);
        $day = date('d', $stamp);
        $year = date('Y', $stamp);
        return checkdate($month, $day, $year);
    }

    /**
     * Проверка логина
     * @param $str string
     * @return string возвращает отредактированный логин
     */
    public static function isLogin($str)
    {
        return (validation::filter(validation::isRomanAlphabet(validation::range($str, 3, 30)))) ? $str : FALSE;
    }

    /**
     * Проверка на вхождение в символьный диапозон строки
     * @param $str string
     * @param $min integer
     * @param $max integer
     * @throws Exception
     * @return string $str string
     */
    public static function range($str, $min, $max)
    {
        if (strlen($str) < $min or strlen($str) > $max) {
            throw new Exception('String should contain more than ' . $min . ' and not more than ' . $max . ' characters!');
        }
        return $str;
    }

    /**
     * Фильтрация
     * @param $str
     * @return string возвращает отфильтрованную строку
     */
    public static function filter($str)
    {
        return stripslashes(trim(htmlspecialchars($str, ENT_QUOTES)));
    }
}
