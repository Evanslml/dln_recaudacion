<style type="text/css">

table { vertical-align: top; }
tr    { vertical-align: top; font-size: 9px}
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
.tbl_total td, .tbl_detalle td {border-bottom: 1px solid #000; border-right: 1px solid #000; }
.tbl_total, .tbl_detalle {border-top: 1px solid #000; border-left: 1px solid #000; }

.tbl_detalle td, .tbl_total td{padding: 2px;}
</style>

<page backtop="2mm" backbottom="5mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "DirisLimaNorte "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
	<?php include("encabezado.php");?>
    <br>
    

	
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
		
		<tr>
			<td style="height: 25px"></td>
			<td style="height: 25px" colspan="2">NOMBRE DE ESTABLECIMIENTO <h5 style="margin:0; text-align: center"><?php echo $nombre_establecimiento; ?></h5></td>
			<td style="height: 25px">MES <h5 style="margin:0; text-align: center"><?php echo $mes;?></h5></td>
			<td style="height: 25px">DIA <h5 style="margin:0; text-align: center"><?php echo $dia;?></h5></td>
		</tr>
        <tr>
           <td style="width:4%;text-align: center;padding-top: 15px" rowspan="8">F<br>I<br>L<br>A</td>
		   <td style="width:10%;text-align: center;padding-top: 10px" rowspan="8"><b>MEF</b><br>MAESTRO CLASIFICADOR DE INGRESO </td>
		   <td style="width:70%;">FILA 1 (VENTA DE BIENES) ES LA SUMA DEL 2</td>
		   <td style="width:8%;text-align: center;padding-top: 15px" rowspan="7">CANT.</td>
		   <td style="width:8%;text-align: center;padding-top: 15px" rowspan="7">MONTO</td>
        </tr>
        <tr>
        	<td style="width:70%;">FILA 3 (VENTA DE PRODUCTOS DE SALUD) ES LA SUMA DEL 4</td>
        </tr> 
        <tr>
        	<td style="width:70%;">FILA 5 (VENTA DE OTROS BIENES) ES LA SUMA DEL 6</td>
        </tr> 
        <tr>
        	<td style="width:70%;">FILA 7 (DERECHOS Y TASAS ADMINISTRATIVOS) SUMA DEL 8 AL 25</td>
        </tr> 
        <tr>
        	<td style="width:70%;">FILA 26 (VENTA DE SERVICIOS) SUMA DEL 27 AL 70</td>
        </tr>
        <tr>
        	<td style="width:70%;">FILA 71 (OTROS INGRESOS POR PRESTACION DE SERVICIOS) ES LA SUMA DEL 72</td>
        </tr>
        <tr>
        	<td style="width:70%;">FILA 73 (MULTAS Y SANCIONES NO TRIBUTARIAS) ES LA SUMA DEL 74 AL 75</td>
        </tr> 
        <tr>
        	<td style="width:70%;">TOTAL GENERAL DEL DIA (1+3+5+7+26+71+73)</td>
        	<td style="width:8%;"><?php echo $cantidad_total;?></td>
		    <td style="width:8%; text-align: right"><?php echo 'S/. '. $monto_total;?></td>
        </tr>
	
			<?php 

			$cant_total=0;
			$mont_total=0.00;
			foreach ($query01 as $key => $value) {

                          $id= $key + 1;
                          $clasificador= $value[1];
                          $class_padre= $value[2];
                          $descripcion= $value[3];
                          $cantidad= $value[4];
                          $monto= $value[5];
                          $estado= $value[6];

                          

                          switch ($class_padre) {
                            case '0':
                            $cant_total += $cantidad;
                          	$mont_total += $monto;
                          	  echo '<tr>';
                              echo '<td style="width: 4%; text-align: left"><b>',$id,'</b></td>';
                              echo '<td style="width: 10%; text-align: center"><b>',$clasificador,'</b></td>';
                              echo '<td style="width: 70%; text-align: center"><b>',$descripcion,'</b></td>';
                              echo '<td style="width: 5%; text-align: left"><b>',$cantidad,'</b></td>';
                              echo '<td style="width: 8%; text-align: right"><b> S/. ',$monto,'</b></td>';
                              echo '</tr>';
                            break;

                            default:
                              if($estado =='0'){
                              	  echo '<tr>';
                              	  echo '<td style="width: 4%; text-align: left">',$id,'</td>';
	                              echo '<td style="width: 10%; text-align: left">',$clasificador,'</td>';
	                              echo '<td style="width: 70%; text-align: left">',$descripcion,'</td>';
	                              echo '<td style="width: 5%; text-align: left">',$cantidad,'</td>';
	                              echo '<td style="width: 8%; text-align: right"> S/. ',$monto,'</td>';
	                              echo '</tr>';
                              }else{
                              	  echo '<tr>';
                              	  echo '<td style="width: 4%; text-align: left">',$id,'</td>';
	                              echo '<td style="width: 10%; text-align: left">',$clasificador,'</td>';
	                              echo '<td style="width: 70%; text-align: left">',$descripcion,'</td>';
	                              echo '<td style="width: 5%; text-align: left">',$cantidad,'</td>';
	                              echo '<td style="width: 8%; text-align: right"> S/. ',$monto,'</td>';
	                              echo '</tr>';
                              }
                            break;

                          }

                          

                        }
			?>
        
    </table>
    
       <br>
		<table class="tbl_total" cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt">
			<tr>
				<td style="width: 14%; text-align: center;">SERIE</td>
				<td style="width: 20%; text-align: center">BOLETAS/RECIBOS</td>
				<td style="width: 16%; text-align: center;">VOUCHERS</td>
				<td style="width: 8%; text-align: center;">CANTIDAD</td>
				<td style="width: 8%; text-align: center;">MONTO</td>
				<td style="width: 34%"></td>
			</tr>
			<tr>
				<td style="padding-top: 10px">MEDICAMENTOS</td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $SISMED_BOLINI.' '.$SISMED_BOLFIN;?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $voucher_sismed?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $SISMED_CANT;?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $SISMED_MONTO;?></td>
				<td style="height: 45px;text-align: center;" rowspan="2"><br><br><hr>RESPONSABLE DE CAJA</td>
			</tr>
			<tr>
				<td style="padding-top: 10px;padding-left: 5px">R.D.R</td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $RDR_BOLINI.' '.$RDR_BOLFIN;?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $voucher_rdr;?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $RDR_CANT;?></td>
				<td style="padding-top: 10px;padding-left: 5px"><?php echo $RDR_MONTO;?></td>
			</tr>
			<tr>
				<td colspan="5"></td>
				<td style="height: 45px;text-align: center;"><br><br><hr>RESPONSABLE DEL ESTABLECIMIENTO</td>
			</tr>
		</table>


</page>

