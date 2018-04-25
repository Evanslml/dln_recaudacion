<?php
$mode = isset($_GET['mode']) ?  $_GET['mode'] : 'default';

$error = isset($_GET['error']) ?  $_GET['error'] : 'default';
      
    switch ($error) {
      case 'emailUsado':
        $arrayMensaje = array('mensaje' => 'El correo ya esta registrado', 'class' => 'danger');
        $_SESSION['arrayMensaje'] = $arrayMensaje;
        header('location: ./usuario');
      break;
      case 'noerror':
        $arrayMensaje = array('mensaje' => 'Se creo el usuario exitosamente', 'class' => 'success');
        $_SESSION['arrayMensaje'] = $arrayMensaje;
        header('location: ./usuario');
      break;

      default:
      break;
    }

switch($mode){
  case 'deshabilitar':
      if(isset($_POST['mod_idDelete'])){
          
          if(!empty($_POST['mod_idDelete']) ){
                  $Deleteuser = new Acceso('','','','',$_POST['mod_idDelete'],'','');
                  $Deleteuser ->DeshabilitarUsuario();
                  $arrayMensaje = array(
                    'mensaje' => 'Se ha deshabilitado el usuario correctamente',
                    'class' => 'success'
                     );
                  $_SESSION['arrayMensaje'] = $arrayMensaje;
                  header('location: ./usuario');
          }else{
            $arrayMensaje = array(
              'mensaje' => 'No se puede deshabilitar el usuario',
              'class' => 'warning'
            );
            $_SESSION['arrayMensaje'] = $arrayMensaje;
            header('location: ./usuario');
          }
      }else{
          $arrayMensaje = array(
              'mensaje' => 'Error interno',
              'class' => 'danger'
          );
          $_SESSION['arrayMensaje'] = $arrayMensaje;
          header('location: ./usuario');
      }

  break;

  case 'habilitar':
      if(isset($_POST['mod_idAdd'])){
          
          if(!empty($_POST['mod_idAdd']) ){
                  $Adduser = new Acceso('','','','',$_POST['mod_idAdd'],'','');
                  $Adduser ->HabilitarUsuario();
                  $arrayMensaje = array(
                    'mensaje' => 'Se ha habilitado el usuario correctamente',
                    'class' => 'success'
                     );
                  $_SESSION['arrayMensaje'] = $arrayMensaje;
                  header('location: ./usuario');

          }else{
            $arrayMensaje = array(
              'mensaje' => 'No se puede habilitar el usuario',
              'class' => 'warning'
            );
            $_SESSION['arrayMensaje'] = $arrayMensaje;
            header('location: ./usuario');
          }
      }else{
          $arrayMensaje = array(
              'mensaje' => 'Error interno',
              'class' => 'danger'
            );
          $_SESSION['arrayMensaje'] = $arrayMensaje;
            header('location: ./usuario');
      }

  break;

  case 'modificar':
      if(isset($_POST['mod_id'])){
          
          if(!empty($_POST['mod_nombres']) and !empty($_POST['mod_perfilId']) and !empty($_POST['mod_IdEstablecimiento']) ){
                  $ModifyUser = new Acceso(strtoupper($_POST['mod_nombres']),'','',$_POST['mod_perfilId'],$_POST['mod_id'],$_POST['mod_telefono'],$_POST['mod_IdEstablecimiento']);
                  $ModifyUser ->ModificarUsuario();
                  $arrayMensaje = array(
                    'mensaje' => 'Se ha modificado los datos del usuario correctamente',
                    'class' => 'success'
                     );
                  $_SESSION['arrayMensaje'] = $arrayMensaje;
                  header('location: ./usuario');

                 
          }else{
            $arrayMensaje = array(
              'mensaje' => 'No debe estar vacio',
              'class' => 'warning'
            );
            $_SESSION['arrayMensaje'] = $arrayMensaje;
            header('location: ./usuario');
          }
      }else{
          $arrayMensaje = array(
              'mensaje' => 'Error interno',
              'class' => 'danger'
            );
          $_SESSION['arrayMensaje'] = $arrayMensaje;
          header('location: ./usuario');
      }

  break;

  case 'agregar':
      if(isset($_POST['new_id'])){

            if(!empty($_POST['new_password'])) {
            
                if(!empty($_POST['new_usuario']) and !empty($_POST['new_nombres']) and !empty($_POST['new_perfilId']) and !empty($_POST['new_IdEstablecimiento']) ){
                        
                        $AddUser = new Acceso(strtoupper($_POST['new_nombres']),$_POST['new_password'],$_POST['new_usuario'],$_POST['new_perfilId'],'',$_POST['new_telefono'],$_POST['new_IdEstablecimiento']);
                        $AddUser ->AgregarUsuario();
                        /*$arrayMensaje = array(
                          'mensaje' => 'Se ha modificado los datos del usuario correctamente',
                          'class' => 'success'
                           );
                        $_SESSION['arrayMensaje'] = $arrayMensaje;
                        header('location: ./usuario');*/
                }else{
                  $arrayMensaje = array(
                    'mensaje' => 'Falta registrar datos importantes',
                    'class' => 'warning'
                  );
                  $_SESSION['arrayMensaje'] = $arrayMensaje;
                  header('location: ./usuario');
                }

          }else{
              $arrayMensaje = array(
              'mensaje' => 'Debe ingresar una contraseña',
              'class' => 'danger'
              );
              $_SESSION['arrayMensaje'] = $arrayMensaje;
              header('location: ./usuario');
          }


      }else{
          $arrayMensaje = array(
              'mensaje' => 'Error interno',
              'class' => 'danger'
            );
          $_SESSION['arrayMensaje'] = $arrayMensaje;
          header('location: ./usuario');
      }

  break;

  case 'load':
      $_SESSION['arrayMensaje'] = '' ;
      header('location: ./usuario');
  break;

/*
  default:

  break;
*/
}
?>
