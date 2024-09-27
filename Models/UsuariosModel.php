<?php 

    
    class UsuariosModel extends Query{

        public function __construct(){
             parent::__construct();
        }

        public function getUsuario(string $username, string $password){
            $sql="SELECT * FROM usuarios WHERE username = '$username' AND pass = '$password'";
            $data=$this->select($sql);
            return $data;
        }

        public function getUsuarios(int $estado){
            $sql="SELECT * FROM usuarios WHERE estado='$estado'";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function registrarUsuario(string $username, string $name, string $correo, string $pass, string $telefono)
        {
            $vericar = "SELECT * FROM usuarios WHERE username = '$username' OR correo = '$correo'";
            $existe = $this->select($vericar);
            if (empty($existe)) {
                # code...
                $sql = "INSERT INTO usuarios(username, nombre, correo, pass, telefono) VALUES (?,?,?,?,?)";
                $datos = array($username, $name, $correo, $pass, $telefono);
                $data = $this->save($sql, $datos);
                if ($data == 1) {
                    $res = "ok";
                }else{
                    $res = "error";
                }
            }else{
                $res = "existe";
            }
            return $res;
        }

        public function modificarUsuario(string $username, string $nombre, string $correo, string $telefono, int $id){
            $sql="UPDATE usuarios SET username = ?, nombre = ?, correo = ?, telefono = ? WHERE id=?";
            $datos=array($username, $nombre, $correo, $telefono, $id);
            $data=$this->save($sql, $datos);
            if ($data == 1) {
                $res = "modificado";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function eliminarUsuario(int $estado, int $id){
            $sql="UPDATE usuarios SET estado = ? WHERE id = ?";
            $datos= array($estado, $id);
            $data= $this->save($sql, $datos);
            return $data;
        }

        public function editUser($id){
            $sql="SELECT * FROM usuarios WHERE id = '$id'";
            $data=$this->select($sql);
            return $data;
        }
        
    }
?>