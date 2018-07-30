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
    $file='Reporte_Consolidado_Informacion_'.$h.'.xls';
    $header='&L&BFecha de consulta: '.$h;
    $footer='&L&B@DirisLimaNorte - http://app1.dirislimanorte.gob.pe/recaudacion';
    $desde = 'DESDE : ';
    $hasta = 'HASTA :';
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
    $title = array(
        'Renaes',
        'Establecimiento',
        'Total General',
        'Total RDR',
        'Total Sismed',
        'VENTA DE BIENES',
        'ALIMENTOS Y BEBIDAS',
        'FARMACIA',
        'VTA. DE BASES PARA LICITACION PUBLICA,CONCURSO PUBLICO Y OTROS',
        'DERECHOS Y TASAS ADMINISTRATIVOS',
        'AUTORIZACION, INSPECCION Y CONTROL SANITARIO',
        'EXAMEN MEDICO',
        'CERTIFICADOS',
        'CARNETS Y/O TARJETAS DE ATENCION',
        'CONTROL CANINO',
        'OTROS DERECHOS ADMINISTRATIVOS DE SALUD',
        'VENTA DE SERVICIOS',
        'ATENCION MEDICA',
        'ATENCION DENTAL',
        'EXAMEN PSICOLOGICO Y/O PSIQUIATRICA',
        'SERVICIO DE EMERGENCIA',
        'CIRUGIA',
        'HOSPITALIZACION',
        'SERVICIO DE TOPICO',
        'OTROS SERVICIOS MEDICOS - ASISTENC.',
        'EXAMENES DE LABORATORIO',
        'ELECTROCARDIOGRAMA',
        'DIAGNOSTICO POR IMÁGENES',
        'FISIOTERAPIA',
        'OTROS SERVICIOS DE SALUD',
        'SERVICIOS FUNERARIOS Y CEMENTERIOS',
        'CUENTAS POR COBRAR DIVERSAS',
        'MULTAS A ESTABLECIMIENTOS, FARMACIAS Y OTROS',
        'OTRAS MULTAS');

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
    $_Report05 = Reportes::ReporteRecDeposito($tipo_recaudacion,$tipo_nivel,$establecimiento,$distrito,$date1,$date2);
    //var_dump($_Report05);
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
    $objPHPExcel->getActiveSheet()->setCellValue('B6', $title[1]);
    $objPHPExcel->getActiveSheet()->setCellValue('C6', $title[2]);
    $objPHPExcel->getActiveSheet()->setCellValue('D6', $title[3]);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', $title[4]);
    $objPHPExcel->getActiveSheet()->setCellValue('F6', $title[5]);
    $objPHPExcel->getActiveSheet()->setCellValue('G6', $title[6]);
    $objPHPExcel->getActiveSheet()->setCellValue('H6', $title[7]);
    $objPHPExcel->getActiveSheet()->setCellValue('I6', $title[8]);
    $objPHPExcel->getActiveSheet()->setCellValue('J6', $title[9]);
    $objPHPExcel->getActiveSheet()->setCellValue('K6', $title[10]);
    $objPHPExcel->getActiveSheet()->setCellValue('L6', $title[11]);
    $objPHPExcel->getActiveSheet()->setCellValue('M6', $title[12]);
    $objPHPExcel->getActiveSheet()->setCellValue('N6', $title[13]);
    $objPHPExcel->getActiveSheet()->setCellValue('O6', $title[14]);
    $objPHPExcel->getActiveSheet()->setCellValue('P6', $title[15]);
    $objPHPExcel->getActiveSheet()->setCellValue('Q6', $title[16]);
    $objPHPExcel->getActiveSheet()->setCellValue('R6', $title[17]);
    $objPHPExcel->getActiveSheet()->setCellValue('S6', $title[18]);
    $objPHPExcel->getActiveSheet()->setCellValue('T6', $title[19]);
    $objPHPExcel->getActiveSheet()->setCellValue('U6', $title[20]);
    $objPHPExcel->getActiveSheet()->setCellValue('V6', $title[21]);
    $objPHPExcel->getActiveSheet()->setCellValue('W6', $title[22]);
    $objPHPExcel->getActiveSheet()->setCellValue('X6', $title[23]);
    $objPHPExcel->getActiveSheet()->setCellValue('Y6', $title[24]);
    $objPHPExcel->getActiveSheet()->setCellValue('Z6', $title[25]);
    $objPHPExcel->getActiveSheet()->setCellValue('AA6', $title[26]);
    $objPHPExcel->getActiveSheet()->setCellValue('AB6', $title[27]);
    $objPHPExcel->getActiveSheet()->setCellValue('AC6', $title[28]);
    $objPHPExcel->getActiveSheet()->setCellValue('AD6', $title[29]);
    $objPHPExcel->getActiveSheet()->setCellValue('AE6', $title[30]);
    $objPHPExcel->getActiveSheet()->setCellValue('AF6', $title[31]);
    $objPHPExcel->getActiveSheet()->setCellValue('AG6', $title[32]);
    $objPHPExcel->getActiveSheet()->setCellValue('AH6', $title[33]);

    $objPHPExcel->getActiveSheet()->getStyle('A6:AH6')->applyFromArray($borders_center);    
    

    if(!empty($_Report05)){
/*
      $SUMA1=0;
      $SUMA2=0;
      $SUMA3=0;
      $SUMA4=0;
      foreach ($_Report05 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='1'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA1 += $LCLAS_MONTO1;}
      foreach ($_Report05 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='7'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA2 += $LCLAS_MONTO1;}
      foreach ($_Report05 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='26'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA3 += $LCLAS_MONTO1;}
      foreach ($_Report05 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='73'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA4 += $LCLAS_MONTO1;}

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

*/

/*
      $objPHPExcel->getActiveSheet()->setCellValue('A8', '1201');
      $objPHPExcel->getActiveSheet()->setCellValue('B8', 'CUENTAS POR COBRAR');
      $objPHPExcel->getActiveSheet()->setCellValue('F8', $SUMA);
      $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('B8:D8');
      

      $objPHPExcel->getActiveSheet()->setCellValue('A9', '1201.03');
      $objPHPExcel->getActiveSheet()->setCellValue('B9', 'VENTA DE BIENES Y SERVICIOS Y DERECHOS ADMINISTRATIVOS');
      $objPHPExcel->getActiveSheet()->setCellValue('E9', $SUBTOTAL1);
      $objPHPExcel->setActiveSheetIndex(0)->mergeCellS('B9:D9');
      
      $objPHPExcel->getActiveSheet()->getStyle('A8:F9')->applyFromArray($borders_center);
*/

        foreach ($_Report05 as $key => $value) {
          $i=$key+7;
          $COD_A = $value[0];
          $COD_B = $value[1];
          $COD_C = $value[2];
          $COD_D = $value[3];
          $COD_E = $value[4];
          $COD_F = $value[5];
          $COD_G = $value[6];
          $COD_H = $value[7];
          $COD_I = $value[8];
          $COD_J = $value[9];
          $COD_K = $value[10];
          $COD_L = $value[11];
          $COD_M = $value[12];
          $COD_N = $value[13];
          $COD_O = $value[14];
          $COD_P = $value[15];
          $COD_Q = $value[16];
          $COD_R = $value[17];
          $COD_S = $value[18];
          $COD_T = $value[19];
          $COD_U = $value[20];
          $COD_V = $value[21];
          $COD_W = $value[22];
          $COD_X = $value[23];
          $COD_Y = $value[24];
          $COD_Z = $value[25];
          $COD_AA = $value[26];
          $COD_AB = $value[27];
          $COD_AC = $value[28];
          $COD_AD = $value[29];
          $COD_AE = $value[30];
          $COD_AF = $value[31];
          $COD_AG = $value[32];
          $COD_AH = $value[33];

          
          $celdaA='A'.$i;
          $celdaB='B'.$i;
          $celdaC='C'.$i;
          $celdaD='D'.$i;
          $celdaE='E'.$i;
          $celdaF='F'.$i;
          $celdaG='G'.$i;
          $celdaH='H'.$i;
          $celdaI='I'.$i;
          $celdaJ='J'.$i;
          $celdaK='K'.$i;       
          $celdaL='L'.$i;
          $celdaM='M'.$i;
          $celdaN='N'.$i;
          $celdaO='O'.$i;
          $celdaP='P'.$i;
          $celdaQ='Q'.$i;
          $celdaR='R'.$i;
          $celdaS='S'.$i;
          $celdaT='T'.$i;
          $celdaU='U'.$i;
          $celdaV='V'.$i;
          $celdaW='W'.$i;
          $celdaX='X'.$i;
          $celdaY='Y'.$i;
          $celdaZ='Z'.$i;
          $celdaAA='AA'.$i;
          $celdaAB='AB'.$i;
          $celdaAC='AC'.$i;
          $celdaAD='AD'.$i;
          $celdaAE='AE'.$i;
          $celdaAF='AF'.$i;
          $celdaAG='AG'.$i;
          $celdaAH='AH'.$i;

        $objPHPExcel->getActiveSheet()->setCellValue($celdaA, $COD_A);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaB, $COD_B);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaC, $COD_C);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaD, $COD_D);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaE, $COD_E);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaF, $COD_F);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaG, $COD_G);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaH, $COD_H);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaI, $COD_I);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaJ, $COD_J);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaK, $COD_K);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaL, $COD_L);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaM, $COD_M);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaN, $COD_N);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaO, $COD_O);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaP, $COD_P);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaQ, $COD_Q);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaR, $COD_R);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaS, $COD_S);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaT, $COD_T);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaU, $COD_U);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaV, $COD_V);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaW, $COD_W);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaX, $COD_X);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaY, $COD_Y);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaZ, $COD_Z);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAA, $COD_AA);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAB, $COD_AB);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAC, $COD_AC);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAD, $COD_AD);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAE, $COD_AE);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAF, $COD_AF);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAG, $COD_AG);
        $objPHPExcel->getActiveSheet()->setCellValue($celdaAH, $COD_AH);

        $objPHPExcel->getActiveSheet()->getStyle($celdaA)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaB)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaC)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaD)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaE)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaF)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaG)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaH)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaI)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaJ)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaK)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaL)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaM)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaN)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaO)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaP)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaQ)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaR)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaS)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaT)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaU)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaV)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaW)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaX)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaY)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaZ)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAA)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAB)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAC)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAD)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAE)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAF)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAG)->applyFromArray($borders_center);
        $objPHPExcel->getActiveSheet()->getStyle($celdaAH)->applyFromArray($borders_center);


        }
    }else{
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'No se encontraron resultados para la bùsqueda');
    }


    //7,5 X PX
    //https://stackoverflow.com/questions/29026645/how-to-use-print-ready-functionality-in-phpexcel-library
    $objPHPExcel->getActiveSheet() ->setTitle('Reportes');
    //
    $objPHPExcel->getDefaultStyle()->applyFromArray($body);
    $objPHPExcel->getActiveSheet()->getStyle("A4:AH6")->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle("A4:AH6")->applyFromArray($titulo);
    $objPHPExcel->getActiveSheet()->getStyle("A6:AH6")->applyFromArray($cabecera);

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


    $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("M")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("N")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("O")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("P")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("Q")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("R")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("S")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("T")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("U")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("V")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("W")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("X")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("Y")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("Z")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AA")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AB")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AC")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AD")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AE")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AF")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AG")->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension("AH")->setWidth(20);



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