<?php

	require_once('../../core.php');

   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
   else { 

   	$reporte_title = 'REPORTE DE BOLETAS DEPOSITADAS DIARIAS';
    $desde = 'F. DEPOSITO DESDE : ';
    $hasta = 'F. DEPOSITO HASTA :';
    $tipo_recaudacion = $_GET['tipo_recaudacion'];
    $tipo_nivel = $_GET['tipo_nivel'];
    $distrito = $_GET['distrito'];
    $lbl_distrito = $_GET['lbl_distrito'];
    $establecimiento = $_GET['establecimiento'];
    $lbl_establecimiento = $_GET['lbl_establecimiento'];
    $date1 = date($_GET['date1']);
    $date1 = date("Y-m-d", strtotime($date1)); 
    $date2 = date($_GET['date2']);
    $date2 = date("Y-m-d", strtotime($date2)); 
    $title = array('Fecha Recaudación','Tipo','Renipres','Establecimiento','Voucher','Importe','Fecha Deposito');
    switch ($tipo_nivel) {
        case '01':
            $lbl_nivel ='NIVEL';
            $return_nivel ='D.L.N';
            break;
        case '02':
            $lbl_nivel ='DISTRITO';
            $return_nivel = $lbl_distrito;
            break;
            break;
        case '03':
            $lbl_nivel ='ESTABLECIMIENTO';
            $return_nivel = $lbl_establecimiento;
            break;
            break;
    }

    $query01 = Reportes::ReporteBolDepDiaria($tipo_recaudacion,$tipo_nivel,$establecimiento,$distrito,$date1,$date2);

	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	//var_dump($query01);

    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/body_report01.php');
    $content = ob_get_clean();


    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


  } ?> <!--Else-->