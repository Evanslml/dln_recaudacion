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
.tbl_total td {border-bottom: 1px solid #000; border-right: 1px solid #000; }
.tbl_total {border-top: 1px solid #000; border-left: 1px solid #000; }
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
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">

        <tr>
           <td style="width:4%;" class='midnight-blue'>ID</td>
		   <td style="width:10%;" class='midnight-blue'>CLAS.</td>
		   <td style="width:70%;" class='midnight-blue'>DESCRIPCION</td>
		   <td style="width:8%;" class='midnight-blue'>CANT.</td>
		   <td style="width:8%;" class='midnight-blue'>MONTO</td>
        </tr>
	
			<?php 

			$cant_total=0;
			$mont_total=0.00;
			foreach ($query01 as $key => $value) {

                          $id= $value[0];
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
                              echo '<td style="width: 5%; text-align: left">',$cantidad,'</td>';
                              echo '<td style="width: 8%; text-align: right"> S/. ',$monto,'</td>';
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
           <td style="width:20%;">DESCRIPCION</td>
		   <td style="width:8%;">BOL. INICIO</td>
		   <td style="width:8%;">BOL. FIN</td>
		   <td style="width:8%;">CANTIDAD</td>
		   <td style="width:8%;">IMPORTE</td>
        </tr>

		<?php
		foreach ($query02 as $key => $value) {
			 echo '<tr>';
			 echo '<td>', $value[0],'</td>';
			 echo '<td>', $value[2],'</td>';
			 echo '<td>', $value[3],'</td>';
			 echo '<td>', $value[4],'</td>';
			 echo '<td> S/.  ', $value[5],'</td>';
			 echo '</tr>';
			 $fecha = $value[6];
		}?>
   		<tr>
   			<td>TOTALES</td>
   			<td colspan="2"></td>
   			<td> <?php echo $cant_total;?> </td>
   			<td> <?php echo 'S/.  ',number_format($mont_total, 2, '.', ' ');?> </td>
   		</tr>
    </table>

	<br><small style="font-size: 11px;font-style: italic">Recudado la fecha <?php echo $fecha; ?></small>

	
	
	
	  

</page>

