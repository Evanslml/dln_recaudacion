<?php
$mode = isset($_GET['mode']) ?  $_GET['mode'] : 'default';

switch($mode){
  case 'actualizar':
      if(isset($_POST['form_perfil'])){
          
          if(!empty($_POST['p_nombre']) AND !empty($_POST['p_pass_1']) AND !empty($_POST['p_pass_1'])){
              if($_POST['p_pass_1'] == $_POST['p_pass_2']){

                  $ActualizarPass = new Acceso( $_POST['p_nombre'], $_POST['p_pass_1'], $_POST['email'],'','','','', $_POST['p_dni']);
                  $ActualizarPass ->ActualizarUsuario();
                  $mensaje='Se ha actualizado los datos password correctamente';
                  $class='success';

              }else{  
                  $mensaje='las contraseñas deben ser iguales';
                  $class='warning';
              }
          }else{
            $mensaje='Los campos no deben estar vacios';
            $class='danger';
          }


      }else{
        header('location: index.php?view=perfil');
      }

  break;

  default:
      //header('location: index.php?view=perfil');
  break;

}
?>