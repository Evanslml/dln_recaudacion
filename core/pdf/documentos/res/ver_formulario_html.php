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

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
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
			<td style="height: 25px" colspan="2">NOMBRE DE ESTABLECIMIENTO <h5 style="margin:0; text-align: center"><?php echo $query03[0][1]?></h5></td>
			<td style="height: 25px">MES <h5 style="margin:0; text-align: center"><?php echo $query03[0][4]?></h5></td>
			<td style="height: 25px">DIA <h5 style="margin:0; text-align: center"><?php echo $query03[0][5]?></h5></td>
		</tr>
        <tr>
           <td style="width:4%;text-align: center;padding-top: 15px" rowspan="5">F<br>I<br>L<br>A</td>
		   <td style="width:10%;text-align: center;padding-top: 10px" rowspan="5"><b>MEF</b><br>MAESTRO CLASIFICADOR DE INGRESO </td>
		   <td style="width:70%;">FILA 1 (VENTA DE PRODUCTOS DE SALUD) ES LA SUMA DEL 2</td>
		   <td style="width:8%;text-align: center;padding-top: 15px" rowspan="4">CANT.</td>
		   <td style="width:8%;text-align: center;padding-top: 15px" rowspan="4">MONTO</td>
        </tr>
        <tr>
        	<td style="width:70%;">FILA 3 (OTROS) ES LA SUMA DEL 4</td>
        </tr> 
        <tr>
        	<td style="width:70%;">FILA 5 (TASAS) ES LA SUMA DEL 6+7+8+9+10+11+12+13+14</td>
        </tr> 
        <tr>
        	<td style="width:70%;">FILA 15 (SERVICIOS DE SALUD ES LA SUMA DEL 16 AL 41)</td>
        </tr> 
        <tr>
        	<td style="width:70%;">TOTAL GENERAL DEL DIA (1+3+5+15+42)</td>
        	<td style="width:8%;"><?php echo $query03[0][14]?></td>
		    <td style="width:8%; text-align: right"><?php echo 'S/. '.$query03[0][15]?></td>
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

                          echo '<tr>';

                          switch ($class_padre) {
                            case '0':
                            $cant_total += $cantidad;
                          	$mont_total += $monto;	
                              echo '<td style="width: 4%; text-align: left"><b>',$id,'</b></td>';
                              echo '<td style="width: 10%; text-align: left"><b>',$clasificador,'</b></td>';
                              echo '<td style="width: 70%; text-align: left"><b>',$descripcion,'</b></td>';
                              echo '<td style="width: 5%; text-align: left"><b>',$cantidad,'</b></td>';
                              echo '<td style="width: 8%; text-align: right"><b> S/. ',$monto,'</b></td>';
                            break;

                            default:
                              if($estado =='0'){
                              	  echo '<td style="width: 4%; text-align: left">',$id,'</td>';
	                              echo '<td style="width: 10%; text-align: left">',$clasificador,'</td>';
	                              echo '<td style="width: 70%; text-align: left">',$descripcion,'</td>';
	                              echo '<td style="width: 5%; text-align: left">',$cantidad,'</td>';
	                              echo '<td style="width: 8%; text-align: right"> S/. ',$monto,'</td>';
                              }else{
                              	  echo '<td style="width: 4%; text-align: left">',$id,'</td>';
	                              echo '<td style="width: 10%; text-align: left">',$clasificador,'</td>';
	                              echo '<td style="width: 70%; text-align: left">',$descripcion,'</td>';
	                              echo '<td style="width: 5%; text-align: left">',$cantidad,'</td>';
	                              echo '<td style="width: 8%; text-align: right"> S/. ',$monto,'</td>';
                              }
                            break;

                          }

                          echo '</tr>';
                        }
			?>
        
    </table>
    
       <br>
		<table class="tbl_total" cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt">
			<tr>
				<td style="width: 14%">SERIE</td>
				<td style="width: 36%" colspan="2">RESUMEN DE LAS FACTURAS/ BOLETAS /RECIBOS</td>
				<td style="width: 8%">CANTIDAD</td>
				<td style="width: 8%">MONTO</td>
				<td style="width: 34%"></td>
			</tr>
			<tr>
				<td style="padding-top: 10px">MEDICAMENTOS</td>
				<td style="padding-top: 10px">DEL Nº <?php echo $query03[0][6];?></td>
				<td style="padding-top: 10px">AL Nº <?php echo $query03[0][7];?></td>
				<td style="padding-top: 10px"><?php echo $query03[0][8];?></td>
				<td style="padding-top: 10px"><?php echo 'S/. '.$query03[0][9];?></td>
				<td style="height: 45px;text-align: center;" rowspan="2"><br><br><hr>RESPONSABLE DE CAJA</td>
			</tr>
			<tr>
				<td style="padding-top: 10px">R.D.R</td>
				<td style="padding-top: 10px">DEL Nº <?php echo $query03[0][10];?></td>
				<td style="padding-top: 10px">AL Nº <?php echo $query03[0][11];?></td>
				<td style="padding-top: 10px"><?php echo $query03[0][12];?></td>
				<td style="padding-top: 10px"><?php echo 'S/. '.$query03[0][13];?></td>
			</tr>
			<tr>
				<td colspan="5"></td>
				<td style="height: 45px;text-align: center;"><br><br><hr>RESPONSABLE DEL ESTABLECIMIENTO</td>
			</tr>
		</table>


</page>

