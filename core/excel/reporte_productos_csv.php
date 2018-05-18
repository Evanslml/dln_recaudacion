<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");



$sql="SELECT * FROM  c_productos";

$result = mysqli_query($con,$sql) or die(mysqli_error());

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once "PHPExcel.php";

/** CACHE PARA DESCARGAS PESADAS**/
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
$cacheSettings = array( 'memoryCacheSize' => '512MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
/****/

$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);


$objPHPExcel->setActiveSheetIndex(0)
 /*           ->setCellValue('A1', 'CODIGO')
            ->setCellValue('B1', 'STOCK')
            ->setCellValue('C1', 'PRECIO')*/;


//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 1; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['cod_generado']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['stock']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['precio_venta']);
    $rowCount++; 
} 

/*
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('some_excel_file.xlsx'); 
*/


$objPHPExcel->getActiveSheet()->setTitle('PRODUCTOS CARLONCHOSTORE');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="PRODUCTOS.xls"');
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
