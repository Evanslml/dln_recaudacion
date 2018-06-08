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
    $file='Boleta_Depositada_Diaria_'.$h.'.xlsx';
    $header='&L&BFecha de consulta: '.$h;
    $footer='&L&B@DirisLimaNorte - http://app1.dirislimanorte.gob.pe/recaudacion';
    $reporte_title = 'REPORTE DE BOLETAS DEPOSITADAS DIARIAS';
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
    $title = array('F. Rec.','Tipo','Renipres','Establecimiento','Voucher','Importe','F. Dep.');

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
    $_Report01 = Reportes::ReporteBolDepDiaria($tipo_recaudacion,$tipo_nivel,$establecimiento,$distrito,$date1,$date2);
    //var_dump($_Report01);
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
            'size'  => 9,
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
            'size'  => 9,
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
            'size'  => 9,
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
    $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('B6', $title[1]);
    $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('C6', $title[2]);
    $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('D6', $title[3]);
    $objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', $title[4]);
    $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('F6', $title[5]);
    $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($borders_center);
    $objPHPExcel->getActiveSheet()->setCellValue('G6', $title[6]);
    $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($borders_center);


    if(!empty($_Report01)){

        foreach ($_Report01 as $key => $value) {
        $n=$key;
        $i=$key+7;
        $IdFormulario= $value[1];
        $anio=substr($IdFormulario,4,2);
        $mes=substr($IdFormulario,6,2);
        $dia=substr($IdFormulario,8,2);
        $Fecha_recaudacion = $dia.'-'.$mes.'-'.$anio;
        $celdaA='A'.$i;
        $celdaB='B'.$i;
        $celdaC='C'.$i;
        $celdaD='D'.$i;
        $celdaE='E'.$i;
        $celdaF='F'.$i;
        $celdaG='G'.$i;

        $objPHPExcel->getActiveSheet()->setCellValue($celdaA, $Fecha_recaudacion);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaB, $_Report01[$n][0]);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaC, $_Report01[$n][9]);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $_Report01[$n][3]);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaE, $_Report01[$n][4]);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaF, $_Report01[$n][6]);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaG, $_Report01[$n][5]);

        $objPHPExcel->getActiveSheet()->getStyle($celdaA)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaB)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaC)->applyFromArray($borders_left);
        $objPHPExcel->getActiveSheet()->getStyle($celdaD)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaE)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaF)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaG)->applyFromArray($borders_center);
        }
    }else{
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'No se encontraron resultados para la bùsqueda');
    }


    //7,5 X PX
    //https://stackoverflow.com/questions/29026645/how-to-use-print-ready-functionality-in-phpexcel-library
    $objPHPExcel->getActiveSheet() ->setTitle('Reportes');
    //
    $objPHPExcel->getDefaultStyle()->applyFromArray($body);
    $objPHPExcel->getActiveSheet()->getStyle("A4:G4")->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle("A4:G4")->applyFromArray($titulo);
    $objPHPExcel->getActiveSheet()->getStyle("A6:G6")->applyFromArray($cabecera);

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
    $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(11); //70
    $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(11); //70
    $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(11.5); //210
    $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(35); //70
    $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(10); //70
    $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(10); //105
    $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(10); //105
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
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$file.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');


}