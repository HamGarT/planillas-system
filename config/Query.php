<?php


  class Query extends Conexion{

    private $conexionPDO, $con, $sql, $data;
    public function __construct(){
      $this->conexionPDO= new Conexion(); //se crea un objeto de la clase conexion
      $this->con = $this->conexionPDO->conect(); // se llama al metodo conect() que devuelve la conexion  a la base de datos
    }

    public function select(string $sql){
      $this->sql=$sql;
      $resul= $this->con->prepare($this->sql); //prepara un sentecia para su ejecucion devuelve un PDOStatement
      $resul->execute(); //ejecuta una sentencia preparada
      $data=$resul->fetch(PDO::FETCH_ASSOC); // devueleve una fila  un array asociativo, el nombre de sus llaves es el mismo que el de las columnas
      return $data;
    }

    public function selectAll(string $sql){
      $this->sql=$sql;
      $result= $this->con->prepare($this->sql);
      $result->execute();
      $data= $result->fetchAll(PDO::FETCH_ASSOC); //devueleve todas las filas que hay en uan tabla
      return $data;
    }

    public function save(string $sql, array $data){
      $this->sql=$sql;
      $this->data= $data;
      $insert = $this->con->prepare($this->sql);
      $data= $insert->execute($this->data);
      $res= $data?1:0;
      return $res;
    }
    
    public function insertar(string $sql, array $data){
      $this->sql=$sql;
      $this->data=$data;
      $insert=$this->con->prepare($this->sql);
      $data=$insert->execute($this->data);
      $res=$data? $this->con->lastInsertId(): 0; //lastInsertId() devuelve el id de la ultima fila insertada
      return $res;

    }
    public function delete(string $sql, array $data){
      $this->sql=$sql;
      $this->data=$data;
      $delete=$this->con->prepare($this->sql);
      $data=$delete->execute($this->data);
      $res= $data?1:0;
      return $res;
    }
  }
?> 