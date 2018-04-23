<?php

class Acceso 
{
    protected $nombre;
    protected $passw;
    protected $email;
    protected $perfil;
  
  function __construct($a,$b,$email,$perfil)
  {
    $this->nombre =$a;
    $this->passw =$b;
    $this->email =$email;
    $this->perfil =$perfil;
  }

  public static function User() {
   //instaciamos la conexion
    $db = new Conexion();
    $sql = $db->query("SELECT * FROM musuario;");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $user[$d['MUSU_ID']] = $d;
      }
    } else {
      $user = false;
    }
    $sql->free();
    $db->close();
   
    return $user;
  }

  public function ActualizarUsuario(){
    $db = new Conexion();
    $salt = substr ($this->email, 0, 2);
    $clave_crypt = crypt($this->passw, $salt);
    $sql = $db->query("UPDATE musuario SET MUSU_NOMBRES='$this->nombre',MUSU_PASSWORD='$clave_crypt' WHERE MUSU_LOGIN='$this->email';");
  }


  public static function ListaUsuarioPerfil(){
    $db = new conexion();
    $sql = $db->query("SELECT MUSU_ID,MUSU_LOGIN,MUSU_PASSWORD,MUSU_NOMBRES,MUSU_TELEFONO,A.MPERF_ID,MPERF_NOMBRE,NEST_NOMBRE FROM musuario A 
    INNER JOIN mperfil B ON A.MPERF_ID=B.MPERF_ID 
    INNER JOIN nestablecimiento C ON A.NESTA_RENAES=C.NESTA_RENAES
    WHERE B.MPERF_ESTADO='1' ORDER BY A.MUSU_ID;");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $UserPerfil[$d['MUSU_ID']] = $d;
      }
    } else {
      $UserPerfil = false;
    }
    $sql->free();
    $db->close();
   
    return $UserPerfil;
  }

  public static function ListaPerfil(){
    $db = new Conexion();
    $sql = $db->query("SELECT * FROM mperfil;");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $user[$d['MPERF_ID']] = $d;
      }
    } else {
      $user = false;
    }
    $sql->free();
    $db->close();
    return $user;
  }






}





//creamos una funcion user para ser usada en todo el sitio
/*
function User() {
   //instaciamos la conexion
  $db = new Conexion();
  $sql = $db->query("SELECT * FROM musuario;");
  if($sql->num_rows > 0) {
    while($d = $sql->fetch_array()) {
      $user[$d['MUSU_ID']] = $d;
    }
  } else {
    $user = false;
  }
  $sql->free();
  $db->close();
 
  return $user;
}
 */
?>