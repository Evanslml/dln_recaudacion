<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

        $f_inicio=$_GET['f_inicio'];
		$f_fin=$_GET['f_fin'];
		$id_usuario=$_GET['id_usuario'];
		$tipo_pago=$_GET['tipo_pago'];

		$f_inicio_f = date("Y-m-d", strtotime($f_inicio));
		$f_fin_r = date("Y-m-d", strtotime($f_fin));
		$f_fin_f = date('Y-m-d', strtotime($f_fin_r) + 86400);
     
         $sCampos = "A.id, A.fecha, A.id_tipo, A.num_doc, B.concepto, A.monto, C.pago, D.concepto_destino";
		 $sTable = "c_caja A, c_ca_concepto B, c_tipo_pago C, c_ca_flujo_destino D";
		 $sWhere = "";
		 $sWhere.=" WHERE 
		 A.id_concepto = B.id_concepto and (A.fecha BETWEEN '$f_inicio_f' AND '$f_fin_f') 
		 and A.id_tipo_pago= C.id
		 and D.id_destino = A.Flujo_destino
		 ";
	
		if( $id_usuario != 0 ){
		$sWhere.=" and A.id_usuario='$id_usuario'";	
		}

		if( $tipo_pago != 0 ){
		
			switch ($tipo_pago) {
				case 1:
					$sWhere.=" and A.id_tipo_pago in ('9','10','8','4','7')";	
					break;
				case 2:
					$sWhere.=" and A.id_tipo_pago in ('2')";	
					break;
				case 3:
					$sWhere.=" and A.id_tipo_pago in ('3')";	
					break;
				case 11:
					$sWhere.=" and A.id_tipo_pago in ('4','11')";	
					break;
			}
		}

		$sWhere.=" order by A.fecha desc";

$sql="SELECT $sCampos FROM  $sTable $sWhere";

$result = mysqli_query($con,$sql) or die(mysqli_error());

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once "PHPExcel.php";

$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'FECHA')
            ->setCellValue('C1', 'TRANSACCION')
            ->setCellValue('D1', 'NUMERO DE TRANSACCION')
            ->setCellValue('E1', 'INGRESO - SALIDA')
            ->setCellValue('F1', 'COMCEPTO')
            ->setCellValue('G1', 'PAGO')
            ->setCellValue('H1', 'MONTO')
            ->setCellValue('I1', 'DESTINO');

//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$row['id']); 
    $fecha=$row['fecha']; $fecha_f=date("d/m/Y", strtotime($fecha));
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $fecha_f);
    $transaccion = $row['num_doc'];	
    if(substr($transaccion,0,4) == 'TGRT'){
						$trans1 = 'TRANSFERENCIA GRATUITA';
					}else if(substr($transaccion,0,4) == 'FLJC'){
						$trans1 = 'FLUJO DE CAJA';
					}else if(substr($transaccion,0,4) == 'PVSD'){
						$trans1 = 'PREVENTA';
					} else if(substr($transaccion,0,4) == 'TSAL'){
						$trans1 = 'TRANSFORMACION SALIDA';
					} else if(substr($transaccion,0,4) == 'TING'){
						$trans1 = 'TRANSFORMACION INGESO';
					} else if(substr($transaccion,0,1) == 'F'){
						$trans1 = 'VENTAS';
					} else if(substr($transaccion,0,1) == 'C'){
						$trans1 = 'COMPRAS';
					} 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $trans1); 
    $id_tipo=$row['id_tipo'];
		if($id_tipo =='1'){
						$I_E= 'INGRESO';
					} else{
						$I_E= 'EGRESO';
					}
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['num_doc']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $I_E); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['concepto']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['pago']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['monto']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['concepto_destino']); 
    $rowCount++; 
} 

/*
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('some_excel_file.xlsx'); 
*/


/*BORDER*/
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );

$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);

/*BACKGROUND*/
function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}

cellColor('A1', 'ffff08');
cellColor('B1', 'ffff08');
cellColor('C1', 'ffff08');
cellColor('D1', 'ffff08');
cellColor('E1', 'ffff08');
cellColor('F1', 'ffff08');
cellColor('G1', 'ffff08');
cellColor('H1', 'ffff08');
cellColor('I1', 'ffff08');


/*CENTER*/
$center = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

$objPHPExcel->getDefaultStyle()->applyFromArray($center);

/*ESTILOS*/
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '555'),
        'size'  => 11,
        'name'  => 'Calibri'
    ));

$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($center);

$objPHPExcel->getActiveSheet()->setTitle('Reporte Flujo de caja');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_caja.xls"');
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
