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




function Permiso($id) {
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
 
?>