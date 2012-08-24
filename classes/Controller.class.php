<?php
include_once('View.class.php');
class Controller {
    protected $view;

    function __construct(){
        // используем наш View, описанный ранее
        $this->view = new View();
    }
    public function __clone(){

    }
    // другие полезные методы вроде redirect($url);
}
?>