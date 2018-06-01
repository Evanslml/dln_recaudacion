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
	<?php include("encabezado_report.php");?>
    <br>
    
 <?php 
    if (!empty($query04)){ ?>

    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
			<tr>
			<td style="width: 10%" rowspan="2"><b><?php echo $title[0]?></b></td>
			<td style="width: 70%" rowspan="2" colspan="3"><b><?php echo $title[1]?></b></td>
			<td style="width: 20%" colspan="2"><b><?php echo $title[2]?></b></td>
    </tr>
    <tr>
      <td><b><?php echo $title[3]?></b></td>
      <td><b><?php echo $title[4]?></b></td>
    </tr>

			<?php 

      $SUMA1=0;
      $SUMA2=0;
      $SUMA3=0;
      $SUMA4=0;
      foreach ($query04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='1'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA1 += $LCLAS_MONTO1;}
      foreach ($query04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='7'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA2 += $LCLAS_MONTO1;}
      foreach ($query04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='26'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA3 += $LCLAS_MONTO1;}
      foreach ($query04 as $key => $value) {$LCLAS_PADRE= $value[3]; if($LCLAS_PADRE =='73'){$LCLAS_MONTO1= $value[5]; }else{$LCLAS_MONTO1=0; } $SUMA4 += $LCLAS_MONTO1;}

      $SUBTOTAL1=$SUMA1+$SUMA2+$SUMA3;
      $SUBTOTAL2=$SUMA4;

      $SUMA = $SUBTOTAL1 + $SUBTOTAL2;
      $SUMA ='S/. '.number_format($SUMA, 2, '.', '');

      ?>
      <tr>
        <td>1201</td>
        <td colspan="3">CTAS POR COBRAR</td>
        <td></td>
        <td><?php echo $SUMA ?></td>
      </tr>      
      <tr>
        <td>1201.03</td>
        <td colspan="3">VENTA DE BIENES Y SERVICIOS Y DERECHOS ADMINISTRATIVOS</td>
        <td><?php echo $SUBTOTAL1 ?></td>
        <td></td>
      </tr>

      <?php
			foreach ($query04 as $key => $value) {

              $id= $key + 1;
              $LCLAS_ID= $value[0];
              $LCLAS_ALIAS= $value[1];
              $LCLAS_NOMBRE= $value[2];
              $LCLAS_PADRE= $value[3];
              $LCLAS_CANTIDAD= $value[4];
              $LCLAS_MONTO= $value[5];
              //$MONTO= 'S/. '.number_format($value[3], 2, '.', '');

              $COD_A=$value[6];
              $DET_A=$value[7];
              $COD_B=$value[8];
              $DET_B=$value[9];
              $COD_C=$value[10];
              $DET_C=$value[11];

              echo '<tr>';
              
              if($LCLAS_PADRE=='0'){
                echo '<td><b>',$COD_C,'</b></td>';
                echo '<td colspan="2"><b>',$DET_C,'</b></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
              }else{ 
                echo '<td></td>';
                echo '<td>',$LCLAS_ALIAS,'</td>';
                echo '<td>',$LCLAS_NOMBRE,'</td>';
                echo '<td>',$LCLAS_MONTO,'</td>';
                echo '<td></td>';
                echo '<td></td>';
              }

              echo '</tr>';
            }//FOREACH
        

			?>
    </table>
    

    <p style="text-align: center;font-size: 11px">CODIGO DE CONTABILIDAD PRESUPUESTAL Y CLASIFICACIÒN DEL GASTO PUBLICO</p>
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
      <tr>
        <td colspan="2">CUENTA MAYOR</td>
        <td rowspan="2" style="width: 7.69%">SECTOR</td>
        <td rowspan="2" style="width: 7.69%">PLIEGO</td>
        <td rowspan="2" style="width: 7.69%">PROGRAMA</td>
        <td rowspan="2" style="width: 7.69%">SUBPRO<br>GRAMA</td>
        <td rowspan="2" style="width: 7.69%">PROYECTO</td>
        <td rowspan="2" style="width: 7.69%">OBRA</td>
        <td rowspan="2" style="width: 7.69%">ACTIVIDAD</td>
        <td rowspan="2" style="width: 7.69%">TAREA</td>
        <td rowspan="2" style="width: 7.69%">FUENTE FIANCIEMI<br>ENTO</td>
        <td rowspan="2" style="width: 7.69%">DEPENDEN<br>CIA</td>
        <td rowspan="2" style="width: 7.69%">VºBº</td>
      </tr>
      <tr>
        <td style="width: 7.69%">DEBE</td>
        <td style="width: 7.69%">HABER</td>
      </tr>
      <tr>
        <td>8501</td>
        <td>8501.02</td>
        <td>11</td>
        <td>11</td>
        <td>6</td>
        <td>45</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>RDR</td>
        <td>DIRIS LN</td>
        <td></td>
      </tr>
    </table>

  <br>
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
        <tr>
          <td colspan="5">CONTABILIDAD PATRIMONIAL</td>
          <td colspan="5" rowspan="3" style="width: 50%;text-align: center;"><br><br><br><hr>DIRECTOR DE PRESUPUESTO Y CONTABILIDAD</td>
        </tr>
        <tr>
          <td colspan="3" style="width: 30%">CODIGO</td>
          <td colspan="2" style="width: 20%">IMPORTE</td>
        </tr>
        <tr>
          <td>CUENTA MAYOR</td>
          <td colspan="2">SUBCUENTAS</td>
          <td>DEBE</td>
          <td>HABER</td>
        </tr>
        <tr>
          <td>1101</td>
          <td>1101.01</td>
          <td></td>
          <td><?php echo $SUMA;?></td>
          <td></td>
          <td colspan="5" rowspan="3" style="text-align: center;"><br><br><br><hr>RECEPCIONISTA DEL DEPOSITO</td>
        </tr>
        <tr>
          <td>1102</td>
          <td></td>
          <td>1201.03</td>
          <td></td>
          <td><?php echo $SUMA;?></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td>1201.98</td>
          <td></td>
          <td>S/. 0.00</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

    
    </table>


    <?php


        }else{
          echo '<table><tr><td colspan="6"><p>No se encontraron resultados en la busqueda</p></td></tr></table>';
        }

    ?>
</page>