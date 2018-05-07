<?php
require_once 'public/overall/header.php'; 
?>

<?php
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
<?php include 'public/modal/modal_recaudacion_voucher.php'; ?>
<script src="view/bootstrap-default/js/Busquedaformulario.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      
      <div id="resultados"></div>
      <div class="row">

        <div class="panel panel-primary panel-head"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Lista de registros de recaudacion de <?php echo $_ListaUsuario[$_SESSION['sesion_id']]['NEST_NOMBRE']?></h3> 
          </div>

          <div class="panel-body">

            <div class="panel-uno">
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Fecha:</label>
                      <div class="col-md-9 col-xs-12">
                        <div id="datepicker1" class="input-group date" data-date-format="mm-dd-yyyy">
                            <input id="fecha_inicio" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>                        
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Fecha:</label>
                      <div class="col-md-9 col-xs-12">
                        <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
                            <input id="fecha_final" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>                        
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                      <input id="calcular_lista" class="btn btn-primary" type="button" value="buscar">
                  </div>
                </div>
              </div>
            </div> <!--panel-uno-->
          </div> <!--panel-body-->
        </div> <!--panel-primary-->


        <div class="panel panel-primary panel-head filterable"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Resultados</h3> 
          </div>
          
          <span id="loader"></span>
           <div class="panel-body">
              <div id="resultados"></div><!-- Carga los datos ajax -->
              <div class='outer_div'></div>
           </div><!--panel-body --> 
        </div><!--panel-primary -->

    
      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>