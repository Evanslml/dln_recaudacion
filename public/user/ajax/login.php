<?php
//verificamos que se haya enviado via post
if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    estado_servidor('Error! Metodo de ingreso invalido!');
}
//instaciamos la conexion
$db = new Conexion();
//creamos variables con los datos enviados desde el formulario y las limpiamos
$email = $db->real_escape_string($_POST['user']); 
$pass = strip_tags($_POST['pass']);
 
//creamos una consulta para saber si el usuario existe en la db
$b_user = "SELECT * FROM MUSUARIO WHERE MUSU_LOGIN='$email'";
$result = $db->query($b_user);
$ses = $result->fetch_array();
//comparamos password
$salt = substr ($email, 0, 2);
//encriptamos password
$clave_crypt = crypt($pass, $salt);
 
    if(($email != '') && ($pass != ''))
    {//vaildar datos
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {//validar mail
          //if($row = $result->num_rows)
          if($result->num_rows > 0)
          {//buscamos email
              if($ses['MUSU_PASSWORD'] == $clave_crypt)
              {//buscamos pass
                //declaramos variables todo OK
                $_SESSION['sesion_id'] = $ses['MUSU_ID'];
                if($_POST['sesion']) { ini_set('session.cookie_lifetime', time() + (60*60*24)); }
                $message = 1;
              }//fin de buscar pass
              else
              {
                  $message ='<div class="alert alert-form alert-warning text-xs-center">Verifique contraseña.</div>';
              }
          }//fin de buscar email
          else
          {
              $message ='<div class="alert alert-form alert-danger text-xs-center">Email no existe en nuestro sistema.</div>';
          }
        }//fin validar mail
        else
        {
          $message = '<div class="alert alert-form alert-danger text-xs-center">Email inválido.</div>';
        }
    }//fin validar datos
    else
    {
        $message = '<div class="alert alert-form alert-danger text-xs-center">Deberas llenar todos los campos.</div>';
    }
 
echo $message;
 
function estado_servidor($str){
    echo json_encode(array('estado'=>$str));
    exit;
}
?>