<?php

require_once('../../../core/core.php');
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';    

    //SAVE VOUCHER
    if($action == 'json'){

    	$data = $_POST['data'];
    	echo 'funciona json'.$data;

    }

    //PAGINATION
    if($action == 'ajax'){


    }
