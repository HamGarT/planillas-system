<?php 
 class CargosModel extends  Query{
    public function __construct(){
        parent::__construct();
    }
    public function getDatos(string $tables){
        $sql="SELECT * FROM $tables";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getCargo(int $id){
        $sql="SELECT * FROM cargo WHERE id='$id'";
        $data=$this->select($sql);
        return $data;
    }
    public function getCargos(){
        $sql="SELECT c.id, c.nom_Cargo, a.nom_area, c.sueldo FROM cargo c, area a WHERE c.id_area=a.id;";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function insertarCargos(string $cargo, int $area, float $sueldo)
    {   
        $verify="SELECT * FROM cargo WHERE nom_Cargo='$cargo' AND id_area='$area'";
        $existe=$this->select($verify);
        if (empty($existe)) {
            $sql="INSERT INTO cargo(nom_Cargo, id_area, sueldo) VALUES (?, ?, ?)";
            $datos=array($cargo, $area, $sueldo);
            $data=$this->save($sql, $datos);
            if($data == 1){
                $res='ok';
            }
        } else {
            $res='existe';
        }
        return $res;
    }
    public function modificarDatos(int $id, string $cargo, float $sueldo, int $area){
        $sql="UPDATE cargo SET nom_Cargo= ?, id_area= ?, sueldo= ? WHERE id= ?" ;
        $datos=array($cargo, $area, $sueldo, $id);
        $data=$this->save($sql, $datos);
        return $data;
    }
    public function eliminarCargo(int $id){
        $sql='DELETE FROM cargo WHERE id=?';
        $datos=[$id];
        $data=$this->delete($sql, $datos);
        return $data?'ok':'error';    
    }
    
 }
