<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

        $f_inicio=$_GET['f_inicio'];
        $f_fin=$_GET['f_fin'];
        $id_producto=$_GET['id_producto'];
        $transaccion=$_GET['transaccion'];


        $f_inicio_f = date("Y-m-d", strtotime($f_inicio));
        $f_fin_r = date("Y-m-d", strtotime($f_fin));
        $f_fin_f = date('Y-m-d', strtotime($f_fin_r) + 86400);

         $sCampos = "A.id, A.fecha,
            CASE
                WHEN (get_id_operacion(A.transaccion)='1') then 'TSAL1'
                WHEN (get_id_operacion(A.transaccion)='2') then 'TSAL2'
                WHEN (get_id_operacion(A.transaccion)='3') then 'TING3'
                WHEN (get_id_operacion(A.transaccion)='4') then 'TSAL4'
                WHEN (get_id_operacion(A.transaccion)='5') then 'TING5'
                ELSE A.transaccion
            end as cod_transaccion
         , A.transaccion, B.cod_empresa, B.descripcion, A.stock, A.stock_final, A.cantidad";
         $sTable = "c_stock_detalles A,c_productos B";
         $sWhere = "";
         $sWhere.=" WHERE (A.fecha BETWEEN '$f_inicio_f' AND '$f_fin_f') and A.id_producto=B.id_producto";

         if($id_producto != "0"){
         $sWhere.=" and A.id_producto='$id_producto'";  
         }

         switch ($transaccion) {
            case 1: //VENTA
                $sWhere.=" and A.transaccion LIKE 'F%'";
                break;
            case 2: //PREVENTA
                $sWhere.=" and A.transaccion LIKE 'PVSD%'";
                break;
            case 3: //COMPRAS
                $sWhere.=" and A.transaccion LIKE 'C%'";
                break;
            case 4: //PREMIOS
                $sWhere.=" and A.transaccion LIKE 'TGRT%'";
                break;
            case 5: //AJUSTES
                $sWhere.=" and (A.transaccion LIKE 'TSAL%' OR A.Transaccion LIKE 'TING%') ";
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

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'FECHA')
            ->setCellValue('C1', 'TRANSACCION')
            ->setCellValue('D1', 'NUMERO DE TRANSACCION')
            ->setCellValue('E1', 'INGRESO-SALIDA')
            ->setCellValue('F1', 'CODIGO DE PRODUCTO')
            ->setCellValue('G1', 'NOMBRE DE PRODUCTO')
            ->setCellValue('H1', 'CANTIDAD DE MOVIMIENTO')
            ->setCellValue('I1', 'CANTIDAD FINAL');


//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['id']);
    $fecha=$row['fecha']; $fecha_f=date("d/m/Y", strtotime($fecha)); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $fecha_f); 
    $transaccion= $row['transaccion'];  
    $cod_transaccion= $row['cod_transaccion'];  
                    if(substr($cod_transaccion,0,4) == 'TGRT'){
                        $trans1 = 'TRANSFERENCIA GRATUITA';
                    }else if(substr($cod_transaccion,0,4) == 'PVSD'){
                        $trans1 = 'PREVENTA';
                    } else if(substr($cod_transaccion,0,5) == 'TSAL1'){
                        $trans1 = 'AJUSTE DE SALIDA';
                    } else if(substr($cod_transaccion,0,5) == 'TSAL2'){
                        $trans1 = 'TRANSFERENCIA GRATUITA';
                    } else if(substr($cod_transaccion,0,5) == 'TSAL4'){
                        $trans1 = 'SALIDA POR TRANSFORMACION';
                    } else if(substr($cod_transaccion,0,5) == 'TING3'){
                        $trans1 = 'INGESO POR TRANSFORMACION';
                    } else if(substr($cod_transaccion,0,5) == 'TING5'){
                        $trans1 = 'INGRESO POR AJUSTE';
                    } else if(substr($cod_transaccion,0,1) == 'F'){
                        $trans1 = 'VENTAS';
                    } else if(substr($cod_transaccion,0,1) == 'C'){
                        $trans1 = 'COMPRAS';
                    }
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $trans1);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $transaccion);  
    $stocki= intval($row['stock']);$stockf= intval($row['stock_final']);
    if($stocki < $stockf){
                        $I_E = 'INGRESO';
                    } else{
                        $I_E = 'EGRESO';
                    }
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $I_E); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['cod_empresa']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['descripcion']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['cantidad']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['stock_final']); 
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

$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($borders);

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

$objPHPExcel->getActiveSheet()->setTitle('Reporte Stock');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_stock.xls"');
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
