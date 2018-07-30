<?php

	require_once('../../core.php');

   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
   else { 

   	$reporte_title = 'CONSOLIDADO DE RECAUDACIÓN POR DEPÓSITO';
    $desde = 'DESDE : ';
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
        'Renaes',
        'Establecimiento',
        'Total General',
        'Total RDR',
        'Total Sismed',
        'VENTA DE BIENES',
        'ALIMENT<br>OS Y BEBIDAS',
        'FARMA<br>CIA',
        'VTA. DE BASES PARA LICITACI<br>ON PUBLICA,<br>CONCUR<br>SO PUBLICO Y OTROS',
        'DERECH<br>OS Y TASAS ADMINIS<br>TRATIV<br>OS',
        'AUTORI<br>ZACION, <br>INSPEC<br>CION Y CONTR<br>OL SANITA<br>RIO',
        'EXAM<br>EN MEDICO',
        'CERTIFI<br>CADOS',
        'CARNETS Y/O TARJET<br>AS DE ATENCI<br>ON',
        'CONTROL CANINO',
        'OTROS DERECH<br>OS ADMINIS<br>TRATIV<br>OS DE SALUD',
        'VENTA DE SERVICI<br>OS',
        'ATENCI<br>ON MEDICA',
        'ATENCI<br>ON DENTAL',
        'EXAMEN PSICOLO<br>GICO Y/O PSIQUIA<br>TRICA',
        'SERVIC<br>IO DE EMER<br>GENCIA',
        'CIRUGIA',
        'HOSPITA<br>LIZACION',
        'SERVICIO DE TOPICO',
        'OTROS SERVICI<br>OS MEDICOS - ASISTENC.',
        'EXAMEN<br>ES DE LABORA<br>TORIO',
        'ELECTRO<br>CARDIO<br>GRAMA',
        'DIAGNOS<br>TICO POR IMÁGE<br>NES',
        'FISIOTE<br>RAPIA',
        'OTROS SERVICI<br>OS DE SALUD',
        'SERVICI<br>OS FUNERA<br>RIOS Y CEMEN<br>TERIOS',
        'CUENTAS POR COBRAR DIVERS<br>AS',
        'MULTAS A ESTABLE<br>CIMIEN<br>TOS, FARMA<br>CIAS Y OTROS',
        'OTRAS MULTAS'
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