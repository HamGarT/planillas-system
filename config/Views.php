<?php 


  class Views{
    
     public function getView($nameController, $view, $data='')
     {
      $nameController= get_class($nameController);
      if ($nameController == 'Home') {
        $view="Views/".$view.".php";
      } else {
        $view="Views/".$nameController."/".$view.".php";
      }
       require $view;
     }
  }
?>