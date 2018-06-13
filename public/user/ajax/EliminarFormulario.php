<?php

require_once('../../../core/core.php');


if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    estado_servidor('Error! Metodo de ingreso invalido!');
}else{

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:''; 

	//SAVE VOUCHER
    if($action == 'eliminar'){

    	$data = json_decode($_POST['data1']);

    	 foreach($data  as $key=>$val){
            if($key ==0){
                $IdFormulario = $val;
            }
        }

        $IdFormulario01 = '0101'.substr($IdFormulario,4,13);
        $IdFormulario02 = '0102'.substr($IdFormulario,4,13);
        $NuevoFormulario01 = new Recaudacion($IdFormulario01,'','','','','','','','','','','','','');
        $NuevoFormulario02 = new Recaudacion($IdFormulario02,'','','','','','','','','','','','','');

        $RecaudacionVoucher01 = new RecaudacionVoucher($IdFormulario01,'','','','','','');
        $RecaudacionVoucher02 = new RecaudacionVoucher($IdFormulario02,'','','','','','');

        $NuevoFormulario01->EliminarRecaudacion();
        $NuevoFormulario02->EliminarRecaudacion();        
        $RecaudacionVoucher01->EliminarRecaudacion_Deposito();
        $RecaudacionVoucher02->EliminarRecaudacion_Deposito();

        $RecaudacionVoucher01->EliminarPlanillon();        
        $RecaudacionVoucher02->EliminarPlanillon();        


    }



}