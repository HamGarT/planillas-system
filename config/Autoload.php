<?php
spl_autoload_register(function($class){  //parea cargar automaticamente el controlador
    if (file_exists("config/".$class.".php")) {
        require_once "config/".$class.".php";
    }
});
?>