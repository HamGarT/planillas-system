<?php

class Cargos extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header('location' . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $data['area'] = $this->model->getDatos('area');
        $this->views->getView($this, 'index', $data);
    }

    public function listar()
    {

        $data = $this->model->getCargos();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarCargo(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarCargo(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function registrar()
    {
        $cargo = $_POST['cargo'];
        $area = $_POST['area'];
        $id = $_POST['id_cargo'];
        $sueldo= $_POST['sueldo_cargo'];
       
        if ($id == "") {
            $data = $this->model->insertarCargos($cargo, $area, $sueldo);
            
            if ($data == 'ok') {
                $msg = array('msg' => 'Cargo insertado con exito', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al insertar cargo', 'icono' => 'error');
            }
        } else {
           
            $data = $this->model->modificarDatos($id, $cargo, $sueldo, $area);
            if ($data == 1) {
                $msg = array('msg' => 'Cargo modificado con exito', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al modificar cargo', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->getCargo($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarCargo($id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Cargo eliminado con exito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar cargo', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
