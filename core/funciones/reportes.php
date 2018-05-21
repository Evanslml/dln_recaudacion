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


	Public static function ReporteBolDepDiaria($t,$n,$e,$d,$fi,$ff){
		$db = new Conexion();

		if($t=='00'){$tipo_recaudacion='';}else{$tipo_recaudacion=" AND SUBSTRING(A.LRECAU_ID,3,2)='$t' ";}
		
		switch ($n) {
			case '02':
				$nivel_recaudacion=" AND C.NDIST_ID='$d' ";
				break;
			case '03':
				$nivel_recaudacion=" AND SUBSTRING(A.LRECAU_ID,11,5) ='$e' ";
				break;
			default:
				$nivel_recaudacion='';
				break;
		}

	    $sql = $db->query("SELECT D.LRECTIP_ALIAS,A.LRECAU_ID,B.NESTA_RENAES,B.NEST_NOMBRE,A.LRECAU_VOUCHER,A.LRECAU_FECHA,A.LRECAU_MONTO,C.NDIST_ID,C.NDIST_NOMBRE,B.NESTA_RENAES
		FROM lrecaudacion_deposito A
		INNER JOIN nestablecimiento B
		ON SUBSTRING(A.LRECAU_ID,11,5) = B.NESTA_RENAES
		INNER JOIN ndistrito C
		ON B.NDIST_ID = C.NDIST_ID
		INNER JOIN lrecaudacion_tipo D
		ON SUBSTRING(A.LRECAU_ID,3,2)=D.LRECTIP_ID
		WHERE (A.LRECAU_FECHA BETWEEN '$fi' AND '$ff')
		$tipo_recaudacion"."$nivel_recaudacion
		ORDER BY B.NESTA_RENAES,A.LRECAU_FECHA DESC
		");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	}

	Public static function ReporteBolDepResumen($t,$n,$e,$d,$fi,$ff){
		$db = new Conexion();

		if($t=='00'){$tipo_recaudacion='';}else{$tipo_recaudacion=" AND SUBSTRING(A.LRECAU_ID,3,2)='$t' ";}
		
		switch ($n) {
			case '02':
				$nivel_recaudacion=" AND C.NDIST_ID='$d' ";
				break;
			case '03':
				$nivel_recaudacion=" AND SUBSTRING(A.LRECAU_ID,11,5) ='$e' ";
				break;
			default:
				$nivel_recaudacion='';
				break;
		}

	    $sql = $db->query("SELECT B.NESTA_RENAES,B.NEST_NOMBRE,SUM(A.LRECAU_MONTO) MONTO,C.NDIST_NOMBRE
		FROM lrecaudacion_deposito A
		INNER JOIN nestablecimiento B
		ON SUBSTRING(A.LRECAU_ID,11,5) = B.NESTA_RENAES
		INNER JOIN ndistrito C
		ON B.NDIST_ID = C.NDIST_ID
		INNER JOIN lrecaudacion_tipo D
		ON SUBSTRING(A.LRECAU_ID,3,2)=D.LRECTIP_ID
		WHERE (A.LRECAU_FECHA BETWEEN '$fi' AND '$ff')
		$tipo_recaudacion"."$nivel_recaudacion
		GROUP BY B.NESTA_RENAES,B.NEST_NOMBRE,C.NDIST_NOMBRE
		");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[] = $d;
	      }
	    } else {
	      $data = false;
	    }
	    $sql->free();
	    $db->close();
	   
	    return $data;
	}

	Public static function ReporteRecIngresos($t,$n,$e,$d,$fi,$ff){
		$db = new Conexion();

		if($t=='00'){$tipo_recaudacion='';}else{$tipo_recaudacion=" AND SUBSTRING(A.LRECAU_ID,3,2)='$t' ";}
		
		switch ($n) {
			case '02':
				$nivel_recaudacion=" AND C.NDIST_ID='$d' ";
				break;
			case '03':
				$nivel_recaudacion=" AND SUBSTRING(A.LRECAU_ID,11,5) ='$e' ";
				break;
			default:
				$nivel_recaudacion='';
				break;
		}

	    $sql = $db->query("SELECT F.LCLAS_ALIAS,F.LCLAS_NOMBRE,SUM(E.CANTIDAD) CANTIDAD,SUM(E.MONTO) MONTO
		FROM(
		SELECT LRECAU_ID,MIN(LRECAU_FECHA) FECHA_MIN,MAX(LRECAU_FECHA) FECHA_MAX FROM lrecaudacion_deposito
		GROUP BY LRECAU_ID
		)A
		INNER JOIN nestablecimiento B
		ON SUBSTRING(A.LRECAU_ID,11,5) = B.NESTA_RENAES
		INNER JOIN ndistrito C
		ON B.NDIST_ID = C.NDIST_ID
		INNER JOIN lrecaudacion_tipo D
		ON SUBSTRING(A.LRECAU_ID,3,2)=D.LRECTIP_ID
		INNER JOIN lrecaudacion_detalle E
		ON A.LRECAU_ID=E.LRECAU_ID
		INNER JOIN lclasificador F
		ON F.LCLAS_ID = E.IDITEM
		WHERE F.LCLAS_ESTADO='1'
		AND (A.FECHA_MIN >='$fi' OR A.FECHA_MAX <= '$ff')
		$tipo_recaudacion"."$nivel_recaudacion
		GROUP BY F.LCLAS_ALIAS,F.LCLAS_NOMBRE
		");
	    if($sql->num_rows > 0) {
	      while($d = $sql->fetch_array()) {
	        $data[] = $d;
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