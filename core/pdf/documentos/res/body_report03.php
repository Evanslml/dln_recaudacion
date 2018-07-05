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
	<?php include("encabezado_03.php");

  if (!empty($query03) || count($query03)>1) {
  ?>
	
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;margin-top: 10px;">
		
		<tr>
			<td style="width: 4%"><b>Nº</b></td>
			<td style="width: 10%"><b>CLASIFICADOR</b></td>
			<td style="width: 70%"><b>DESCRIPCIÓN</b></td>
      <td style="width: 8%"><b>CANTIDAD</b></td>
			<td style="width: 8%"><b>MONTO</b></td>
    </tr>

		<?php 

    $cantidaderows=count($query03);
    
    if($tipo_recaudacion=='00'){  
    
    if($cantidaderows=='75'){
    $CANT1 = $query03[0][2];
    $CANT2 = $query03[2][2];
    $CANT3 = $query03[4][2];
    $CANT4 = $query03[6][2];
    $CANT5 = $query03[25][2];
    $CANT6 = $query03[70][2];
    $CANT7 = $query03[72][2];

    $MONTO1 = $query03[0][3];
    $MONTO2 = $query03[2][3];
    $MONTO3 = $query03[4][3];
    $MONTO4 = $query03[6][3];
    $MONTO5 = $query03[25][3];
    $MONTO6 = $query03[70][3];
    $MONTO7 = $query03[72][3];

  }else if($cantidaderows=='73') {
    $CANT1 = $query03[0][2];
    $CANT2 = '0';
    $CANT3 = $query03[2][2];
    $CANT4 = $query03[4][2];
    $CANT5 = $query03[23][2];
    $CANT6 = $query03[68][2];
    $CANT7 = $query03[70][2];

    $MONTO1 = $query03[0][3];
    $MONTO2 = '0.00';
    $MONTO3 = $query03[2][3];
    $MONTO4 = $query03[4][3];
    $MONTO5 = $query03[23][3];
    $MONTO6 = $query03[68][3];
    $MONTO7 = $query03[70][3];
  }

    $CANT_RDR = $CANT1+$CANT3+$CANT4+$CANT5+$CANT6+$CANT7;
    $MONTO_RDR = $MONTO1+$MONTO3+$MONTO4+$MONTO5+$MONTO6+$MONTO7;
    $CANT_SISMED = $CANT2;
    $MONTO_SISMED = $MONTO2;
    $CANT_TOTAL = $CANT_SISMED + $CANT_RDR;
    $MONTO_TOTAL = $MONTO_SISMED + $MONTO_RDR;

    $MONTO_TOTAL= 'S/. '.number_format($MONTO_TOTAL, 2, '.', '');
    $MONTO_RDR= 'S/. '.number_format($MONTO_RDR, 2, '.', '');
    $MONTO_SISMED= 'S/. '.number_format($MONTO_SISMED, 2, '.', '');
    
    } //tipo_recaudacion

		
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
  
  ?>
  <tr>
    <td colspan="2"></td>
    <td style="text-align: center;font-weight: bold"><?php if($tipo_recaudacion=='00'){ echo "TOTAL";}?></td>
    <td><?php if($tipo_recaudacion=='00'){ echo $CANT_TOTAL;} ?></td>
    <td><?php if($tipo_recaudacion=='00'){ echo $MONTO_TOTAL;} ?></td>
  </tr>
  </table>
      <table class="tbl_total" cellspacing="0" style="width: 100%; text-align: left;margin-top: 5px">
      <tr>
        <td style="width: 20%; text-align: center;"><?php if($tipo_recaudacion=='00'){ echo "SERIE";}?></td>
        <td style="width: 23%; text-align: center;"><?php if($tipo_recaudacion=='00'){ echo "CANTIDAD";}?></td>
        <td style="width: 23%; text-align: center;"><?php if($tipo_recaudacion=='00'){ echo "MONTO";}?></td>
        <td style="width: 34%"></td>
      </tr>
      <tr>
        <td style="padding-top: 2px"><?php if($tipo_recaudacion=='00'){ echo "R.D.R";}?></td>
        <td style="padding-top: 2px;padding-left: 5px"><?php if($tipo_recaudacion=='00'){  echo $CANT_RDR;}  ?></td>
        <td style="padding-top: 2px;padding-left: 5px"><?php if($tipo_recaudacion=='00'){  echo $MONTO_RDR;} ?></td>
        <td style="height: 15px;text-align: center;" rowspan="2"><br><hr>RESPONSABLE DE CAJA</td>
      </tr>
      <tr>
        <td style="padding-top: 2px;padding-left: 5px"><?php if($tipo_recaudacion=='00'){ echo "MEDICAMENTOS";}?></td>
        <td style="padding-top: 2px;padding-left: 5px"><?php if($tipo_recaudacion=='00'){  echo $CANT_SISMED;}    ?></td>
        <td style="padding-top: 2px;padding-left: 5px"><?php if($tipo_recaudacion=='00'){   echo $MONTO_SISMED;}  ?></td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td style="height: 15px;text-align: center;"><br><hr>RESPONSABLE DEL ESTABLECIMIENTO</td>
      </tr>
    </table>


  <?php    
  } else
  {
  ?>
  <table>
  <?php
    echo '<tr><td><p>No se encontraron resultados en la busqueda</p></td></tr>';
  ?>
  </table>
  <?php
  }
  ?>
  

</page>