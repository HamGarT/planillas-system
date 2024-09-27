<?php
//true==1 o no vacio ---false==0 vacio

require_once 'config/Global.php'; //para poder usar las variables globales
$ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
$array = explode("/", $ruta); // explode() divide un string en varios string con un separador en este caso "/"  
$controller = $array[0];      //el indice [0] sera el contralador(capetas que hay dentro de la carpeta controler)y los indices siquientes indices seran los elementos(son los .php que hay dentro de esa carpetas) que hay en la carpeta controlador
$metodo = 'index';
$parametro = "";

if (!empty($array[1])) {
    if (!empty($array[1] != "")) {
        $metodo = $array[1];
    }
}
if (!empty($array[2])) {
    if (!empty($array[2] != "")) {
        for ($i = 2; $i < count($array); $i++) {
            $parametro .= $array[$i] . ",";
        }
        $parametro = trim($parametro, ",");
    }
}

require_once "config/Autoload.php"; //carag automaticamente el controlador
$dirControllers = "Controllers/$controller.php";  //se almacean la ruta de nuestra carpeta

if (file_exists($dirControllers)) { 
    require_once $dirControllers;
    $controller= new $controller();
    if(method_exists($controller, $metodo)){
        $controller->$metodo($parametro);
    } else {
        //header('Location: '.base_url.'Errors');
        echo "no existe el metodo";
    }
} else {
    echo "no existe el controlador";
}
?>