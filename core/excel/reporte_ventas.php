<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

        $f_inicio=$_GET['f_inicio'];
        $f_fin=$_GET['f_fin'];
        $id_cliente=$_GET['id_cliente'];
        $id_producto=$_GET['id_producto'];
        $tipo_pago=$_GET['tipo_pago'];
        $id_usuario=$_GET['id_usuario'];


        $f_inicio_f = date("Y-m-d", strtotime($f_inicio));
        //$f_inicio_f = $f_inicio;
        
        $f_fin_r = date("Y-m-d", strtotime($f_fin));
        $f_fin_f = date('Y-m-d', strtotime($f_fin_r) + 86400);
        //$f_fin_f = strtotime (strtotime ( $f_fin_r ));
        //$f_fin_f = date("Y-m-d", strtotime($f_fin_f) );
     
         $sCampos = "A.fecha_factura, A.numero_factura, C.dni, C.nombre_completo, D.cod_generado, D.descripcion_compuesta, E.pago, B.cantidad, B.subt_neto, F.firstname, F.lastname";
         $sTable = "c_ventas A,  c_venta_detalles B, c_clientes C, c_productos D, c_tipo_pago E, c_usuarios F";
         $sWhere = "";
         $sWhere.=" WHERE (A.fecha_factura BETWEEN '$f_inicio_f' AND '$f_fin_f') and A.id_cliente = C.id and B.numero_factura = A.numero_factura and D.id_producto = B.id_producto and E.id=A.condiciones and A.id_vendedor = F.user_id ";

         if($id_cliente != "0"){
         $sWhere.=" and A.id_cliente='$id_cliente'";
         }

         if($id_producto != "0"){
         $sWhere.=" and B.id_producto='$id_producto'";  
         }

         if($tipo_pago != "0"){
         $sWhere.=" and A.condiciones='$tipo_pago'";    
         }

         if($id_usuario != "0"){
         $sWhere.=" and A.id_vendedor='$id_usuario'";   
         }
    
        $sWhere.=" order by A.numero_factura desc";

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
            ->setCellValue('A1', 'TRANSACCION')
            ->setCellValue('B1', 'FECHA')
            ->setCellValue('C1', 'DNI')
            ->setCellValue('D1', 'CLIENTE')
            ->setCellValue('E1', 'CODIGO')
            ->setCellValue('F1', 'VENDEDOR')
            ->setCellValue('G1', 'NOMBRE DE PRODUCTO')
            ->setCellValue('H1', 'PAGO')
            ->setCellValue('I1', 'CANTIDAD')
            ->setCellValue('J1', 'SOLES');

//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['numero_factura']); 
    $fecha_factura=$row['fecha_factura']; $fecha_factura_f=date("d/m/Y", strtotime($fecha_factura));
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $fecha_factura_f); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['dni']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['nombre_completo']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['cod_generado']); 
    $nombres=$row['firstname']; $apellidos=$row['lastname'];
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $nombres.' '.$apellidos); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['descripcion_compuesta']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['pago']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['cantidad']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $row['subt_neto']); 
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

$objPHPExcel->getActiveSheet()->setTitle('Reporte ventas');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_ventas.xls"');
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
