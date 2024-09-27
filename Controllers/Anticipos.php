<?php 

class Anticipos extends Controller{

    public function index(){
        $data=$this->model->getDataTable('empleado');
        $this->views->getView($this, 'index', $data);
    }

    public function listar(){
        $data=$this->model->viewAnticiposXempleados();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['editar'] = '<button class="btn btn-primary" type="button" onclick="btnEditarAnticipo(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar'] = '<button class="btn btn-danger" type="buxton" onclick="btnEliminarAnticipo(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);    
    }

    public function register(){
        $id=$_POST['id'];
        $monto=$_POST['mon_anticipo'];
        $estado=$_POST['estado'];
        $fecha=$_POST['fech_anticipo'];
        $empleado=$_POST['empleado'];
        if (empty($monto) || empty($fecha) || empty($empleado)) {
            $msg=array('msg'=>'Se requiere llenar todos los campos', 'icon'=>'warning');
        } else {
            $fechaProcess= date('Y-m-d', strtotime($fecha));
            if ($id == "") {
                $data=$this->model->registerDataAnticipo($monto, $fechaProcess, $estado,$empleado);
                if ($data == 'ok') {
                    $msg=array('msg'=>'Solicitud registrada con exito', 'icon'=>'success');
                } else {
                    $msg=array('msg'=>'Error al registrar solicitud', 'icon'=>'error');
                }
                
            } else {
                $data=$this->model->editAnticipo($monto, $fechaProcess, $estado,$empleado, $id);
                if ($data == 'ok') {
                    $msg=array('msg'=>'Solicitud modificada con éxito', 'icon'=>'success');
                } else {
                    $msg=array('msg'=>'Error al modificar solicitud', 'icon'=>'error');
                }
            }
            
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function edit(int $id){
        $data=$this->model->getAnticipoById($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete(int $id){
        $data=$this->model->deleteAnticipo($id);
        if ($data == 'ok') {
            $msg=array('msg'=>'Solicitud eliminada con exito', 'icon'=>'success');
        } else {
            $msg=array('msg'=>'Error al eliminar solicitud', 'icon'=>'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        
    }
}
