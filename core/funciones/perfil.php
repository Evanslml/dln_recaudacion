<?php
function Perfil() {
  $db = new Conexion();
  $sql = $db->query("SELECT MUSU_ID, MPERF_ROL, MPERF_NOMBRE FROM MUSUARIO A INNER JOIN MPERFIL B ON A.MPERF_ID=B.MPERF_ID");
  if($sql->num_rows > 0) {
    while($d = $sql->fetch_array()) {
      $perfil[$d['MUSU_ID']] = $d;
    }
  } else {
    $perfil = false;
  }
  $sql->free();
  $db->close();
  return $perfil;
}
 
?>