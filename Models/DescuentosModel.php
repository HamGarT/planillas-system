<?php 

 class DescuentosModel extends Query{

    public function getAllDataTable(string $table){
        $sql="SELECT * FROM $table";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getDataTableById(string $table, int $id){
        $sql= "SELECT * FROM $table WHERE id = '$id'";
        $data=$this->select($sql);
        return $data;
    }
    public function getDataTableByNotLike(string $table, string $colum, string $condition){
        $sql= "SELECT * FROM $table WHERE $colum NOT LIKE '$condition'";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getDataTableByLike(string $table, string $colum, string $condition){
        $sql= "SELECT * FROM $table WHERE $colum LIKE '$condition'";
        $data=$this->selectAll($sql);
        return $data;
    }
   
    public function insertDataTpDescuento(string $Ndescuento, float $percentage){
        $sql="INSERT INTO tipodescuento(descripcion, monto) VALUES (?, ?)";
        $sendData = array($Ndescuento, $percentage);
        $getData= $this->save($sql, $sendData);
        return $getData?'ok' : 'error';
    }
    public function getAllTpDescuentos(){
        $sql="SELECT * FROM tipodescuento";
        $data= $this->selectAll($sql);
        return $data;
    }

    public function deleteDataTableById(string $table, int $id){
        $sql="DELETE FROM $table WHERE id=?";
        $sendData=[$id];
        $getData=$this->delete($sql, $sendData);
        return $getData?'ok':'error';

    }

    public function updateTpDescuento(string $Ndescuento, float $percentage, int $id){
        $sql="UPDATE tipodescuento SET descripcion = ? , monto=? WHERE id = ?";
        $sendData=array($Ndescuento, $percentage, $id);
        $getData=$this->save($sql, $sendData);
        return $getData?'ok':'error';
    }

    public function insertDescuento(int $tpDescuento, int $empleado){
        $sql="INSERT INTO descuento(id_tipoDescuento, id_empleado) VALUES (?, ?)";
        $sendData=array($tpDescuento, $empleado);
        $getData=$this->save($sql, $sendData);
        return $getData?'ok' : 'error';
    }

    public function getDataEmpleado(int $id){
        $sql = "SELECT e.DNI, e.P_nombre, e.P_apellido, c.nom_Cargo, c.id_area, c.sueldo FROM empleado e, cargo c WHERE e.id_cargo=c.id AND e.id = '$id'";
        $data= $this->select($sql);
        return $data;
    }
    public function ViewDataTableDescuento(){
        $sql="SELECT d.id, e.DNI, e.P_nombre, e.P_apellido, tpd.descripcion AS descuento FROM descuento d, tipodescuento tpd, empleado e WHERE d.id_tipoDescuento = tpd.id AND e.id = d.id_empleado";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function updateDescuento(int $id_tpDescuento, int $id_empleado, int $id){
        $sql="UPDATE descuento SET id_tipoDescuento = ? , id_empleado=? WHERE id = ?";
        $sendData=array($id_tpDescuento, $id_empleado, $id);
        $getData=$this->save($sql, $sendData);
        return $getData?'ok':'error';
    }
 }
