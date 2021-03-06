<?php

	require_once('../../core.php');

   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
   else { 

   	$reporte_title = 'CONSOLIDADO DE RECAUDACIÓN POR DEPÓSITO';
    $desde = 'DESDE :';
    $hasta = 'HASTA :';
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
    $title = array(
        'RENAES',
        'ESTABLECIMIENTO',
        'TOTAL GENERAL',
        'ALIMENTOS Y BEBIDAS 1.3.1.4.1.1',
        'VTA. DE BASES PARA LICITACION PUBLICA,CONC<br>URSO PUBLICO Y OTROS 1.3.19.12',
        'AUTORIZACION, INSPECCION Y CONTROL SANITARIO 1.3.24.12',
        'EXAMEN MEDICO 1.3.24.13',
        'CERTIFICADOS 1.3.24.14',
        'CARNETS Y/O TARJETAS DE ATENCION 1.3.24.16',
        'CONTROL CANINO 1.3.24.17',
        'OTROS DERECHOS ADMINISTRA<br>TIVOS DE SALUD 1.3.24.199',
        'ATENCION MEDICA 1.3.34.11',
        'ATENCION DENTAL 1.3.34.12',
        'EXAMEN PSICOLOGICO Y/O PSIQUIATRICA 1.3.34.13',
        'SERVICIO DE EMERGENCIA 1.3.34.14',
        'CIRUGIA 1.3.34.15',
        'HOSPITALIZA<br>CION 1.3.34.16',
        'SERVICIO DE TOPICO 1.3.34.17',
        'OTROS SERVICIOS MEDICOS - ASISTENC.  1.3.34.199',
        'EXAMENES DE LABORATORIO 1.3.34.21',
        'ELECTROCARD<br>IOGRAMA 1.3.34.23',
        'DIAGNOSTICO POR IMÁGENES 1.3.34.24',
        'FISIOTERAPIA 1.3.34.31',
        'OTROS SERVICIOS DE SALUD 1.3.34.399',
        'SERVICIOS FUNERARIOS Y CEMENTERIOS 1.3.39.216',
        'MULTAS A ESTABLECIMI<br>ENTOS, FARMACIAS Y OTROS 1.5.21.62',
        'OTRAS MULTAS 1.5.21.62'
    );

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

    $query05 = Reportes::ReporteRecDeposito($tipo_recaudacion,$tipo_nivel,$establecimiento,$distrito,$date1,$date2);
    //var_dump($query05);
    //var_dump($title[0]);

	require_once(dirname(__FILE__).'/../html2pdf.class.php');

    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/body_report05.php');
    $content = ob_get_clean();


    try
    {
        // init HTML2PDF
        //$html2pdf = new HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf = new HTML2PDF('L', 'A3', 'es');
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Reporte.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


  } ?> <!--Else-->