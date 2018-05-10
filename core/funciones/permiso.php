<?php

class Perfil 
{
  protected $MPERF_ROL;
  protected $MPERF_NOMBRE;
  protected $MPERF_DESCRIPCION;
  protected $MPERF_FECIN;
  protected $MPERF_HOST;
  protected $MPERF_USERIN;
  protected $MPERF_ESTADO;
  
  function __construct($a,$b,$c,$d,$e,$f,$g)
  {
      $this->MPERF_ROL=$a;
      $this->MPERF_NOMBRE=$b;
      $this->MPERF_DESCRIPCION=$c;
      $this->MPERF_FECIN=$d;
      $this->MPERF_HOST=$e;
      $this->MPERF_USERIN=$f;
      $this->MPERF_ESTADO=$g;
  }

  public function NuevoPerfil(){
    $db = new Conexion();
    $sql = $db->query("INSERT INTO mperfil (MPERF_ROL,MPERF_NOMBRE,MPERF_DESCRIPCION,MPERF_FECIN,MPERF_HOST,MPERF_USERIN,MPERF_ESTADO)
    VALUES ()
    ");


    $db->close();
  }

}


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