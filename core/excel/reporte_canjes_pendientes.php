<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

		$f_inicio=$_GET['f_inicio'];
		$f_fin=$_GET['f_fin'];
		$id_producto=$_GET['id_producto'];
		$id_usuario=$_GET['id_usuario'];
		$id_estado=$_GET['id_estado'];
		$id_cliente=$_GET['id_cliente'];


		$f_inicio_f = date("Y-m-d", strtotime($f_inicio));
		//$f_inicio_f = $f_inicio;
		
		$f_fin_r = date("Y-m-d", strtotime($f_fin));
		$f_fin_f = date('Y-m-d', strtotime($f_fin_r) + 86400);
		//$f_fin_f = strtotime (strtotime ( $f_fin_r ));
		//$f_fin_f = date("Y-m-d", strtotime($f_fin_f) );
	 
		 $sCampos = "A.fecha, A.id_cliente, C.nombre_completo, C.dni, A.id_preventa, D.descripcion_compuesta, B.cantidad, B.sub_neto, 
					case 
						when (A.estado=0) then B.sub_neto
					    else B.adelanto
					END as adelanto, 
					CASE 
						when (A.estado=0) then '0'
					    else (B.sub_neto - B.adelanto)
					END AS saldo, 
					CASE 
						WHEN (A.estado=0) then 'Cerrado'
					    WHEN (A.estado=1) then 'Pendiente'
					end as estado";
		 $sTable = "c_preventas A, c_preventa_detalles B, c_clientes C, c_productos D";
		 $sWhere = "";
		 $sWhere.=" WHERE (A.fecha BETWEEN '$f_inicio_f' AND '$f_fin_f') 
		 AND A.id_preventa = B.id_preventa 
		 AND C.id = A.id_cliente
		 AND B.id_producto = D.id_producto
		 ";

		 if($id_usuario != 0 ){
		 $sWhere.=" and A.id_vendedor='$id_usuario'";	
		 }

		 if(strlen($id_cliente) != 0 ){
		 $sWhere.=" and C.id ='$id_cliente'";	
		 }

		 if(strlen($id_producto) != 0 ){
		 $sWhere.=" and B.id_producto='$id_producto'";	
		 }

		 switch ($id_estado) {
		 	case '1': //Pendiente
		 		$sWhere.=" and A.estado= '1' ";	
		 		break;
		 	case '2': //Cerrado
		 		$sWhere.=" and A.estado= '0' ";	
		 		break;
		 }

	
		$sWhere.=" order by A.id desc";
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
$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'FECHA')
            ->setCellValue('B1', 'NOMBRES')
            ->setCellValue('C1', 'DNI')
            ->setCellValue('D1', 'DOCUMENTO')
            ->setCellValue('E1', 'PRODUCTO')
            ->setCellValue('F1', 'CANTIDAD')
            ->setCellValue('G1', 'ESTADO')
            ->setCellValue('H1', 'PRECIO')
            ->setCellValue('I1', 'ADELANTO')
            ->setCellValue('J1', 'SALDO');

//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 

	$fecha=$row['fecha'];
	$fecha_f=date("d/m/Y", strtotime($fecha));
	$nombre_completo=$row['nombre_completo'];
	$dni=$row['dni'];
	$id_preventa=$row['id_preventa'];
	$descripcion_compuesta=$row['descripcion_compuesta'];
	$cantidad=$row['cantidad'];
	$estado=$row['estado'];
	$subt_neto=$row['sub_neto'];
	$adelanto=$row['adelanto'];
	$saldo=$row['saldo'];

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $fecha_f); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $nombre_completo);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $dni); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $id_preventa); 
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $descripcion_compuesta); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $cantidad); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $estado); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $subt_neto); 
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $adelanto); 
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $saldo); 
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
cellColor('J1', 'ffff08');


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

$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($center);

$objPHPExcel->getActiveSheet()->setTitle('Reporte canje pendiente');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_canje.xls"');
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
