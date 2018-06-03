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
	    	SELECT B.NDIST_ID,B.NDIST_NOMBRE FROM nestablecimiento A
			INNER JOIN ndistrito B
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
	    $sql = $db->query("SELECT * from lanio WHERE LANIO_ESTADO='1';");
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

//R01
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

//R02
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

//R03
	Public static function ReporteRegistroRec($t,$n,$e,$d,$fi,$ff){
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

	    $sql = $db->query("
		SELECT 
		F.LCLAS_ALIAS,F.LCLAS_NOMBRE,SUM(E.CANTIDAD) CANTIDAD,SUM(E.MONTO) MONTO,F.LCLAS_ID,F.LCLAS_PADRE,D.LRECTIP_ID
		FROM lrecaudacion A
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
		AND ( A.LRECAU_FECREC BETWEEN '$fi' AND '$ff')
		$tipo_recaudacion"."$nivel_recaudacion
		GROUP BY F.LCLAS_ID,F.LCLAS_ALIAS,F.LCLAS_NOMBRE,F.LCLAS_PADRE,D.LRECTIP_ID
		ORDER BY F.LCLAS_ID*1
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

//04 A
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

	    $sql = $db->query("
		SELECT MIN(LCLAS_ID)ID,LCLAS_ALIAS,DETALLE_D,DETALLE_PADRE,SUM(CANTIDAD)CANTIDAD, SUM(MONTO) MONTO,
		CODIGO_A,DETALLE_A,CODIGO_B,DETALLE_B,CODIGO_C,DETALLE_C
		 FROM (
				SELECT F.DETALLE_A,F.CODIGO_A,F.CODIGO_B,F.DETALLE_B,F.CODIGO_C,F.DETALLE_C,F.DETALLE_D,
				F.LCLAS_ID,F.LCLAS_ALIAS,F.LCLAS_NOMBRE,F.DETALLE_PADRE,SUM(E.CANTIDAD) CANTIDAD,SUM(E.MONTO) MONTO
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
				WHERE F.LCLAS_ESTADO='1' AND F.DETALLE_PADRE IS NOT NULL
				AND (A.FECHA_MIN >='$fi' AND A.FECHA_MAX <= '$ff')
				$tipo_recaudacion"."$nivel_recaudacion
				GROUP BY F.LCLAS_ID,F.LCLAS_ALIAS,F.DETALLE_PADRE,F.LCLAS_NOMBRE,F.CODIGO_A,F.DETALLE_A,F.CODIGO_B,F.DETALLE_B,F.CODIGO_C,F.DETALLE_C,F.DETALLE_D
				ORDER BY F.LCLAS_ID
		)X
		GROUP BY LCLAS_ALIAS,CODIGO_A,DETALLE_A,CODIGO_B,DETALLE_B,CODIGO_C,DETALLE_C,DETALLE_D,DETALLE_PADRE

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


//04 B
	Public static function ReporteRecIngresos_Sum($t,$n,$e,$d,$fi,$ff){
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

	    $sql = $db->query("
		SELECT DETALLE_PADRE,SUM(MONTO)MONTO FROM(
		SELECT ID,LCLAS_ALIAS,DETALLE_D,DETALLE_PADRE,CASE WHEN (DETALLE_PADRE=0) THEN '' ELSE MONTO END AS MONTO
		FROM(
				SELECT MIN(LCLAS_ID)ID,LCLAS_ALIAS,DETALLE_D,DETALLE_PADRE,SUM(CANTIDAD)CANTIDAD, SUM(MONTO) MONTO,
				CODIGO_A,DETALLE_A,CODIGO_B,DETALLE_B,CODIGO_C,DETALLE_C
				 FROM (
						SELECT F.DETALLE_A,F.CODIGO_A,F.CODIGO_B,F.DETALLE_B,F.CODIGO_C,F.DETALLE_C,F.DETALLE_D,
						F.LCLAS_ID,F.LCLAS_ALIAS,F.LCLAS_NOMBRE,F.DETALLE_PADRE,SUM(E.CANTIDAD) CANTIDAD,SUM(E.MONTO) MONTO
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
						WHERE F.LCLAS_ESTADO='1' AND F.DETALLE_PADRE IS NOT NULL
						AND (A.FECHA_MIN >='$fi' AND A.FECHA_MAX <= '$ff')
						$tipo_recaudacion"."$nivel_recaudacion
						GROUP BY F.LCLAS_ID,F.LCLAS_ALIAS,F.DETALLE_PADRE,F.LCLAS_NOMBRE,F.CODIGO_A,F.DETALLE_A,F.CODIGO_B,F.DETALLE_B,F.CODIGO_C,F.DETALLE_C,F.DETALLE_D
						ORDER BY F.LCLAS_ID
				)X
				GROUP BY LCLAS_ALIAS,CODIGO_A,DETALLE_A,CODIGO_B,DETALLE_B,CODIGO_C,DETALLE_C,DETALLE_D,DETALLE_PADRE
		)A
		)B GROUP BY DETALLE_PADRE
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