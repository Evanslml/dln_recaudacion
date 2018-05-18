<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");


$id_producto=intval($_GET['id_producto']);

$sql="SELECT * FROM  c_productos WHERE id_producto='$id_producto' ";

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


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'NOMBRE DEL PRODUCTO')
            ->setCellValue('C1', 'CODIGO ARTICULO')
            ->setCellValue('D1', 'CODIGO EMPRESA')
            ->setCellValue('E1', 'STOCK')
            ->setCellValue('F1', 'VENTA')
            ->setCellValue('G1', 'COSTO')
            ->setCellValue('H1', 'CODIGO UNICO');


//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['id_producto']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['descripcion_compuesta']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['cod_articulo']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['cod_empresa']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['stock']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['precio_venta']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['precio_compra']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['id']); 
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

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($borders);

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

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($center);

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
