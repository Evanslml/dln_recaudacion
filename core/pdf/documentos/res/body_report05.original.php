<style type="text/css">

table { vertical-align: top; }
tr    { vertical-align: top; font-size: 7px}
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.resalt{
  background: #ccc;
  font-weight: bold;
  text-align: center;
}
.total{
  background: #f1f1f1;
  font-weight: bold;
  text-align: center;
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

<page backtop="3mm" backbottom="5mm" backleft="0.5mm" backright="0.5mm" style="font-size: 12pt; font-family: arial" >
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
    if (!empty($query05)){ ?>
    
    <table class="tbl_detalle" cellspacing="0" style="width: 100%; text-align: left;">
    
      <?php
              echo '<tr>';
              echo '<td style="width:2%">',$title[0],'</td>';
              echo '<td style="width:8%">',$title[1],'</td>';
              echo '<td style="width: 2.8125%" class="total">',$title[2],'</td>';
              echo '<td style="width: 2.8125%" class="total">',$title[3],'</td>';
              echo '<td style="width: 2.8125%" class="total">',$title[4],'</td>';
              echo '<td style="width: 2.8125%" class="resalt">',$title[5],'</td>';
              echo '<td style="width: 2.8125%">',$title[6],'</td>';
              echo '<td style="width: 2.8125%">',$title[7],'</td>';
              echo '<td style="width: 2.8125%">',$title[8],'</td>';
              echo '<td style="width: 2.8125%" class="resalt">',$title[9],'</td>';
              echo '<td style="width: 2.8125%">',$title[10],'</td>';
              echo '<td style="width: 2.8125%">',$title[11],'</td>';
              echo '<td style="width: 2.8125%">',$title[12],'</td>';
              echo '<td style="width: 2.8125%">',$title[13],'</td>';
              echo '<td style="width: 2.8125%">',$title[14],'</td>';
              echo '<td style="width: 2.8125%">',$title[15],'</td>';
              echo '<td style="width: 2.8125%" class="resalt">',$title[16],'</td>';
              echo '<td style="width: 2.8125%">',$title[17],'</td>';
              echo '<td style="width: 2.8125%">',$title[18],'</td>';
              echo '<td style="width: 2.8125%">',$title[19],'</td>';
              echo '<td style="width: 2.8125%">',$title[20],'</td>';
              echo '<td style="width: 2.8125%">',$title[21],'</td>';
              echo '<td style="width: 2.8125%">',$title[22],'</td>';
              echo '<td style="width: 2.8125%">',$title[23],'</td>';
              echo '<td style="width: 2.8125%">',$title[24],'</td>';
              echo '<td style="width: 2.8125%">',$title[25],'</td>';
              echo '<td style="width: 2.8125%">',$title[26],'</td>';
              echo '<td style="width: 2.8125%">',$title[27],'</td>';
              echo '<td style="width: 2.8125%">',$title[28],'</td>';
              echo '<td style="width: 2.8125%">',$title[29],'</td>';
              echo '<td style="width: 2.8125%">',$title[30],'</td>';
              echo '<td style="width: 2.8125%" class="resalt">',$title[31],'</td>';
              echo '<td style="width: 2.8125%">',$title[32],'</td>';
              echo '<td style="width: 2.8125%">',$title[33],'</td>';
              echo '</tr>';

			foreach ($query05 as $key => $value) {
 

              echo '<tr>';
              echo '<td>',$value[0],'</td>';
              if($value[0] =='0004'){
              echo '<td>C.A.N Nº2 RIMAC</td>';
              }else{
              echo '<td>',$value[1],'</td>';
              }
              echo '<td class="total">',$value[2],'</td>';
              echo '<td class="total">',$value[3],'</td>';
              echo '<td class="total">',$value[4],'</td>';
              echo '<td class="resalt">',$value[5],'</td>';
              echo '<td>',$value[6],'</td>';
              echo '<td>',$value[7],'</td>';
              echo '<td>',$value[8],'</td>';
              echo '<td class="resalt">',$value[9],'</td>';
              echo '<td>',$value[10],'</td>';
              echo '<td>',$value[11],'</td>';
              echo '<td>',$value[12],'</td>';
              echo '<td>',$value[13],'</td>';
              echo '<td>',$value[14],'</td>';
              echo '<td>',$value[15],'</td>';
              echo '<td class="resalt">',$value[16],'</td>';
              echo '<td>',$value[17],'</td>';
              echo '<td>',$value[18],'</td>';
              echo '<td>',$value[19],'</td>';
              echo '<td>',$value[20],'</td>';
              echo '<td>',$value[21],'</td>';
              echo '<td>',$value[22],'</td>';
              echo '<td>',$value[23],'</td>';
              echo '<td>',$value[24],'</td>';
              echo '<td>',$value[25],'</td>';
              echo '<td>',$value[26],'</td>';
              echo '<td>',$value[27],'</td>';
              echo '<td>',$value[28],'</td>';
              echo '<td>',$value[29],'</td>';
              echo '<td>',$value[30],'</td>';
              echo '<td class="resalt">',$value[31],'</td>';
              echo '<td>',$value[32],'</td>';
              echo '<td>',$value[33],'</td>';
              echo '</tr>';
            }//FOREACH
        

			?>
    </table>
    



    <?php


        }else{
          echo '<table><tr><td colspan="6"><p>No se encontraron resultados en la busqueda</p></td></tr></table>';
        }

    ?>
</page>