<?php
/**
 * Класс логирования в файл
 * Пример использования:
 *
 * log::factory('qwerty');
 * log::$instance['qwerty']->setPath('C:\wamp\www');
 * log::$instance['qwerty']->getPath();
 * log::$instance['qwerty']->setChannel('qwerty');
 * log::$instance['qwerty']->write("Super-duper cool!!!");
 *
 * @author "Ruslan Riskulov <rusmcr@mail.ru>"
 */
class log
{
    /**
     * @param $path string путь к лог-файлу
     */
    public $path = '';
    /**
     * @param $dir string директория с лог-файлом
     */
    public $dir = '';
    /**
     * @param $channel string имя файла в который транслируются логи
     */
    public $channel;
    /**
     * @param $log_extension расширение для лог-файлов
     */
    private $log_extension = '.log';
    /**
     *
     * @param $instance array массив объектов
     */
    public static $instance = array();

    public function __construct()
    {

    }

    /**
     * фабрика объектов
     * инициализирует новый объект, или возвращает сущесвующий
     * возможно использование в статических методах классов
     *
     * @param string $channel канал (имя файла) для логирования в файл
     * @return object
     * @access public
     * @uses __construct
     */
    public static function factory($channel)
    {
        return (!empty(self::$instance[$channel])) ? self::$instance[$channel]
            : (self::$instance[$channel] = new self($channel));
    }

    /**
     * Устанавливает путь к лог-файлу
     * @param $path путь к лог-файлу
     * @return bool
     */
    public function setPath($path)
    {
        $this->path = $path . '/';
        return true;
    }

    /**
     * Получает путь к лог-файлу
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Устанавливает директорию с лог-файлом
     * @param $dir директория
     * @return bool
     */
    public function setDir($dir)
    {
        $this->dir = $dir . '/';
        return true;
    }

    /**
     * Получает директорию с лог-файлом
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Устанавливает имя файла
     * @param $channel имя файла
     * @return bool
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return true;
    }

    /**
     * Функция записи стока в файл
     * @param $msg
     */
    public function write($msg)
    {
        $file_path = $this->path . $this->dir . $this->channel . $this->log_extension;
        $text = date("d.m.Y (H:i:s)") . " - " . htmlspecialchars($msg) . "\r\n";
        $handle = fopen($file_path, 'a+');
        fwrite($handle, $text);
        fwrite($handle, "==============================================================\r\n\r\n");
        fclose($handle);
    }
}