<?php

require_once('../../../core/core.php');


if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    estado_servidor('Error! Metodo de ingreso invalido!');
}else{
        	
        	$data = json_decode($_POST['data1']);
        	$id_usuario= $_ListaUsuario[$_SESSION['sesion_id']]['MUSU_ID']);
        	$cantidad = array();
        	$monto = array();
        	$xx=0;
        	$yy=0;
        	 foreach($data  as $key=>$val){

        	 	if($key <= 11){
	        	 	switch ($key) {
	        	 		case '0': $bol_ini_rdr=$val; break;
	        	 		case '1': $bol_fin_rdr=$val; break;
	        	 		case '2': $bol_ini_sismed=$val; break;
	        	 		case '3': $bol_fin_sismed=$val; break;
	        	 		case '4': $fecha=$val; break;
	        	 		case '5': $establecimiento=$val; break;
	        	 		case '6': $cant_total=$val; break;
	        	 		case '7': $monto_total=$val; break;
	        	 		case '8': $cantidad_SISMED=$val; break;
	        	 		case '9': $monto_SISMED=$val; break;
	        	 		case '10': $cantidad_RDR=$val; break;
	        	 		case '11': $monto_RDR=$val; break;
	        	 	}//Switch
	        	 } else {

		        	 	if($key %2 == 0){
		        	 		$cantidad[$xx] = intval($val);
		        	 		$xx++;
		        	 	}else{
		        	 		$monto[$yy] = number_format(floatval(ltrim(rtrim($val)))/100, 2, '.', '');
		        	 		$yy++;
		        	 	}
	        	 }
	        } //Foreach
			 
			$resultado = array();  // union 
			 
			foreach ($cantidad as $key => $cant){         
			    $resultado[] = array ('cantidad'=>$cant,'monto'=>$monto[$key]);
			}
			//var_dump ($resultado);

/*        	var_dump($bol_ini_rdr);*/
/*        	var_dump($bol_fin_rdr);*/
/*        	var_dump($bol_ini_sismed);*/
/*        	var_dump($bol_fin_sismed);*/
/*        	var_dump($fecha);*/
/*        	var_dump($establecimiento);*/
/*        	var_dump($cant_total);*/
/*        	var_dump($monto_total);*/
/*        	var_dump($cantidad_SISMED);*/
/*        	var_dump($monto_SISMED);*/
/*        	var_dump($cantidad_RDR);*/
/*        	var_dump($monto_RDR);*/
/*        	var_dump($cantidad);*/
/*        	var_dump($monto);*/

        	$a = $bol_ini_rdr;
        	$b = $bol_fin_rdr;
        	$c = $bol_ini_sismed;
        	$d = $bol_fin_sismed;
        	$e = $fecha;
        	$f = date("Y-m-d", strtotime($e));
        	$now = new DateTime();
	 		$h=$now->format('Y-m-d H:i:s');

            $fo = '01';
        	$ida= substr($f,2,2);
        	$idm= substr($f,5,2);
        	$idd= substr($f,8,2);
        	$t1='01';
        	$t2='02';
        	$ide= $establecimiento;
            $id1= $fo.$t1.$ida.$idm.$idd.$ide;
        	$id2= $fo.$t2.$ida.$idm.$idd.$ide;
        	
        	$imprdr = $monto_RDR;
        	$cantrdr = $cantidad_RDR;
        	$impsismed = $monto_SISMED;
        	$cantsismed = $cantidad_SISMED;


        	$z = array('0' => $id1, '1' => $ide, '2' => $ida, '3' => $idm, '4' => $f, '5' => $fo, '6' => $t1, '7' => $c, '8' => $d, '9' => $cantsismed, '10' => $impsismed, '11' => $h, '12' => 0 );
            $y = array('0' => $id2, '1' => $ide, '2' => $ida, '3' => $idm, '4' => $f, '5' => $fo, '6' => $t2, '7' => $a, '8' => $b, '9' => $cantrdr, '10' => $imprdr, '11' => $h, '12' => 0);
/*
            var_dump($z);
            var_dump($y);
*/            

			$NuevoFormulario01 = new Recaudacion($z[0],$z[1],$z[2],$z[3],$z[4],$z[5],$z[6],$z[7],$z[8],$z[9],$z[10],$z[11],$z[12]);
        	$NuevoFormulario02 = new Recaudacion($y[0],$y[1],$y[2],$y[3],$y[4],$y[5],$y[6],$y[7],$y[8],$y[9],$y[10],$y[11],$y[12]);

        	$existe01 = $NuevoFormulario01 ->BuscarRecaudacion ();
        	$existe02 = $NuevoFormulario02 ->BuscarRecaudacion ();
        	
        	$coun_result = count($resultado);

			if(($existe01 == 0) && ($existe02 == 0)) {

				if($impsismed != '0' || $cantsismed!='0.00'){

					$NuevoFormulario01 ->IngresarRecaudacion();
				}
				if($imprdr != '0' || $cantrdr!='0.00'){

					$NuevoFormulario02 ->IngresarRecaudacion();
				}

				foreach ($resultado as $key => $value) {
					$i = $key+1;
					switch ($i) {
						case '3':
						case '4':
				        	$new= 'NuevoRecauDetalle' . $i;
				        	$new = new RecaudacionDetalle($id1,$t1,$i,$value['cantidad'],$value['monto'],'');
				        	$new ->IngresoDetalleRecaudacion();
							break;
						default:
							$new= 'NuevoRecauDetalle' . $i;
				        	$new = new RecaudacionDetalle($id2,$t2,$i,$value['cantidad'],$value['monto'],'');
				        	$new ->IngresoDetalleRecaudacion();
							break;
							break;
					}
				}
				$messages[] ='Se ha guardado correctamente los datos';

			}else{
				$errors[]= 'No se ha podido realizar el ingreso, El Formulario ya existe';
			}




	if (isset($errors)){ ?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong> 
				<?php
					foreach ($errors as $error) {
							echo $error;
						}
					?>
		</div>
	<?php
	}
	if (isset($messages)){ ?>
		<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Bien hecho!</strong>
				<?php
					foreach ($messages as $message) {
							echo $message;
						}
					?>
		</div>
	<?php
	}

}//ELSE

?>