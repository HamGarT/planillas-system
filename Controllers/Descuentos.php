<?php

class Descuentos extends Controller
{

    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header('location:' . base_url);
        }
        parent::__construct();
    }



    public function index()
    {
        $data['empleados'] = $this->model->getAllDataTable('empleado');
        $data['Tpdescuentos'] = $this->model->getDataTableByNotLike('tipodescuento', 'descripcion', 'IR%');
        $this->views->getView($this, 'index', $data);
    }

    public function tpDescuentos()
    {
        $this->views->getView($this, 'tpDescuentos');
    }

    public function listar()
    {
        //$data = $this->model->getAllDataTable('descuento');
        $data = $this->model->ViewDataTableDescuento();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarDescuento(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarDescuento(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarIR()
    {
        $data = $this->model->getDataTableByLike('tipodescuento', 'descripcion', 'IR%');
        for ($i = 0; $i < count($data); $i++) {
            $percent = $data[$i]['monto'] * 100;
            $data[$i]['monto'] = number_format($percent, 2);
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarTpDescuento(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listarTpDescuentos()
    {
        $data = $this->model->getDataTableByNotLike('tipodescuento', 'descripcion', 'IR%');
        for ($i = 0; $i < count($data); $i++) {
            $percent = $data[$i]['monto'] * 100;
            $data[$i]['monto'] = number_format($percent, 2);
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarTpDescuento(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarTpDescuento(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registerTpDescuento()
    {
        $id_tpDescuentos = $_POST['id_tpDescuentos'];
        $Ndescuento = $_POST['nom_descuento'];
        $percentage = $_POST['porcent'];


        if (empty($Ndescuento) || empty($percentage)) {
            $msg = array('msg' => 'Todos los campos son necesarios', 'icon' => 'warning');
        } else {
            $BDpercent =  $percentage / 100;
            if ($id_tpDescuentos == '') {
                $data = $this->model->insertDataTpDescuento($Ndescuento, $BDpercent);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Descuento registrado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar descuento', 'icon' => 'error');
                }
            } else {
                $data = $this->model->updateTpDescuento($Ndescuento, $BDpercent, $id_tpDescuentos);
                if ($data == 'ok') {
                    $msg = array('msg' => 'El descuento a sido modificado con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar descuento', 'icon' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function deleteTpDescuento(int $id)
    {
        $data = $this->model->deleteDataTableById('tipodescuento',$id);
        if ($data == 'ok') {
            $msg = array('msg' => 'El descuento a sido eliminado con exito', 'icon' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar descuento', 'icon' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function editTpDescuento(int $id)
    {
        $data = $this->model->getDataTableById('tipodescuento', $id);
        $percent = $data['monto'] * 100;
        $data['monto'] = number_format($percent, 2);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getDataEditIR(int $id)
    {
        $data = $this->model->getDataTableById('tipodescuento', $id);
        $percent = $data['monto'] * 100;
        $data['monto'] = number_format($percent, 2);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registerDescuento()
    {
        $id = $_POST['id'];
        $id_empleado = $_POST['empleado'];
        $descuento = $_POST['id_descuentos'];
        $dataEmpleado = $this->model->getDataEmpleado($id_empleado);
        $sueldoEmpleadoA = $dataEmpleado['sueldo'] * 12;

        if ($descuento == 'IR') {
            $id_Tpdescuento = $this->percentIRtoPay($sueldoEmpleadoA);
            if ($id == "") {
                $data = $this->model->insertDescuento($id_Tpdescuento, $id_empleado);
                if ($data == 'ok') {
                    $msg = array('msg' => 'El descuento se registro con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al guardar descuento', 'icon' => 'error');
                }
            } else {
                $data = $this->model->updateDescuento($id_Tpdescuento, $id_empleado, $id);
                if ($data == 'ok') {
                    $msg = array('msg' => 'El descuento se registro con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al guardar descuento', 'icon' => 'error');
                }
            }
        } else {
            if ($id == "") {
                $data = $this->model->insertDescuento($descuento, $id_empleado);
                if ($data == 'ok') {
                    $msg = array('msg' => 'El descuento se registro con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al guardar descuento', 'icon' => 'error');
                }
            } else {
                $data = $this->model->updateDescuento($descuento, $id_empleado, $id);
                if ($data == 'ok') {
                    $msg = array('msg' => 'El descuento se registro con exito', 'icon' => 'success');
                } else {
                    $msg = array('msg' => 'Error al guardar descuento', 'icon' => 'error');
                }
            }
        }



        echo json_encode($msg, JSON_UNESCAPED_UNICODE),
        die();
    }

    public function editDescuento(int $id)
    {
        $data = $this->model->getDataTableById('descuento', $id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deleteDescuento(int $id)
    {
        $data = $this->model->deleteDataTableById('descuento',$id);
        if ($data == 'ok') {
            $msg = array('msg' => 'El descuento a sido eliminado con exito', 'icon' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar descuento', 'icon' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    function percentIRtoPay($sueldoEmpleadoA)
    {
        $UITs = array('5' => 23000, '20' => 92000, '35' => 161000, '45' => 207000);
        if ($sueldoEmpleadoA <= $UITs['5']) {
            $id_Tpdescuento = 39;
        } elseif ($sueldoEmpleadoA > $UITs['5'] && $sueldoEmpleadoA <= $UITs['20']) {
            $id_Tpdescuento = 40;
        } elseif ($sueldoEmpleadoA > $UITs['20'] && $sueldoEmpleadoA <= $UITs['35']) {
            $id_Tpdescuento = 41;
        } elseif ($sueldoEmpleadoA > $UITs['35'] && $sueldoEmpleadoA <= $UITs['45']) {
            $id_Tpdescuento = 42;
        } else {
            $id_Tpdescuento = 43;
        }

        return $id_Tpdescuento;
    }
}
