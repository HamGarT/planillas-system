<?php

class Bonos extends Controller
{

    public function index()
    {
        $data['empleados'] = $this->model->getAllDataTable('empleado');
        $data['TpBono'] = $this->model->getAllDataTable('tipobono');
        $this->views->getView($this, 'index', $data);
    }

    public function tpBonos()
    {
        $this->views->getView($this, 'tpBonos');
    }

    public function listarBonos()
    {
        $data = $this->model->getViewBonosxEmpleados();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarBono(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarBono(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function  listarTpBonos()
    {
        $data = $this->model->getAllDataTable('tipobono');
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarTpBono(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarTpBono(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registerTpBonos()
    {
        $Nbono = $_POST['Nbono'];
        $bono_sueldo = $_POST['montoBono'];
        $id = $_POST['id_tpBono'];

        if (empty($Nbono) || empty($bono_sueldo)) {

            $msg = array('msg' => 'Todos los campos deben estar llenos', 'icon' => 'warning');
        } else {
            if ($id == "") {

                $data = $this->model->insertDataTpBonos($Nbono, $bono_sueldo);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Bono registrado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar Bono', 'icon' => 'error');
                }
            } else {
                $data = $this->model->updateDataTpBonos($Nbono, $bono_sueldo, $id);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Bono modificado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar bono', 'icon' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getAllDataforEdirTpBono(int $id)
    {
        $data = $this->model->getDataTableById('tipobono', $id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function sendDataForDeleteTpBono(int $id)
    {
        $data = $this->model->deleteTableRow('tipobono', $id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Se elimino el bono correctamente', 'icon' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar bono', 'icon' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registerBono()
    {
        $Empleado = $_POST['Bono_empleado'];
        $bono = $_POST['id_Bono'];
        $id = $_POST['id'];

        if (empty($Empleado) || empty($bono)) {
            $msg = array('msg' => 'Todos los campos deben estar llenos', 'icon' => 'warning');
        } else {
            if ($id == "") {

                $data = $this->model->insertBonos($Empleado, $bono);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Bono registrado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar Bono', 'icon' => 'error');
                }
            } else {
                $data = $this->model->updateDataBonos($bono, $Empleado, $id);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Bono modificado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar bono', 'icon' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getDataforEditBono(int $id){
        $data= $this->model->getDataTableById('bono',$id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function sendDataforDeleteBono(int $id){
        $data = $this->model->deleteTableRow('bono', $id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Se elimino el bono correctamente', 'icon' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar bono', 'icon' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
