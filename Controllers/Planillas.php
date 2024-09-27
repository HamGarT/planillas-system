<?php 

class Planillas extends Controller{

    public function index(){
        $this->views->getView($this, 'index');
    }
}

?>