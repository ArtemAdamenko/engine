<?php
/**
 * Класс для загрузки файлов
 *
 * Использование:
 *  $my = new Upload();  - Создание экземпляра объекта
 *  $my->uploads("upload","userfile"); - Функция загружающая файл\файлы
 *          1 параметр $upload_dir string - директория для загрузки
 *          2 параметр $input_name string - input name формы
 *
 * @author "Anton Cherepanov <davetoxa@gmail.com>"
 */
class Upload
{
    /**
     * @param $upload_dir string переменная содержащая директорию для загрузки
     */
    private $upload_dir;
    /**
     * Содержит name input из html формы
     * Устанавливаеться методом setInputName()
     * @param $input_name string
     */
    private $input_name;
    /**
     * @param $allowed_type array доступные файлы для загрузки
     */
    private $allowed_type = array("jpg", "gif", "jpeg", "png", "mp3", "exe",
        "doc", "docx", "xls", "pdf", "txt", "rar", "zip");

    /**
     * Устанавливает имя для файла из html формы input name=" "
     * @param $name string имя инпута
     * @return возвращает установленное имя
     */
    public function setInputName($name)
    {
        return $this->input_name = $name;
    }

    /**
     * Проверяет существование папки
     * @param $directory string папка которую нужно проверить
     * @return boolean true or false
     */
    public function isDir($directory)
    {
        return (is_dir($directory)) ? true : false;
    }

    /**
     * Функция для создания директории
     * @param $nameOfDirectory string название директории
     * @param boolean $mode integer права на папку (  игнорируется в Windows )
     * @throws Exception if diretory can't be create
     * @return boolean
     */
    public function mkDir($nameOfDirectory, $mode = FALSE)
    {
        if (!mkdir($nameOfDirectory, $mode))
            throw new Exception('Can not create a directory');
        return true;
    }

    /**
     * Устанавливает папку для записи файлов
     * @throws exception with message - It is not a directory
     * @param $upload_dir string папка для записи
     * @return string
     */
    public function setUploadDir($upload_dir)
    {
        $this->upload_dir = $upload_dir;

        if (!$this->isDir($this->upload_dir))
            throw new Exception('It is not a directory, please try to create this directory firstly');

        return $this->upload_dir;
    }

    /**
     * Получает директорию для записи файла
     * @return директория для записи
     */
    public function getUploadDir()
    {
        return $this->upload_dir;
    }

    /**
     * Устанавливает доступный формат файла для записи
     * @param $type string формат файла
     */
    public function setAllowedType($type)
    {
        $this->allowed_type[] = $type;
    }

    /**
     * Выводит все доступные форматы для загрузки через цикл foreach
     * @return array доступные типы
     */
    public function getAllowedTypes()
    {
        return $this->allowed_type;
    }

    /**
     * Подсчитывает количество загружаемых файлов
     * Используеться в методе uploads, цикле for
     * @return integer количество файлов
     */
    public function countFiles()
    {
        return count($_FILES[$this->input_name]["name"]);
    }

    /**
     * Проверяет тип файла на доступность к записи
     * @param $file файл который необходимо проверить
     * @return boolean true or false
     */
    public function checkType($file)
    {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $this->allowed_type) ? true : false;
    }

    /**
     * Используется md5 шифрование имени файла
     * @var string $file_name имя файла
     * @return string имя файла, кодированное в md5
     */
    private function encodeFileName($file_name)
    {
        return md5($file_name) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
    }

    /**
     * Возвращает содержание ошибки в зависимости от константы
     * @param $error_code код ошибки
     * @return string сообщение ошибки
     */
    protected function errorMessage($error_code)
    {
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'File upload stopped by extension';
            default:
                return 'Unknown upload error';
        }
    }

    /**
     * Непосредственно сама функция для загрузки
     * @param $upload_dir переменная содержащая директорию для загрузки
     * @param $input_name содержит name input из html формы
     * @return bool|void $_FILES
     */
    public function uploads($upload_dir, $input_name)
    {
        $this->upload_dir = $this->setUploadDir($upload_dir);
        $this->input_name = $this->setInputName($input_name);

        for ($fileNum = 0; $fileNum < $this->countFiles(); $fileNum++) {
            if ($this->checkType($_FILES[$this->input_name]["name"][$fileNum])) {
                if ($_FILES[$this->input_name]["error"][$fileNum] == UPLOAD_ERR_OK) {
                    move_uploaded_file($_FILES[$this->input_name]["tmp_name"][$fileNum],
                        $this->upload_dir . "/" . $this->encodeFileName($_FILES[$this->input_name]["name"][$fileNum]))
                        ? true : false;
                } else {
                    print_r($this->errorMessage($_FILES[$this->input_name]["error"][$fileNum]));
                }
            }
        }
        return $_FILES;
    }

    /**
     * Возвращает информацию о файле
     * @return array массив $_FILES;
     */
    public function getFileInfo()
    {
        return $this->$_FILES;
    }

    /**
     * Переводит текст в транслит
     * @param $text
     * @return mixed $text валидное название на транслите
     */
    public static function translit($text)
    {
        $rus = array("а", "б", "в",
            "г", "ґ", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м",
            "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш",
            "щ", "ы", "э", "ю", "я", "ь", "ъ", "і", "ї", "є", "А", "Б",
            "В", "Г", "ґ", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л",
            "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч",
            "Ш", "Щ", "Ы", "Э", "Ю", "Я", "Ь", "Ъ", "І", "Ї", "Є", " ");
        $lat = array("a", "b", "v",
            "g", "g", "d", "e", "e", "zh", "z", "i",
            "j", "k", "l", "m", "n", "o", "p", "r",
            "s", "t", "u", "f", "h", "c", "ch", "sh",
            "sh'", "y", "e", "yu", "ya", "_", "_", "i",
            "i", "e", "A", "B", "V", "G", "G", "D",
            "E", "E", "ZH", "Z", "I", "J", "K", "L",
            "M", "N", "O", "P", "R", "S", "T", "U",
            "F", "H", "C", "CH", "SH", "SH'", "Y", "E",
            "YU", "YA", "_", "_", "I", "I", "E", "_");
        $text = str_replace($rus, $lat, $text);
        return (preg_replace("#[^a-z0-9._-]#i", "", $text));
    }
}