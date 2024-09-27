<?php 


class Usuarios extends Controller{
    
    
  public function __construct(){ 
    session_start();
    parent::__construct();// se tiene que llamar al constructor padre porque se a creado un nuevo constructor y cuando no se crea un  uevo constructor en esta clase el constructor es el de padre

  }
    public function index(){
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $this->views->getView($this, "index");
    }

    public function validar(){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        if(empty($user) || empty($pass)){
            $msg='los campos estan vacios';
        }else{
            $hash = hash("SHA256", $pass);
            $data = $this->model->getUsuario($user, $hash);
            if($data){
                $_SESSION['id_user'] = $data['id'];
                $_SESSION['user'] = $data['username'];
                $_SESSION['name'] = $data['nombre'];
                $_SESSION['correo']= $data['correo'];
                $_SESSION['activo']=true;
                $msg = 'ok';
            }else{
                $msg= "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function returnDataUser(){
        echo json_encode(array('user'=>$_SESSION['user'], 'correo'=>$_SESSION['correo']));
    }
    public function salir(){
      session_destroy();
      header('Location:'.base_url);
    }

    public function listar(){
        
        $data = $this->model->getUsuarios(1);
        
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['editar']='<button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i>Editar</button>';
            $data[$i]['eliminar']='<button class="btn btn-danger" type="buxton" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Eliminar</button>';
            $data[$i]['permisos']='<button class="btn btn-warning" type="buxton" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i>Permisos</button>';
        }
        
        echo json_encode($data);
        die();
    }
    

    public function registrar(){
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }

        if ($this->is_valid_email($_POST['correo'])) {
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $pass = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $id = $_POST['id'];
            $hash = hash("SHA256", $pass);
            if (empty($usuario) || empty($nombre) || empty($correo) || empty($telefono)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                    if (!empty($pass) && !empty($confirmar)) {
                        if ($pass != $confirmar) {
                            $msg = array('msg' => 'Las contraseña no coinciden', 'icono' => 'warning');
                        } else {
                            $data = $this->model->registrarUsuario($usuario, $nombre, $correo, $hash, $telefono);
                            if ($data == "ok") {
                                $msg = array('msg' => 'Usuario registrado con éxito', 'icono' => 'success');
                            } else if ($data == "existe") {
                                $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                            } else {
                                $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                            }
                        }
                    } else {
                        $msg = array('msg' => 'La contraseña es requerido', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificarUsuario($usuario, $nombre, $correo, $telefono, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                    } else {
                        $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
                    }
                }
            }
        }else{
            $msg = array('msg' => 'Ingresa un correo valido', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
   
   

    public function eliminar(int $id){
        
        $data=$this->model->eliminarUsuario(0, $id);
        if ($data == 1 ) {
          $msg= array('msg'=>'Usuario dado de baja', 'icono'=>'success');
        }else{
            $msg= array('msg'=>'Error al eliminar el usuario', 'icono'=>'error');
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data=$this->model->editUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }
}
   
?>