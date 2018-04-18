<?php

$Extencion = substr(strrchr(__FILE__, '.'), 1);
//lamamos a core 
require('core/core.'. $Extencion);
//obtenemos por url el controlador
if(isset($_GET['view'])) {
   //buscamos en la carpeta controlador el controlador respectivo
  if(file_exists('controller/' . strtolower($_GET['view']) . 'Controller.'. $Extencion)) {
    include('controller/' . strtolower($_GET['view']) . 'Controller.'. $Extencion);
  } else {
    //si no existe mostramos un error
    include('controller/errorController.php');
  }
} else {
  //si no llamamos a ningun controlador mostramos el index por defecto
  include('controller/indexController.php');
}
?>