<?php

class Acceso 
{
    protected $nombre;
    protected $passw;
    protected $email;
    protected $perfilId;
    protected $id;
    protected $telefono;
    protected $EstablecimientoId;
  
  function __construct($a,$b,$email,$perfil,$id,$tel,$est)
  {
    $this->nombre =$a;
    $this->passw =$b;
    $this->email =$email;
    $this->perfilId =$perfil;
    $this->id =$id;
    $this->telefono =$tel;
    $this->EstablecimientoId =$est;
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

  public function DeshabilitarUsuario(){
    $db = new Conexion();
    $sql = $db->query("UPDATE musuario SET MUSU_ESTADO='0' WHERE MUSU_ID='$this->id';");
  }
  
  public function HabilitarUsuario(){
    $db = new Conexion();
    $sql = $db->query("UPDATE musuario SET MUSU_ESTADO='1' WHERE MUSU_ID='$this->id';");
  }

  public function ModificarUsuario(){
    $db = new Conexion();
    $sql = $db->query("UPDATE musuario SET 
      MUSU_NOMBRES='$this->nombre',
      MUSU_TELEFONO='$this->telefono',
      MPERF_ID='$this->perfilId',
      NESTA_RENAES='$this->EstablecimientoId' 
      WHERE MUSU_ID='$this->id';");
  }

  public function AgregarUsuario(){
    $db = new Conexion();
    $sql = $db->query("SELECT MUSU_LOGIN FROM musuario WHERE MUSU_LOGIN='$this->email';");
     
    if($db->rows($sql)==0) {
    $salt = substr ($this->email, 0, 2);
    $clave_crypt = crypt($this->passw, $salt);

    $db->query("INSERT INTO musuario 
      (MUSU_ID,MUSU_LOGIN,MUSU_PASSWORD,MUSU_ESTADO,MPERF_ID,NESTA_RENAES,MUSU_NOMBRES,MUSU_TELEFONO,MUSU_CORREO,MUSU_IMG) 
      VALUES 
      (default,'$this->email','$clave_crypt','1','$this->perfilId','$this->EstablecimientoId','$this->nombre','$this->telefono','$this->email','user_man.png');");
     /* $db->query("
      INSERT INTO musuario 
      (MUSU_ID,MUSU_LOGIN,MUSU_PASSWORD,MUSU_NOMBRES,MUSU_TELEFONO,MUSU_CORREO,MUSU_USERIN,MUSU_IMG,MUSU_HOST,MUSU_ESTADO,MPERF_ID,NESTA_RENAES
      VALUES 
      ('','$this->email','$this->passw','$this->nombre','$this->telefono','$this->email','01','user_man.png','172.16.0.3','1','$this->perfilId','$this->EstablecimientoId');
      ");
      */
      header('location: ./index.php?view=usuario&error=noerror');

     }else{
        header('location: ./index.php?view=usuario&error=emailUsado');
     }
  }


  public static function ListaUsuarioPerfil(){
    $db = new conexion();
    $sql = $db->query("SELECT MUSU_ID,MUSU_LOGIN,MUSU_PASSWORD,MUSU_NOMBRES,MUSU_TELEFONO,A.MPERF_ID,MPERF_NOMBRE,NEST_NOMBRE,C.NESTA_RENAES,MUSU_ESTADO FROM musuario A 
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


  public static function ListaEstablecimientos(){
    $db = new Conexion();
    $sql = $db->query("SELECT * FROM nestablecimiento ORDER BY nest_orden;");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $establecimiento[$d['NESTA_RENAES']] = $d;
      }
    } else {
      $establecimiento = false;
    }
    $sql->free();
    $db->close();
    return $establecimiento;
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