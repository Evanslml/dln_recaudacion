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

    $query01 = Recaudacion::VerListaFormulario($id_formulario);  //TODO EL CONTENIDO

    $existe1 =  Recaudacion::ExisteFormulario($id_formulario01); //SISMED
    $existe2 =  Recaudacion::ExisteFormulario($id_formulario02); //RDR
    
    $existe3 =  Recaudacion::ExisteFormulario_Deposito($id_formulario01); //SISMED
    $existe4 =  Recaudacion::ExisteFormulario_Deposito($id_formulario02); //RDR

/*    var_dump($existe4);*/
/*    var_dump($existe3);*/

    if($existe1 == 1 && $existe2 == 0 ){
        $query02 = Recaudacion::VerListaFormulariodetalles_Uno($id_formulario01); //SISMED
    }else if($existe1 == 0 && $existe2 == 1 ){ 
        $query02 = Recaudacion::VerListaFormulariodetalles_Uno($id_formulario02); //RDR
    }else{
        $query02 = Recaudacion::VerListaFormulariodetalles($id_formulario01,$id_formulario02); //AMBOS
    }    


    if($existe3 >= 1 && $existe4 == 0 ){
        $query03 = Recaudacion::VerFormulario_Deposito($id_formulario01); //SISMED
    }else if($existe3 == 0 && $existe4 >= 1 ){ 
        $query03 = Recaudacion::VerFormulario_Deposito($id_formulario02); //RDR
    }else if($existe3 == 1 && $existe4 >= 1 ){
        $query03 = Recaudacion::VerFormulario_Deposito($id_formulario01); //AMBOS
        $query04 = Recaudacion::VerFormulario_Deposito($id_formulario02); //AMBOS
    }else{
        $query03='';
    }


	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	if($existe1 == 1 && $existe2 == 0 ){ //SISMED
        $nombre_establecimiento= $query02[0][1];
        $mes= $query02[0][4];
        $dia= $query02[0][5];
        $cantidad_total = $query02[0][8];
        $monto_total = $query02[0][9];
        $SISMED_BOLINI = 'DEL Nº '.$query02[0][6];
        $SISMED_BOLFIN = 'AL Nº '.$query02[0][7];
        $SISMED_CANT = $query02[0][8];
        $SISMED_MONTO = 'S/. '.$query02[0][9];
        $RDR_BOLINI = '';
        $RDR_BOLFIN = '';
        $RDR_CANT = '';
        $RDR_MONTO = '';

    }else if($existe1 == 0 && $existe2 == 1 ){ //RDR
        $nombre_establecimiento= $query02[0][1];
        $mes= $query02[0][4];
        $dia= $query02[0][5];
        $cantidad_total = $query02[0][8];
        $monto_total = $query02[0][9];
        $SISMED_BOLINI = '';
        $SISMED_BOLFIN = '';
        $SISMED_CANT = '';
        $SISMED_MONTO = '';
        $RDR_BOLINI = 'DEL Nº '.$query02[0][6];
        $RDR_BOLFIN = 'AL Nº '.$query02[0][7];
        $RDR_CANT = $query02[0][8];
        $RDR_MONTO = 'S/. '.$query02[0][9];

    }else{ //AMBOS
        $nombre_establecimiento= $query02[0][1];
        $mes= $query02[0][4];
        $dia= $query02[0][5];
        $cantidad_total = $query02[0][14];
        $monto_total = $query02[0][15];
        $SISMED_BOLINI = 'DEL Nº '.$query02[0][6];
        $SISMED_BOLFIN = 'AL Nº '.$query02[0][7];
        $SISMED_CANT = $query02[0][8];
        $SISMED_MONTO = 'S/. '.$query02[0][9];
        $RDR_BOLINI = 'DEL Nº '.$query02[0][10];
        $RDR_BOLFIN = 'AL Nº '.$query02[0][11];
        $RDR_CANT = $query02[0][12];
        $RDR_MONTO = 'S/. '.$query02[0][13];
    }

    //var_dump(count($query03));

    if($existe3 >= 1 && $existe4 == 0 ){ //SISMED
        $n = count($query03);
        $voucher = ''; for ($i=1; $i <=$n ; $i++) {$m=$i-1; $voucher .= $query03[$m][0]; if($m == ($n-1)){$voucher .= ' '; }else{$voucher .= ' - '; } }
        $voucher_sismed=$voucher;
        $voucher_rdr='';

    }else if($existe3 == 0 && $existe4 >= 1 ){ //RDR
        $n = count($query03);
        $voucher = ''; for ($i=1; $i <=$n ; $i++) {$m=$i-1; $voucher .= $query03[$m][0]; if($m == ($n-1)){$voucher .= ' '; }else{$voucher .= ' - '; } }
        $voucher_sismed='';
        $voucher_rdr=$voucher;
        
    }else if($existe3 == 1 && $existe4 >= 1 ){ //AMBOS
        $n = count($query03);
        $a = count($query04);
        $voucher1 = ''; for ($i=1; $i <=$n ; $i++) {$m=$i-1; $voucher1 .= $query03[$m][0]; if($m == ($n-1)){$voucher1 .= ' '; }else{$voucher1 .= ' - '; } }
        $voucher2 = ''; for ($i=1; $i <=$a ; $i++) {$m=$i-1; $voucher2 .= $query04[$m][0]; if($m == ($a-1)){$voucher2 .= ' '; }else{$voucher2 .= ' - '; } }
        $voucher_sismed= $voucher1;
        $voucher_rdr=$voucher2;
        
    }else{
        $voucher_sismed= '';
        $voucher_rdr= '';
    }
    

/*    var_dump($voucher_sismed);*/
/*    var_dump($voucher_rdr);*/

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