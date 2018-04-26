<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
 

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
                  
          <script type="text/javascript">

              $(function () {
                  $('#datetimepicker1').datetimepicker({
                    format: "L"
                  });
              });
              
          </script>

        </div>

        <div class="col-md-12">
          <div class="box box-primary">
            <h3 class="widget-user-username"><?php //echo var_dump($_ListaClasificador); ?></h3>
            
            <div class="table-responsive">
            <table class="table table-striped ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Clasificador</th>
                  <th>Descripción</th>
                  <th>Accion</th>
                </tr>
               </thead>
               <tbody>
                <?php
                  foreach ($_ListaClasificador as $key => $value) {

                    $id= $key;
                    $clasificador= $value[1];
                    $descripcion= $value[2];

                    echo '<input type="hidden" value="',$id,'" id="id',$id,'"/>';
                    echo '<input type="hidden" value="',$clasificador,'" id="clasificador',$id,'"/>';
                    echo '<input type="hidden" value="',$descripcion,'" id="descripcion',$id,'"/>';

                    echo '<tr>';
                    echo '<td>',$id,'</td>';
                    echo '<td>',$clasificador,'</td>';
                    echo '<td>',$descripcion,'</td>';
                    echo '<td style="width: 60px; padding: 5px 2px;"><input type="text" class="form-control" style="width: 100%;height: 25px;padding: 0px 6px;text-align: center;"/></td>';
                    echo '<td style="width: 60px; padding: 5px 2px;"><input type="text" class="form-control" style="width: 100%;height: 25px;padding: 0px 6px;text-align: center;"/></td>';
                    echo '</tr>';
                  }
                ?>  
              </tbody>
            </table>
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