<?php

class Reportes
{
	public static function listaReportes(){
		$db = new Conexion();
	    $sql = $db->query("SELECT * FROM lreporte WHERE LREP_ESTADO=1;");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[$d['LREP_ID']] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	} 

	Public static function listaDistritos(){
		$db = new Conexion();
	    $sql = $db->query("
	    	SELECT B.NDIST_ID,B.NDIST_NOMBRE FROM NESTABLECIMIENTO A
			INNER JOIN NDISTRITO B
			ON A.NDIST_ID=B.NDIST_ID
			GROUP BY NDIST_ID,NDIST_NOMBRE;
		");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[$d['NDIST_ID']] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	}

	Public static function listaRecaudacionTipo(){
		$db = new Conexion();
	    $sql = $db->query("SELECT * FROM lrecaudacion_tipo;");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[$d['LRECTIP_ID']] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	}	

	Public static function listaRecaudacionAnio(){
		$db = new Conexion();
	    $sql = $db->query("SELECT * from LANIO WHERE LANIO_ESTADO='1';");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[$d['LANIO_ID']] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	}










//SELECT NESTA_RENAES,NEST_NOMBRE FROM NESTABLECIMIENTO A

}





?>