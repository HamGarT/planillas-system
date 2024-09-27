<?php

    class BonosModel extends Query{

        public function getAllDataTable (string $table){
            $sql = "SELECT * FROM $table";
            $data= $this->selectAll($sql);
            return $data;
        }
        public function getDataTableById( string $table, int $id){
            $sql = "SELECT * FROM $table WHERE id= '$id' ";
            $data= $this->select($sql);
            return $data;
        }

        public function getViewBonosxEmpleados(){
            $sql="SELECT b.id, e.DNI, e.P_nombre, e.P_apellido, tpb.descripcion AS Bono FROM empleado e, tipobono tpb, bono b WHERE b.id_empleado= e.id AND b.id_tipoBono=tpb.id";
            $data= $this->selectAll($sql);
            return $data;
        }
        public function getViewBonosxEmpleadosById(int $id){
            $sql="SELECT e.DNI, e.P_nombre, e.P_apellido, tpb.descripcion AS Bono FROM empleado e, tipobono tpb, bono b WHERE b.id_empleado= e.id AND b.id_tipoBono=tpb.id AND b.id='$id'";
            $data= $this->selectAll($sql);
            return $data;
        }

        public function insertDataTpBonos(string $bono, float $monto){
            $sql="INSERT INTO tipobono(descripcion, monto) VALUES (?, ?)";
            $sendData=array($bono, $monto);
            $getData=$this->save($sql, $sendData);
            return $getData? 'ok': 'error';
        }

        public function updateDataTpBonos(string $bono, float $monto, int $id){
            $sql="UPDATE tipobono SET descripcion=?, monto = ? WHERE id= ?";
            $sendData=array($bono, $monto, $id);
            $getData = $this->save($sql, $sendData);
            return $getData? 'ok':'error';
        }
        public function deleteTableRow(string $table, $id){
            $sql="DELETE FROM $table WHERE id = ?";
            $sendData=[$id];
            $getData=$this->delete($sql, $sendData);
            return $getData ? 'ok':'error';
        }

        public function insertBonos(int $empleado, int $TpBono){
            $sql="INSERT INTO bono(id_tipoBono, id_empleado) VALUES (?, ?)";
            $sendData=array($TpBono, $empleado);
            $getData=$this->save($sql, $sendData);
            return $getData? 'ok': 'error';
        }
        public function updateDataBonos(int $tpbono, int $empleado, int $id){
            $sql="UPDATE bono SET id_tipoBono=?, id_empleado = ? WHERE id= ?";
            $sendData=array($tpbono, $empleado, $id);
            $getData = $this->save($sql, $sendData);
            return $getData? 'ok':'error';
        }
    }
?>