<?php

 require_once('../../../core/core.php');

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    estado_servidor('Error! Metodo de ingreso invalido!');
}


	if (empty($_POST['bolinirdr'])) {

           $errors[] = "Boleta Vacia";

        } else {
        	$a = $_POST['bolinirdr'];
        	$b = $_POST['bolfinrdr'];
        	$c = $_POST['bolinisismed'];
        	$d = $_POST['bolfinsismed'];
        	$e = date($_POST['date']);
        	$f = date("Y-m-d", strtotime($e));

			$c1=intval($_POST['c1']);$c2=intval($_POST['c2']);$c3=intval($_POST['c3']);$c4=intval($_POST['c4']);$c5=intval($_POST['c5']);$c6=intval($_POST['c6']);$c7=intval($_POST['c7']);$c8=intval($_POST['c8']);$c9=intval($_POST['c9']);$c10=intval($_POST['c10']);
			$c11=intval($_POST['c11']);$c12=intval($_POST['c12']);$c13=intval($_POST['c13']);$c14=intval($_POST['c14']);$c15=intval($_POST['c15']);$c16=intval($_POST['c16']);$c17=intval($_POST['c17']);$c18=intval($_POST['c18']);$c19=intval($_POST['c19']);$c20=intval($_POST['c20']);
			$c21=intval($_POST['c21']);$c22=intval($_POST['c22']);$c23=intval($_POST['c23']);$c24=intval($_POST['c24']);$c25=intval($_POST['c25']);$c26=intval($_POST['c26']);$c27=intval($_POST['c27']);$c28=intval($_POST['c28']);$c29=intval($_POST['c29']);$c30=intval($_POST['c30']);
			$c31=intval($_POST['c31']);$c32=intval($_POST['c32']);$c33=intval($_POST['c33']);$c34=intval($_POST['c34']);$c35=intval($_POST['c35']);$c36=intval($_POST['c36']);$c37=intval($_POST['c37']);$c38=intval($_POST['c38']);$c39=intval($_POST['c39']);$c40=intval($_POST['c40']);
			$c41=intval($_POST['c41']);$c42=intval($_POST['c42']);$c43=intval($_POST['c43']);$c44=intval($_POST['c44']);$c45=intval($_POST['c45']);$c46=intval($_POST['c46']);$c47=intval($_POST['c47']);$c48=intval($_POST['c48']);$c49=intval($_POST['c49']);$c50=intval($_POST['c50']);
			$c51=intval($_POST['c51']);$c52=intval($_POST['c52']);$c53=intval($_POST['c53']);$c54=intval($_POST['c54']);$c55=intval($_POST['c55']);$c56=intval($_POST['c56']);$c57=intval($_POST['c57']);$c58=intval($_POST['c58']);$c59=intval($_POST['c59']);$c60=intval($_POST['c60']);
			$c61=intval($_POST['c61']);$c62=intval($_POST['c62']);$c63=intval($_POST['c63']);

		    $m1=number_format(intval($_POST['m1'])/100, 2, '.', '');$m2=number_format(intval($_POST['m2'])/100, 2, '.', '');$m3=number_format(intval($_POST['m3'])/100, 2, '.', '');$m4=number_format(intval($_POST['m4'])/100, 2, '.', '');$m5=number_format(intval($_POST['m5'])/100, 2, '.', '');$m6=number_format(intval($_POST['m6'])/100, 2, '.', '');$m7=number_format(intval($_POST['m7'])/100, 2, '.', '');$m8=number_format(intval($_POST['m8'])/100, 2, '.', '');$m9=number_format(intval($_POST['m9'])/100, 2, '.', '');$m10=number_format(intval($_POST['m10'])/100, 2, '.', '');
            $m11=number_format(intval($_POST['m11'])/100, 2, '.', '');$m12=number_format(intval($_POST['m12'])/100, 2, '.', '');$m13=number_format(intval($_POST['m13'])/100, 2, '.', '');$m14=number_format(intval($_POST['m14'])/100, 2, '.', '');$m15=number_format(intval($_POST['m15'])/100, 2, '.', '');$m16=number_format(intval($_POST['m16'])/100, 2, '.', '');$m17=number_format(intval($_POST['m17'])/100, 2, '.', '');$m18=number_format(intval($_POST['m18'])/100, 2, '.', '');$m19=number_format(intval($_POST['m19'])/100, 2, '.', '');$m20=number_format(intval($_POST['m20'])/100, 2, '.', '');
            $m21=number_format(intval($_POST['m21'])/100, 2, '.', '');$m22=number_format(intval($_POST['m22'])/100, 2, '.', '');$m23=number_format(intval($_POST['m23'])/100, 2, '.', '');$m24=number_format(intval($_POST['m24'])/100, 2, '.', '');$m25=number_format(intval($_POST['m25'])/100, 2, '.', '');$m26=number_format(intval($_POST['m26'])/100, 2, '.', '');$m27=number_format(intval($_POST['m27'])/100, 2, '.', '');$m28=number_format(intval($_POST['m28'])/100, 2, '.', '');$m29=number_format(intval($_POST['m29'])/100, 2, '.', '');$m30=number_format(intval($_POST['m30'])/100, 2, '.', '');
            $m31=number_format(intval($_POST['m31'])/100, 2, '.', '');$m32=number_format(intval($_POST['m32'])/100, 2, '.', '');$m33=number_format(intval($_POST['m33'])/100, 2, '.', '');$m34=number_format(intval($_POST['m34'])/100, 2, '.', '');$m35=number_format(intval($_POST['m35'])/100, 2, '.', '');$m36=number_format(intval($_POST['m36'])/100, 2, '.', '');$m37=number_format(intval($_POST['m37'])/100, 2, '.', '');$m38=number_format(intval($_POST['m38'])/100, 2, '.', '');$m39=number_format(intval($_POST['m39'])/100, 2, '.', '');$m40=number_format(intval($_POST['m40'])/100, 2, '.', '');
            $m41=number_format(intval($_POST['m41'])/100, 2, '.', '');$m42=number_format(intval($_POST['m42'])/100, 2, '.', '');$m43=number_format(intval($_POST['m43'])/100, 2, '.', '');$m44=number_format(intval($_POST['m44'])/100, 2, '.', '');$m45=number_format(intval($_POST['m45'])/100, 2, '.', '');$m46=number_format(intval($_POST['m46'])/100, 2, '.', '');$m47=number_format(intval($_POST['m47'])/100, 2, '.', '');$m48=number_format(intval($_POST['m48'])/100, 2, '.', '');$m49=number_format(intval($_POST['m49'])/100, 2, '.', '');$m50=number_format(intval($_POST['m50'])/100, 2, '.', '');
            $m51=number_format(intval($_POST['m51'])/100, 2, '.', '');$m52=number_format(intval($_POST['m52'])/100, 2, '.', '');$m53=number_format(intval($_POST['m53'])/100, 2, '.', '');$m54=number_format(intval($_POST['m54'])/100, 2, '.', '');$m55=number_format(intval($_POST['m55'])/100, 2, '.', '');$m56=number_format(intval($_POST['m56'])/100, 2, '.', '');$m57=number_format(intval($_POST['m57'])/100, 2, '.', '');$m58=number_format(intval($_POST['m58'])/100, 2, '.', '');$m59=number_format(intval($_POST['m59'])/100, 2, '.', '');$m60=number_format(intval($_POST['m60'])/100, 2, '.', '');
            $m61=number_format(intval($_POST['m61'])/100, 2, '.', '');$m62=number_format(intval($_POST['m62'])/100, 2, '.', '');$m63=number_format(intval($_POST['m63'])/100, 2, '.', '');


        	//$messages[] = $a.''.$b.''.$c.''.$d.''.var_dump($e).'///'.$c1.''. $c2.''. $c3.''. $c4.''. $c5.''. $c6.''. $c7.''. $c8.''. $c9.''. $c10.''. $c11.''. $c12.''. $c13.''. $c14.''. $c15.''. $c16.''. $c17.''. $c18.''. $c19.''. $c20.''. $c21.''. $c22.''. $c23.''. $c24.''. $c25.''. $c26.''. $c27.''. $c28.''. $c29.''. $c30.''. $c31.''. $c32.''. $c33.''. $c34.''. $c35.''. $c36.''. $c37.''. $c38.''. $c39.''. $c40.''. $c41.''. $c42.''. $c43.''. $c44.''. $c45.''. $c46.''. $c47.''. $c48.''. $c49.''. $c50.''. $c51.''. $c52.''. $c53.''. $c54.''. $c55.''. $c56.''. $c57.''. $c58.''. $c59.''. $c60.''. $c61.''. $c62.''. $c63.'///'.$m1.''. $m2.''. $m3.''. $m4.''. $m5.''. $m6.''. $m7.''. $m8.''. $m9.''. $m10.''. $m11.''. $m12.''. $m13.''. $m14.''. $m15.''. $m16.''. $m17.''. $m18.''. $m19.''. $m20.''. $m21.''. $m22.''. $m23.''. $m24.''. $m25.''. $m26.''. $m27.''. $m28.''. $m29.''. $m30.''. $m31.''. $m32.''. $m33.''. $m34.''. $m35.''. $m36.''. $m37.''. $m38.''. $m39.''. $m40.''. $m41.''. $m42.''. $m43.''. $m44.''. $m45.''. $m46.''. $m47.''. $m48.''. $m49.''. $m50.''. $m51.''. $m52.''. $m53.''. $m54.''. $m55.''. $m56.''. $m57.''. $m58.''. $m59.''. $m60.''. $m61.''. $m62.''. $m63;

        	$ida= substr($f,0,4);
        	$idm= substr($f,5,2);
        	$idd= substr($f,8,2);
        	$ide= '05757';
        	$id1='0101'.$ida.$idm.$idd.$ide;
        	$imprdr = $m3+$m5+$m21+$m62;

        	$messages[] = 'Id'. $id1.'estab'.$ide.'año'.$ida.'mes'.$idm.'fecha'.$e.'boleta ini'.$a.'Boleta fin'.$b.'importe'.$imprdr.'/2018-05-04/';
        	$messages[] = 'Bien hecho, se realizó el guardado satisfactoriamente';

        	$NuevoFormulario = new Recaudacion($id1,$ide,$ida,$idm,$f,'01','01',$a,$b,'3.65','2018-05-04');
	        $NuevoFormulario ->IngresarRecaudacion();

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



?>