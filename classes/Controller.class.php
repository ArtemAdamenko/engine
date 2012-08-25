<?php
class Controller {

    public function __construct(){

    }
    public function __clone(){

    }

    public function redirect($url){
        header("Redirect : ".$url);
    }
}
?>