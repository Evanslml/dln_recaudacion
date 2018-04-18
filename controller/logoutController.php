<?php
    //obtenenmos el modo desconectar.
    if(isset($_GET['logout']) == 'desconectar')
    {
      //limpiamos todas las variables de sesion iniciadas
      $_SESSION['sesion_id'] == NULL ;
      unset($_SESSION['sesion_id']);
      session_destroy();                  
      //redireccionamos al index
      header('Location: ./');
    }
?>