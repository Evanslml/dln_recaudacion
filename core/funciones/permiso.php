<?php

class Perfil 
{
  protected $MPERF_ID;
  protected $MPERF_ROL;
  protected $MPERF_NOMBRE;
  protected $MPERF_DESCRIPCION;
  protected $MPERF_FECIN;
  protected $MPERF_HOST;
  protected $MPERF_USERIN;
  protected $MPERF_ESTADO;
  
  function __construct($a,$b,$c,$d,$e,$f,$g,$h)
  {
      $this->MPERF_ID=$a;
      $this->MPERF_ROL=$b;
      $this->MPERF_NOMBRE=$c;
      $this->MPERF_DESCRIPCION=$d;
      $this->MPERF_FECIN=$e;
      $this->MPERF_HOST=$f;
      $this->MPERF_USERIN=$g;
      $this->MPERF_ESTADO=$h;
  }

  public function NuevoPerfil(){
    $db = new Conexion();
    $sql = $db->query("INSERT INTO mperfil ( 
      MPERF_ID,MPERF_ROL,MPERF_NOMBRE,MPERF_DESCRIPCION,MPERF_FECIN,MPERF_HOST,MPERF_USERIN,MPERF_ESTADO
      )
      VALUES (
      default,
      '$this->MPERF_ROL',
      '$this->MPERF_NOMBRE',
      '$this->MPERF_DESCRIPCION',
      '$this->MPERF_FECIN',
      '$this->MPERF_HOST',
      '$this->MPERF_USERIN',
      '$this->MPERF_ESTADO'
      )
    ");
    $db->close();
  }

  public static function getLastId(){
    $db = new Conexion();
    $sql = $db->query("SELECT MPERF_ID FROM mperfil  ORDER BY MPERF_ID DESC LIMIT 1");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato = $d['MPERF_ID'];
      }
      } else {
        $dato = '0';
      }
      $sql->free();
      $db->close();
      return $dato;
  }

  public function EditarPerfil(){
    $db = new Conexion();
    $sql = $db->query("UPDATE mperfil SET
      MPERF_ROL= '$this->MPERF_ROL',
      MPERF_NOMBRE= '$this->MPERF_NOMBRE',
      MPERF_DESCRIPCION= '$this->MPERF_DESCRIPCION',
      MPERF_FECIN= '$this->MPERF_FECIN',
      MPERF_HOST= '$this->MPERF_HOST',
      MPERF_USERIN= '$this->MPERF_USERIN',
      MPERF_ESTADO= '$this->MPERF_ESTADO'
      WHERE 
      MPERF_ID='$this->MPERF_ID'
    ");
    $db->close();
  }



} //PERFIL



/**
* PERMISO*/

class Permisos extends Perfil
{
  
  protected $MPERM_ID;
  protected $MOBJ_ID;
  protected $MPERM_TIP;
  protected $MPERM_ESTADO;


  function __construct($a,$b,$c,$d,$e)
  {
      $this->MPERM_ID=$a;
      $this->MPERF_ID=$b;
      $this->MOBJ_ID=$c;
      $this->MPERM_TIP=$d;
      $this->MPERM_ESTADO=$e;
  }

  public function NuevosPermisos(){
    $db = new Conexion();
    $sql = $db->query("
      INSERT INTO mpermiso ( 
      MPERM_ID,MPERF_ID,MOBJ_ID,MPERM_TIP,MPERM_ESTADO
      )
      VALUES (
      default,
      '$this->MPERF_ID',
      '$this->MOBJ_ID',
      '$this->MPERM_TIP',
      '$this->MPERM_ESTADO'
      )
    ");
    $db->close();
  }

  public function EliminarPermisos(){
    $db = new Conexion();
    $sql1 = $db->query("DELETE FROM mpermiso WHERE MPERF_ID='$this->MPERF_ID'; "); 
    $db->close();
  }

  public static function ListarObjetos(){
    $db = new Conexion();
    $sql = $db->query("SELECT * FROM mobjeto WHERE MOBJ_ESTADO='1' ORDER BY MOBJ_ID"); 
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $Objeto[$d['MOBJ_ID']] = $d;
      }
    } else {
      $Objeto = false;
    }
    $sql->free();
    $db->close();
   
    return $Objeto;
  }


  public static function PermisoSegunId($id) {
    $db = new Conexion();
    $sql = $db->query("SELECT MPERF_ID,A.MOBJ_ID,MOBJ_ALIAS,MOBJ_NOMBRE,MOBJ_ENLACE,MOBJ_PADRE,MOBJ_ORDEN,MOBJ_ESTADO,MOBJ_ICON FROM mobjeto A
    INNER JOIN mpermiso B ON 
    A.MOBJ_ID=B.MOBJ_ID 
    WHERE MPERM_ESTADO='1' AND MPERF_ID='$id'
    GROUP BY MPERF_ID,A.MOBJ_ID,MOBJ_ALIAS,MOBJ_NOMBRE,MOBJ_ENLACE,MOBJ_PADRE,MOBJ_ORDEN,MOBJ_ESTADO,MOBJ_ICON
    ORDER BY MOBJ_ID,MOBJ_ORDEN
    ");
      if($sql->num_rows > 0) {
        while($d = $sql->fetch_array()) {
          $permiso[$d['MOBJ_ID']] = $d;
        }
      } else {
        $permiso = false;
      }
      $sql->free();
      $db->close();
      return $permiso;
  }



}



 
?>