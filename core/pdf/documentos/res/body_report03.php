<style type="text/css">

table { vertical-align: top; }
tr    { vertical-align: top; font-size: 6.5px}
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

<page backtop="1mm" backbottom="1mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
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
	<?php include("encabezado_03.php");?>
    <br>
    

	
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
		
		<tr>
			<td style="width: 4%"><b>Nº</b></td>
			<td style="width: 10%"><b>CLASIFICADOR</b></td>
			<td style="width: 70%"><b>DESCRIPCIÓN</b></td>
      <td style="width: 8%"><b>CANTIDAD</b></td>
			<td style="width: 8%"><b>MONTO</b></td>
    </tr>

			<?php 
		if (!empty($query03)){

			foreach ($query03 as $key => $value) {

              $id= $key + 1;
              $CLASIFICADOR= $value[0];
              $DESCRIPCION= $value[1];
              $CANTIDAD= $value[2];
              $LCLAS_ID= $value[4];
              $LCLAS_PADRE= $value[5];
              $MONTO= 'S/. '.number_format($value[3], 2, '.', '');

              if($LCLAS_PADRE == 0){
              echo '<tr>';
                  echo '<td><b>',$id,'</b></td>';
                  echo '<td style="text-align:center;"><b>',$CLASIFICADOR,'</b></td>';
                  echo '<td style="text-align:center;"><b>',$DESCRIPCION,'</b></td>';
                  echo '<td>',$CANTIDAD,'</td>';
                  echo '<td>',$MONTO,'</td>';
              echo '</tr>';
              }else{            
              echo '<tr>';
                  echo '<td>',$id,'</td>';
                  echo '<td>',$CLASIFICADOR,'</td>';
                  echo '<td>',$DESCRIPCION,'</td>';
                  echo '<td>',$CANTIDAD,'</td>';
                  echo '<td>',$MONTO,'</td>';
              echo '</tr>';
              }

        }//FOREACH
        
  }else{
        	echo '<tr><td colspan="4"><p>No se encontraron resultados en la busqueda</p></td></tr>';
  }

			?>
    </table>

</page>