<?php
require_once 'public/overall/header.php'; 
?>
<script src="view/jquery-price-format/jquery.priceformat.min.js"></script>
<?php
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>

  <script type="text/javascript">

      $(function () {
          $('#datetimepicker1').datetimepicker({
            format: "L"
          });

          $('.type-price').priceFormat({
              prefix: 'S/. ',
              centsSeparator: '.',
              thousandsSeparator: ','
          });

          $("#table_recaudacion input").keypress(function (e) {
           if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
          }
          });

          var celdas_disable_1='.celdas_disable';
          var celdas_disable_2='.celdas_disable-2';
          $(celdas_disable_1).prop('disabled', true).addClass('disable-1-css');
          $(celdas_disable_2).prop('disabled', true).addClass('disable-2-css');

      });
      
  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">

        <div class="col-md-12">
          <h3>Registro de Formato de Recaudación Diaria</h3>
        </div>
 
        <div class="col-md-6">

          <div class="form-group">
              <div class='input-group date' id='datetimepicker1'>
                  <input type='text' class="form-control"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
                  
        </div>

        <div class="col-md-12">
          <div class="box box-primary">            
            <div class="table-responsive" style="padding:10px;">
            <table id="table_recaudacion" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Clasificador</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Monto</th>
                </tr>
               </thead>
               <tbody>
                <?php
                  foreach ($_ListaClasificador as $key => $value) {

                    $id= $key;
                    $clasificador= $value[1];
                    $descripcion= $value[2];
                    $class_padre= $value[3];
                    $estado= $value[6];

                    //echo '<input type="hidden" value="',$id,'" id="id',$id,'"/>';
                    //echo '<input type="hidden" value="',$clasificador,'" id="clasificador',$id,'"/>';
                    //echo '<input type="hidden" value="',$descripcion,'" id="descripcion',$id,'"/>';

                    echo '<tr>';
                    echo '<td>',$id,'</td>';

                    switch ($class_padre) {
                      case '0':
                        echo '<td class="disable-1-css"><b>',$clasificador,'</b></td>';
                        echo '<td class="disable-1-css"><b>',$descripcion,'</b></td>';
                        echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable form-control" placeholder="0"/></td>';
                        echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="000" name="type-price" class="celdas_disable type-price form-control" /></td>';
                      break;

                      default:
                        if($estado =='0'){
                            echo '<td class="disable-2-css">',$clasificador,'</td>';
                            echo '<td class="disable-2-css">',$descripcion,'</td>';
                            echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable-2 form-control" placeholder="0"/></td>';
                            echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="000" name="type-price" class="celdas_disable-2 type-price form-control" /></td>';
                        }else{
                            echo '<td>',$clasificador,'</td>';
                            echo '<td>',$descripcion,'</td>';
                            echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="form-control" placeholder="0"/></td>';
                            echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="000" name="type-price" class="type-price form-control" /></td>';
                        }
                      break;

                    }

                    echo '</tr>';
                  }
                ?>  
              </tbody>
            </table>
          </div> 

          </div>
        </div>
        
        <div class="col-md-12">
          <div class="box box-primary">  
            <div class="row">
              <div class="col-md-1">
                
              </div>
              <div class="col-md-11">
                <h4>Boletas</h4>
              </div>
            </div>
          </div>
        </div>
      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>