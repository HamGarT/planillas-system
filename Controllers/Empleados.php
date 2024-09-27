<?php
class Empleados extends Controller
{

    public function index()
    {
        $data = $this->model->getDatos('cargo');
        $this->views->getView($this, "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getEmpleados();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarEmpleado(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarEmpleado(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data);
    }

    public function registrar()
    {
        $id = $_POST['id'];
        $dni = $_POST['dni'];
        $p_nombre = $_POST['p_nombre'];
        $s_nombre = $_POST['s_nombre'];
        $p_apellido = $_POST['p_apellido'];
        $s_apellido = $_POST['s_apellido'];
        $edad = $_POST['edad'];
        $fechaNac = $_POST['fech_nacimiento'];
        $direccion = $_POST['direccion'];
        $cargo = $_POST['cargo'];
        if (
            empty($dni) || empty($p_nombre) || empty($s_nombre) || empty($p_apellido) || empty($s_apellido) || empty($edad) || empty($fechaNac)
            || empty($direccion) || empty($cargo)
        ) {
            $msg = array('msg' => 'Todos los campos son necesarios', 'icon' => 'error');
        } else {
            $fech_process = date('Y-m-d', strtotime($fechaNac));
            if ($id == "") {
                
                $data = $this->model->registrarEmpleado($dni, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $edad, $fech_process, $direccion, $cargo);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Empleado registrado con exito', 'icon' => 'success');
                } elseif ($data == 'existe'){
                    $msg = array('msg' => 'El empleado ya existe en el registro', 'icon' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar empleado', 'icon' => 'error');
                }
            } else {
                $data=$this->model->editEmpleado($dni, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $edad, $fech_process, $direccion, $cargo, $id);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Empleado modificado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al al modificar empleado', 'icon' => 'error');
                }
                
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function editar(int $id){
        $data=$this->model->getEmpleadoById($id);
        echo json_encode($data);
    }

    public function delete(int $id){
        $data=$this->model->deleteEmpleado($id);
        if ($data == 'ok') {
            $msg=array('msg'=>'Empleado eliminado del registro con exito', 'icon'=>'success');
        } else {
            $msg=array('msg'=>'Error al eliminar empleado del registro', 'icon'=>'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        
    }
}
