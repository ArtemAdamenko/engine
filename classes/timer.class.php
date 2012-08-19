<?php
/**
 * Класс таймер
 *
 * Применение
 *
 *  $object = new timer();
 *  $object->start(); - стартуем таймер
 * .......
 *  $object->stop(); - останавливаем
 *  echo $object->elapsed(); - выводим прошедшее время
 *
 * @author
 */
class timer
{
    /**
     * @param $start_timer integer время старта таймера
     */
    private $start_timer = 0;

    /**
     * @param $end_timer integer время остановки таймера
     */
    private $end_timer = 0;

    /**
     * @param $elapsed integer время действия таймера
     */
    private $elapsed = 0;

    /**
     * Функция стартует таймер
     */
    public function start()
    {
        $this->start_timer = $this->_time();
    }

    /**
     * Функция останавливает таймер
     */
    public function stop()
    {
        $this->end_timer = $this->_time();
    }

    /**
     * Очищает все используемые значения
     */
    public function clear()
    {
        $this->start_timer = 0;
        $this->end_timer = 0;
        $this->elapsed = 0;
    }

    /**
     * @return $elapsed - возвращает время
     */
    public function elapsed()
    {
        if (!$this->stop()) {
            $this->elapsed = round($this->_time() - $this->start_timer, 3);
            return substr($this->elapsed, 0, 1) . " : " . substr($this->elapsed, 2, 4);
        }
        $this->elapsed = round($this->end_timer - $this->start_timer, 3);
        return substr($this->elapsed, 0, 1) . " : " . substr($this->elapsed, 2, 4);
    }

    /**
     * @return $mtime - текущее время
     */
    public function _time()
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        return $mtime;
    }
}
/*
$object = new timer();
$object->start();
sleep(1);
echo $object->elapsed();
*/
