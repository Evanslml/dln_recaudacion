<?php

   require_once('../core.php');
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
   else { 

    require_once 'PHPExcel.php';
    $objPHPExcel = new PHPExcel();

    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('America/Lima');

    $now = new DateTime();
    $h=$now->format('Y-m-d');
    $file='Reporte_Recibos_Ingresos_'.$h.'.xls';
    $header='&L&BFecha de consulta: '.$h;
    $footer='&L&B@DirisLimaNorte - http://app1.dirislimanorte.gob.pe:82';
    $desde = 'F. DEPOSITO DESDE : ';
    $hasta = 'F. DEPOSITO HASTA :';
    $tipo_recaudacion = $_GET['tipo_recaudacion'];

    switch ($tipo_recaudacion) {
        case '00':
            $reporte_title = 'RECIBOS DE INGRESOS - TODOS';
            break;
        case '01':
            $reporte_title = 'RECIBOS DE INGRESOS - SISMED';
            break;
        case '02':
            $reporte_title = 'RECIBOS DE INGRESOS - R.D.R';
            break;
    }
    
    $tipo_nivel = $_GET['tipo_nivel'];
    $distrito = $_GET['distrito'];
    $lbl_distrito = $_GET['lbl_distrito'];
    $establecimiento = $_GET['establecimiento'];
    $lbl_establecimiento = $_GET['lbl_establecimiento'];
    $date1 = date($_GET['date1']);
    $date1 = date("Y-m-d", strtotime($date1)); 
    $date2 = date($_GET['date2']);
    $date2 = date("Y-m-d", strtotime($date2)); 
    $title = array('Código','Concepto','Importe','Parcial','Total');

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
    $_Report04 = Reportes::ReporteRecIngresos($tipo_recaudacion,$tipo_nivel,$establecimiento,$distrito,$date1,$date2);
    //var_dump($_Report04);
    /*Estilos*/
    $center = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $titulo = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '008080'),
            'size'  => 14,
            'name'  => 'Calibri'
        )
    ); 

    $cabecera = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '008080'),
            'size'  => 11,
            'name'  => 'Calibri'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $body = array(
        'font'  => array(
            'bold'  => false,
            'color' => array('rgb' => '000000'),
            'size'  => 8,
            'name'  => 'Calibri'
        )
    );

    $borders_center = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => '008B8B'),
        )
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       ),
      'font'  => array(
            'bold'  => false,
            'color' => array('rgb' => '000000'),
            'size'  => 8,
            'name'  => 'Calibri'
        )
    );    

    $borders_left = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => '008B8B'),
        )
      ),
      'font'  => array(
            'bold'  => false,
            'color' => array('rgb' => '000000'),
            'size'  => 8,
            'name'  => 'Calibri'
        )
    );

    /*Logo*/
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $objDrawing->setPath('../../view/bootstrap-default/img/logo.png');
    $objDrawing->setCoordinates('A1');
    // set resize to false first
    //$objDrawing->setResizeProportional(false);
    $objDrawing->setOffsetX(10);
    $objDrawing->setOffsetY(0);
    // set width later
    $objDrawing->setWidthAndHeight(320,40);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

    $objPHPExcel->getActiveSheet()->setCellValue('A6', $title[0]);
    $objPHPExcel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($borders_center);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('A6:A7');

    $objPHPExcel->getActiveSheet()->setCellValue('B6', $title[1]);
    $objPHPExcel->getActiveSheet()->getStyle('B6:D7')->applyFromArray($borders_center);    
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('B6:D7');

    $objPHPExcel->getActiveSheet()->setCellValue('E6', $title[2]);
    $objPHPExcel->getActiveSheet()->getStyle('E6:F6')->applyFromArray($borders_center);    
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('E6:F6');

    $objPHPExcel->getActiveSheet()->setCellValue('E7', $title[3]);
    $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($borders_center);    
    $objPHPExcel->getActiveSheet()->setCellValue('F7', $title[4]);
    $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($borders_center);

    if(!empty($_Report04)){

      $SUMA1=0;
      $SUMA2=0;
      $SUMA3=0;
      $SUMA4=0;
      foreach ($_Report04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='1'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA1 += $LCLAS_MONTO1;}
      foreach ($_Report04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='7'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA2 += $LCLAS_MONTO1;}
      foreach ($_Report04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='26'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA3 += $LCLAS_MONTO1;}
      foreach ($_Report04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='73'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA4 += $LCLAS_MONTO1;}

      $SUBTOTAL1=$SUMA1+$SUMA2+$SUMA3;
      $SUBTOTAL2=$SUMA4;

      $SUMA = $SUBTOTAL1 + $SUBTOTAL2;
      $SUMA ='S/. '.number_format($SUMA, 2, '.', '');
      $SUBTOTAL1 ='S/. '.number_format($SUBTOTAL1, 2, '.', '');
      $SUBTOTAL2 ='S/. '.number_format($SUBTOTAL2, 2, '.', '');
      $SUMA1 ='S/. '.number_format($SUMA1, 2, '.', '');
      $SUMA2 ='S/. '.number_format($SUMA2, 2, '.', '');
      $SUMA3 ='S/. '.number_format($SUMA3, 2, '.', '');
      $SUMA4 ='S/. '.number_format($SUMA4, 2, '.', '');



      $objPHPExcel->getActiveSheet()->setCellValue('A8', '1201');
      $objPHPExcel->getActiveSheet()->setCellValue('B8', 'CUENTAS POR COBRAR');
      $objPHPExcel->getActiveSheet()->setCellValue('F8', $SUMA);
      $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('B8:D8');
      

      $objPHPExcel->getActiveSheet()->setCellValue('A9', '1201.03');
      $objPHPExcel->getActiveSheet()->setCellValue('B9', 'VENTA DE BIENES Y SERVICIOS Y DERECHOS ADMINISTRATIVOS');
      $objPHPExcel->getActiveSheet()->setCellValue('E9', $SUBTOTAL1);
      $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('B9:D9');
      
      $objPHPExcel->getActiveSheet()->getStyle('A8:F9')->applyFromArray($borders_center);

        foreach ($_Report04 as $key => $value) {
          $id= $key + 1;
          $LCLAS_ID= $value[0];
          $LCLAS_ALIAS= $value[1];
          $LCLAS_NOMBRE= $value[2];
          $LCLAS_PADRE= $value[3];
          $LCLAS_CANTIDAD= $value[4];
          $LCLAS_MONTO= 'S/. '.$value[5];
          $COD_A=$value[6];
          $DET_A=$value[7];
          $COD_B=$value[8];
          $DET_B=$value[9];
          $COD_C=$value[10];
          $DET_C=$value[11];

        $n=$key;
        $i=$key+10;
        $m=$key+1;
        $celdaA='A'.$i;
        $celdaB='B'.$i;
        $celdaC='C'.$i;
        $celdaD='D'.$i;
        $celdaE='E'.$i;
        $celdaF='F'.$i;
        $merge1=$celdaB.':'.$celdaC;

        if($LCLAS_PADRE=='0'){
            $objPHPExcel->getActiveSheet()->setCellValue($celdaA, $COD_C);
            $objPHPExcel->getActiveSheet()->setCellValue($celdaB, $DET_C);
            if($id=='1'){
                $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $SUMA1);
            }if($id=='5'){
                $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $SUMA2);
            }if($id=='12'){
                $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $SUMA3);
            }if($id=='27'){
                $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $SUMA4);
                $objPHPExcel->getActiveSheet()->setCellValue($celdaE, $SUBTOTAL2);
            }else{
                
            }

            $objPHPExcel->setActiveSheetIndex(0)->mergeCellS($merge1);
            $objPHPExcel->getActiveSheet()->getStyle($merge1)->applyFromArray($borders_left);

        }else{
            $objPHPExcel->getActiveSheet()->setCellValue($celdaA, '');
            $objPHPExcel->getActiveSheet()->setCellValue($celdaB, $LCLAS_ALIAS);
            $objPHPExcel->getActiveSheet()->setCellValue($celdaC, $LCLAS_NOMBRE);
            $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $LCLAS_MONTO);
        }

        
        $objPHPExcel->getActiveSheet()->getStyle($celdaA)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaB)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaC)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaD)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaE)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaF)->applyFromArray($borders_center);

        }
    }else{
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'No se encontraron resultados para la bùsqueda');
    }


    //7,5 X PX
    //https://stackoverflow.com/questions/29026645/how-to-use-print-ready-functionality-in-phpexcel-library
    $objPHPExcel->getActiveSheet() ->setTitle('Reportes');
    //
    $objPHPExcel->getDefaultStyle()->applyFromArray($body);
    $objPHPExcel->getActiveSheet()->getStyle("A4:F4")->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle("A4:F4")->applyFromArray($titulo);
    $objPHPExcel->getActiveSheet()->getStyle("A6:F7")->applyFromArray($cabecera);

    $objPHPExcel->getActiveSheet()->setCellValue('A4', $reporte_title);
    $objPHPExcel->getActiveSheet()->setCellValue('D1', $desde);
    $objPHPExcel->getActiveSheet()->setCellValue('F1', $date1);
    $objPHPExcel->getActiveSheet()->setCellValue('D2', $hasta);
    $objPHPExcel->getActiveSheet()->setCellValue('F2', $date2);    
    $objPHPExcel->getActiveSheet()->setCellValue('D3', $lbl_nivel);
    $objPHPExcel->getActiveSheet()->setCellValue('F3', $return_nivel);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('A4:F4');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('D1:E1');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('D2:E2');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('D3:E3');
    $objPHPExcel->getActiveSheet()->getStyle("D1:F1")->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle("D2:F2")->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle("D3:F3")->applyFromArray($center);
    //Dimension
    $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(10); //70 27
    $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(13); //70 63
    $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(52); //210  272
    $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(10); //70 60
    $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(10); //70  60
    $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(15); //105 60
    //Orientation and Paper Size:
    $objPHPExcel->getActiveSheet() ->getPageSetup() ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT); //PORTRAIT _ LANDSCAPE
    $objPHPExcel->getActiveSheet() ->getPageSetup() ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    //Page margins:
    $objPHPExcel->getActiveSheet() ->getPageMargins()->setTop(1); 
    $objPHPExcel->getActiveSheet() ->getPageMargins()->setRight(0.75);
    $objPHPExcel->getActiveSheet() ->getPageMargins()->setLeft(0.75); 
    $objPHPExcel->getActiveSheet() ->getPageMargins()->setBottom(1);
    //Headers and Footers:
    $objPHPExcel->getActiveSheet() ->getHeaderFooter() ->setOddHeader($header);
    $objPHPExcel->getActiveSheet() ->getHeaderFooter() ->setOddFooter($footer);
    //Printer page breaks
    //$objPHPExcel->getActiveSheet() ->setBreak( 'A5' , PHPExcel_Worksheet::BREAK_ROW );  //Salto
    //Showing grid lines:
    $objPHPExcel->getActiveSheet() ->setShowGridlines(true);
    //Setting rows/columns to repeat at the top/left of each page
    $objPHPExcel->getActiveSheet() ->getPageSetup() ->setRowsToRepeatAtTopByStartAndEnd(1, 5);
    //Setting the print area:
    //$objPHPExcel->getActiveSheet() ->getPageSetup() ->setPrintArea('A1:E5,G4:M20'); //Cabecera creada repeticion 
    $objPHPExcel->getProperties()->setCreator("IJCP")
                         ->setLastModifiedBy("IJCP")
                         ->setTitle($reporte_title)
                         ->setSubject($reporte_title)
                         ->setDescription("Reporte desde la aplicación Recaudacion DirisLimaNorte")
                         ->setKeywords("office 2007 openxml php")
                         ->setCategory("Reportes");
/*    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');*/
/*    header('Content-Disposition: attachment;filename="'.$file.'"');*/
/*    header('Cache-Control: max-age=0');*/
/*    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');*/
/*    $objWriter->save('php://output');*/

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$file.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}