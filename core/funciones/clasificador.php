<?php 


/**
* 
*/
class Clasificador
{
	
  public static function ListaClasificador() {
   //instaciamos la conexion
    $db = new Conexion();
    $sql = $db->query("SELECT A.LCLAS_ID,A.LCLAS_ALIAS,A.LCLAS_NOMBRE,A.LCLAS_PADRE,B.LCOMP_NOMBRE,C.LRECTIP_NOMBRE,A.LCLAS_ESTADO from lclasificador A 
INNER JOIN lcomponente B
ON A.LCOMP_ID = B.LCOMP_ID
INNER JOIN lrecaudacion_tipo C
ON C.LRECTIP_ID = A.LRECTIP_ID
ORDER BY LCLAS_ID;");
    if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $Clasif[$d['LCLAS_ID']] = $d;
      }
    } else {
      $Clasif = false;
    }
    $sql->free();
    $db->close();
   
    return $Clasif;
  }


}

