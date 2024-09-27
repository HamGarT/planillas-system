<?php 

    class Home extends Controller{ //no necesita require -----todo comprobado
       

        public function index(){
            $this->views->getView($this, 'index');
        }
        public function mode(){
            session_start();
            echo json_encode($_SESSION['mode']);
            
        }

        
        
    }
?>