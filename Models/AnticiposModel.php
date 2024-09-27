<?php 

class AnticiposModel extends Query{

    public function getDataTable(string $table){
        $sql="SELECT * FROM $table";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getAllAnticipos(){
        $sql="SELECT * FROM anticipo";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function viewAnticiposXempleados(){
        $sql="SELECT an.id, e.DNI, CONCAT_WS(' ',e.P_nombre, e.P_apellido) AS NombresC, an.monto, an.estado, an.fecha FROM anticipo an, empleado e WHERE e.id = an.id_empleado";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerDataAnticipo($monto, string $fecha, string $estado , int $empleado){
        $sql="INSERT INTO anticipo(monto, fecha, estado, id_empleado) VALUES  (?, ?, ?, ?)";
        $sendData=array($monto, $fecha, $estado, $empleado);
        $getdata=$this->save($sql, $sendData);
        return $getdata?"ok":'error';
    }

    public function getAnticipoById(int $id){
        $sql="SELECT * FROM anticipo WHERE id = $id";
        $data=$this->select($sql);
        return $data;
    }
    public function deleteAnticipo(int $id){
        $sql="DELETE FROM anticipo WHERE id=?";
        $sendData=[$id];
        $getData=$this->delete($sql, $sendData);
        return $getData?'ok':'error';
    }
    public function editAnticipo($monto, string $fecha, string $estado , int $empleado, int $id)
    {
        $sql="UPDATE anticipo SET monto= ?, fecha= ?, estado=?, id_empleado= ? WHERE id= ?";
        $sendData= array($monto, $fecha, $estado, $empleado, $id);
        $getData=$this->save($sql, $sendData);
        return $getData?'ok':'error';
    }
    

}

?>