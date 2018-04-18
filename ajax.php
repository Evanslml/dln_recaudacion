<?php
//verificamos que se halla enviado por post 
if($_POST) {
  //incluimos el core
  require('core/core.php');
  //creamos un switch y verificamos por url el modo a utilizar
  //se pueden crear mas case dependiendo el caso podria ser un registro también
  //si el caso es login ubicamos el archivo a utilizar via ajax caso contrario nos envia al index
  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'login':
      require('public/user/ajax/login.php');
    break;
    default:
      header('location: ./');
    break;
  }
} else {
  //si no se envia por post redireccionamos al index
  header('location: ./');
}
?>