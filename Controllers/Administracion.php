<?php 
    class Administracion extends Controller{


        public function home(){

            $this->views->getView($this, 'home');
            echo 'joder';
        }
    }


?>