<?php

class EmpleadosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDatos(string $table)
    {
        $sql = "SELECT * FROM $table";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getEmpleados()
    {
        $sql = "SELECT e.id, e.DNI, e.P_nombre, e.S_nombre, e.P_apellido, e.S_apellido, e.edad, e.fecha_nacimiento, e.direccion,  
        c.nom_Cargo as cargo, a.nom_area as area FROM empleado e INNER JOIN cargo c ON e.id_cargo = c.id INNER JOIN area a ON c.id_area = a.id;";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarEmpleado(string $dni, string $p_nombre, string $s_nombre, string $p_apellido, string $s_apellido, int $edad, string $fech_process, string $direccion, int $cargo)
    {
        $verify = "SELECT * FROM empleado WHERE DNI='$dni'";
        $exist = $this->select($verify);
        if (empty($exist)) {
            $sql = "INSERT INTO empleado(DNI, P_nombre, S_nombre, P_apellido, S_apellido, edad, fecha_nacimiento, direccion, id_cargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $datos = array($dni, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $edad, $fech_process, $direccion, $cargo);
            $data = $this->save($sql, $datos);
            $res = $data ? 'ok' : 'error';
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function getEmpleadoById(int $id)
    {
        $sql = "SELECT * FROM empleado WHERE id='$id'";
        $data = $this->select($sql);
        return $data;
    }
    public function editEmpleado(string $dni, string $p_nombre, string $s_nombre, string $p_apellido, string $s_apellido, int $edad, string $fech_process, string $direccion, int $cargo, int $id){
        $sql="UPDATE empleado SET DNI = ?, P_nombre = ?, S_nombre = ?, P_apellido = ?, S_apellido = ?, edad = ?,
        fecha_nacimiento = ?, direccion = ?, id_cargo = ? WHERE id=?";
        $sendData=array($dni, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $edad, $fech_process, $direccion, $cargo, $id);
        $getData=$this->save($sql, $sendData);
        return $getData ? 'ok' : 'error';
    }

    public function deleteEmpleado(int $id){
        $sql="DELETE FROM empleado WHERE id=?";
        $sendData=[$id];
        $getData=$this->delete($sql, $sendData);
        return $getData?'ok':'error';
    }
}
