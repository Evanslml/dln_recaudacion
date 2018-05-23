<?php

	require_once('../../core.php');

   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
   else { 

    $id_formulario= $_GET['id_formulario'];
    $id_formulario= substr($id_formulario, 4,11);

    $id_formulario01 = '0101'.$id_formulario;
    $id_formulario02 = '0102'.$id_formulario;

    $query01 = Recaudacion::VerListaFormulario($id_formulario);
    //$query02 = Recaudacion::VerListaFormularioRDR_SISMED($id_formulario);
    $query03 = Recaudacion::VerListaFormulariodetalles($id_formulario01,$id_formulario02);

	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	//var_dump($query03);

    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_formulario_html.php');
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