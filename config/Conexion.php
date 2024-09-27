<?php

  class Conexion{
    private $conect;
    public function __construct(){
      $data="mysql:host=".host.";port=3307;dbname=".db;
      try {
        $this->conect = new PDO($data, user, pass); // se realiza la coneccion
        $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ATTR_ERRMODE->reporte de errores ERRMODE_EXCEPTION->lanza excepciones
      } catch (PDOException $e) {
        print ("¡Error!: ". $e->getMessage());
        
      }
    }

    public function conect(){
      return $this->conect;
    }
  }



?>