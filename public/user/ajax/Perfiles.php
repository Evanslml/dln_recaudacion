<?php

require_once('../../../core/core.php');
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';    

    //SAVE VOUCHER
    if($action == 'nuevoperfil'){

    	$data = json_decode($_POST['data1']);
    	$permisos = array();

    	foreach($data  as $key=>$val){

            if($key ==0){
                $perfil = strtoupper($val);
            } else if ($key ==1){
            	$descripcion = strtoupper($val);
            } else{
            	$permisos[]=$val;
            }

        }

	$ip = get_client_ip();
	$day = datetodayhour();
	$user = $_usuario[$_SESSION['sesion_id']]['MUSU_LOGIN'];
	$perfilId = intval($_GetIdPerfil)+1;

	$mperm_tip = array('MENU','VER','CREAR','ACTUALIZAR','ELIMINAR');
	//var_dump($perfilId);

	$newPerfil = new Perfil('',$perfil,$perfil,$descripcion,$day,$ip,$user,1);
    $newPerfil->NuevoPerfil();

	//var_dump($new);

        $cantidad1 = count($permisos);
        $cantidad2 = count($mperm_tip);

        for ($i=1; $i<=$cantidad1; $i++) {
        	
        	$n= $i-1;

            for ($j=1; $j <= $cantidad2; $j++) { 
            	$m= $j-1;
            	$newPermiso = 'newPermisos' . $n . $j ;
	            $newPermiso = new Permisos('',$perfilId,$permisos[$n],$mperm_tip[$m],1);
	            $newPermiso->NuevosPermisos();
	            //echo $perfilId.'<br>';
	            //echo $permisos[$n].'<br>';
	            //echo $mperm_tip[$m].'<br>';
	            //echo '=================================';
            	//var_dump($mperm_tip[$m]);
            }

        }



    } //action new perfil

    //eidtar
    if($action == 'editarperfil'){

        $data = json_decode($_POST['data1']);
        $permisos = array();

        foreach($data  as $key=>$val){

            if($key ==0){
                $perfilId = strtoupper($val);
            } else if ($key ==1){
                $perfil = strtoupper($val);
            } else if ($key ==2){
                $descripcion = strtoupper($val);
            } else{
                $permisos[]=$val;
            }

        }

        $ip = get_client_ip();
        $day = datetodayhour();
        $user = $_usuario[$_SESSION['sesion_id']]['MUSU_LOGIN'];
        $mperm_tip = array('MENU','VER','CREAR','ACTUALIZAR','ELIMINAR');

        $modPerfil = new Perfil($perfilId,$perfil,$perfil,$descripcion,$day,$ip,$user,1);
        $modPerfil->EditarPerfil();

        $cantidad1 = count($permisos);
        $cantidad2 = count($mperm_tip);

        //var_dump($modPerfil);
        $delPermiso = new Permisos('',$perfilId,'','','');
        $delPermiso->EliminarPermisos();

        for ($i=1; $i<=$cantidad1; $i++) {
            $n= $i-1;
            for ($j=1; $j <= $cantidad2; $j++) { 
                $m= $j-1;
                $modPermiso = 'modPermisos' . $n . $j ;
                $modPermiso = new Permisos('',$perfilId,$permisos[$n],$mperm_tip[$m],1);
                $modPermiso->NuevosPermisos();
            }
        }

        var_dump($modPerfil);
 


    } //action edit perfil


