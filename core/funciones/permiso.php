<?php
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