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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      
      <div id="resultados"></div>
      <div class="row">

        <div class="panel panel-primary panel-head"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Reporte General del Registro de Recaudación Diaria</h3> 

            <div class="panel-tools">
              <div class="button exportar_excel"><a href="#"><i class="fa fa-file-excel-o"></i><span>Excel</span></a></div>
              <div class="button exportar_pdf"><a href="#"><i class="fa fa-file-pdf-o"></i><span>PDF</span></a></div>
              <div class="button "><a href="./"><i class="fa fa-times"></i><span>Cancelar</span></a></div>
            </div>

          </div>

          <div class="panel-body">

            <div class="panel-uno">
<?php 

$establecimiento = $_ListaUsuario[$_SESSION['sesion_id']]['NEST_NOMBRE'];
$renaes = $_ListaUsuario[$_SESSION['sesion_id']]['NESTA_RENAES'];
//var_dump($establecimiento);
//var_dump($renaes);
$perf_id =$_usuario[$_SESSION['sesion_id']]['MPERF_ID'];
 //var_dump($perf_id);
?>
              <form class="form-horizontal form-label-left">
          
		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12 lbl_tipo_reporte">Tipo de Reporte</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if(($perf_id =='01') || ($perf_id=='02')) { ?>
		              <select class="form-control" name="cbx_tipo_reporte" id="cbx_tipo_reporte" required="">
		                <option value="0">Seleccionar Estrategia</option>
                    <?php
                      foreach ($_ListaReportes as $key => $value) {
                          echo '<option value=',$value[0],'>',$value[1],'</option>';
                      }  
                    ?>
                  </select>
                <?php } else{ ?>
                  <select class="form-control" name="cbx_tipo_reporte" id="cbx_tipo_reporte" required="">
                    <option value="0">Seleccionar Estrategia</option>
                    <option value="03">REPORTE DE REGISTRO DE RECAUDACIÓN</option>
                  </select>
                <?php  } ?>
			          
		            </div>
		          </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Recaudación</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="cbx_tipo_recaudacion" id="cbx_tipo_recaudacion" required="">
                    <option value="00">TODOS</option>
                    <?php
                     foreach ($_ListaTipoRec as $key => $value) {
                          echo '<option value=',$value[0],'>',$value[1],'</option>';
                      }  
                    ?>
                  </select>
                </div>
              </div>


		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12 lbl_tipo_nivel">Nivel de Reporte</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php if(($perf_id =='01') || ($perf_id=='02')) { ?>
		              <select class="form-control" name="cbx_tipo_nivel" id="cbx_tipo_nivel" required="">
		                <option value="0">Seleccione el tipo</option>
		                <option value="01">Reporte a Nivel de Diris</option>
		                <option value="02">Reporte a Nivel de Distrito</option>
		                <option value="03">Reporte a Nivel de Establecimiento</option>
		              </select>
                  <?php } else{ ?>
                  <select class="form-control" name="cbx_tipo_nivel" id="cbx_tipo_nivel" required="">
                    <option value="0">Seleccione el tipo</option>
                    <option value="03">Reporte a Nivel de Establecimiento</option>
                  </select>
                  <?php } ?>

		            </div>
		          </div>

              <div class="form-group" id="form-distrito">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 lbl_nivel_distrito">Distrito</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="cbx_nivel_distrito" id="cbx_nivel_distrito" required="">
                    <option value="0">Seleccionar Distrito</option>
                         <?php
                            foreach ($_ListaDistritos as $key => $value) {
                                echo '<option value=',$value[0],'>',$value[1],'</option>';
                            }  
                          ?>
                    </select>
                </div>
              </div>


              <div class="form-group" id="form-establecimientos">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12 lbl_establecimiento">Establecimientos</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php if(($perf_id =='01') || ($perf_id=='02')) { ?>
		                <select class="form-control" name="cbx_establecimiento" id="cbx_establecimiento" required="">
		                <option value="0">Seleccionar Establecimiento</option>
                         <?php
                            foreach ($_ListaEstablecimientos as $key => $value) {
                                echo '<option value=',$value[3],'>',$value[5],' - ',$value[3],'</option>';
                            }  
                          ?>
                    </select>
                    <?php } else{ ?>
                    <select class="form-control" name="cbx_establecimiento" id="cbx_establecimiento" required="">
                      <option value="0">Seleccionar Establecimiento</option>
                      <option value="<?php echo $renaes?>"><?php echo $establecimiento;?></option>
                    </select>
                    <?php } ?>
		            </div>
		          </div>

<!--
              <div class="form-group" id="form-anual">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Año</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="cbx_anual" id="cbx_anual" required="">
                    <option value="0">Seleccionar Año</option>
                         <?php
                            foreach ($_ListaAnio as $key => $value) {
                                echo '<option value=',$value[0],'>',$value[1],'</option>';
                            }  
                          ?>
                  </select>
                </div>
              </div>
-->            

              <div class="form-group" id="form-anual">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio</label>
                  <div class="col-md-2">
                      <div class="form-group">
                          <div class="col-md-12 col-xs-12">
                            <div id="datepicker1" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input id="fecha_inicio" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>                        
                          </div>
                      </div>
                  </div>

              <label class="control-label col-md-2 col-sm-3 col-xs-12">Fecha Fin</label>
                  <div class="col-md-2">
                      <div class="form-group">
                          <div class="col-md-12 col-xs-12">
                            <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input id="fecha_inicio" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>                        
                          </div>
                      </div>
                  </div>


<?php

/*$arrayName = array('3','dsd','dsad' );*/
/**/
/*foreach ($arrayName as $key => $value) {*/
/*  echo $key;*/
/*}*/

?>
<!--

                  <div class="col-md-3">
                    <div class="row">
                      <div class="form-group">
                          <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Fecha Final:</label>
                          <div class="col-md-9 col-xs-12">
                            <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input id="fecha_final" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>                        
                          </div>
                      </div>
                    </div>
                  </div>-->
            </div>  


<!--
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button id="exportar_excel" class="btn btn-success">Exportar</button>
            </div>
          </div>
-->
        </form>

            </div> <!--panel-uno-->
          </div> <!--panel-body-->
        </div> <!--panel-primary-->

    
      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>