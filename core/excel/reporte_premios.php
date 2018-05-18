<?php

	include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

        $f_inicio=$_GET['f_inicio'];
        $f_fin=$_GET['f_fin'];
        $id_cliente=$_GET['id_cliente'];
        $id_usuario=$_GET['id_usuario'];
        $id_estado=$_GET['id_estado'];


        $f_inicio_f = date("Y-m-d", strtotime($f_inicio));
        //$f_inicio_f = $f_inicio;
        
        $f_fin_r = date("Y-m-d", strtotime($f_fin));
        $f_fin_f = date('Y-m-d', strtotime($f_fin_r) + 86400);

       $sCampos = "*";
         $sTable = "
(SELECT 
A.transaccion, '----------' as nombres, '----------'as dni , '----------' as linea,'canje premio' as torneo,'canje premio' as puesto , A.fecha, CASE WHEN A.tipo_pago != 0 then A.total ELSE '0' END as efectivo, CASE WHEN A.tipo_pago = 0 then A.cant_total ELSE '0' END as boster, A.id_cliente as idcliente, A.id_usuario as idusuario
FROM 
c_prem_canje A, c_premios_acumulado B, c_clientes C
where 
A.id_cliente = B.id_cliente
and B.id_cliente = C.id

UNION ALL

SELECT 'PREMIO', F.nombre_completo, F.dni, E.linea, G.torneo, D.id_puesto, D.fecha, D.premio_efectivo, D.premio_booster, F.id as idcliente, D.id_usuario
FROM c_premios D, c_p_linea E, c_clientes F, c_pre_torneo G
WHERE D.id_cliente = F.id
and E.id = D.id_linea
and G.id = D.id_torneo    

UNION ALL

select 'TOTAL', X.nombre_completo,'----------','----------','----------','----------',CURDATE(),(SUM(X.INEFE) - SUM(X.EGEFE)) as Efectivo, (SUM(X.INBOO) - SUM(X.EGEBOO)) as Booster,X.id_cliente, X.id_usuario FROM
(
SELECT H.id_cliente, SUM(H.premio_efectivo) as INEFE, SUM(H.premio_booster) as INBOO,'' as EGEFE,'' as EGEBOO, H.id_usuario, J.nombre_completo
FROM c_premios H, c_clientes J
WHERE H.id_cliente = J.id
group by H.id_cliente,H.id_usuario, J.nombre_completo

UNION ALL 

SELECT I.id_cliente,'','', CASE WHEN I.tipo_pago != 0 then SUM(I.total) ELSE '0' END EGEEFE, CASE WHEN I.tipo_pago = 0 then SUM(I.cant_total) ELSE '0' END as EGEBOO, I.id_usuario , K.nombre_completo
FROM c_prem_canje I, c_clientes K
where I.id_cliente = k.id
group by I.id_cliente,I.id_usuario, I.tipo_pago, K.nombre_completo

) X
GROUP by X.id_cliente,X.id_usuario,X.nombre_completo
) Z
         ";
         $sWhere = "";
         $sWhere.=" WHERE (z.fecha BETWEEN '$f_inicio_f' AND '$f_fin_f') ";

         if($id_usuario != 0 ){
         $sWhere.=" and z.idusuario='$id_usuario'"; 
         }

         if(strlen($id_cliente) != 0 ){
         $sWhere.=" and z.idcliente ='$id_cliente'";    
         }
/*
         switch ($id_estado) {
            case '1': //Pendiente
                $sWhere.=" and A.estado= '1' "; 
                break;
            case '2': //Cerrado
                $sWhere.=" and A.estado= '0' "; 
                break;
         }

*/  
        $sWhere.=" ORDER BY z.idcliente, z.transaccion";

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
            ->setCellValue('A1', 'TRANSACCION')
            ->setCellValue('B1', 'NOMBRES')
            ->setCellValue('C1', 'DNI')
            ->setCellValue('D1', 'LINEA')
            ->setCellValue('E1', 'TORNEO')
            ->setCellValue('F1', 'PUESTO')
            ->setCellValue('G1', 'FECHA')
            ->setCellValue('H1', 'EFECTIVO')
            ->setCellValue('I1', 'BOOSTER');


//https://stackoverflow.com/questions/12611148/how-to-export-data-to-an-excel-file-using-phpexcel

$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 2; 
while($row = mysqli_fetch_array($result)){ 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['transaccion']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['nombres']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['dni']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['linea']);  
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['torneo']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['puesto']); 
    $fecha=$row['fecha']; $fecha_f=date("d/m/Y", strtotime($fecha));
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $fecha_f); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['efectivo']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['boster']); 
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

$objPHPExcel->getActiveSheet()->setTitle('Reporte Premios');

$objPHPExcel->getProperties()->setCreator("IJCP")
							 ->setLastModifiedBy("IJCP")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_premios.xls"');
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
