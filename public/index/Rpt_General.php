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
              <div class="button btn-save"><a href="#"><i class="fa fa-floppy-o"></i><span>Guardar</span></a></div>
              <div class="button btn-cancel"><a href="#"><i class="fa fa-pencil"></i><span>Editar</span></a></div>
              <div class="button btn-cancel"><a href="./index.php"><i class="fa fa-times"></i><span>Cancelar</span></a></div>
            </div>

          </div>

          <div class="panel-body">

            <div class="panel-uno">

              <form class="form-horizontal form-label-left">
          
		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Reporte</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <select class="form-control" name="cbx_tipo_reporte" id="cbx_tipo_reporte" required="">
		                  <option value="0">Seleccionar Estrategia</option>
			              <option value="01">FORMATO DE RECAUDACION DIARIA</option>
			          </select>
		            </div>
		          </div>

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de Reporte</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <select class="form-control" name="cbx_tipo_nivel" id="cbx_tipo_nivel" required="">
		                <option value="0">Seleccione el tipo</option>
		                <option value="01">Reporte a Nivel de Diris</option>
		                <option value="02">Reporte a Nivel de Distrito</option>
		                <option value="03">Reporte a Nivel de Establecimiento</option>
		              </select>
		            </div>
		          </div>

		          <div class="form-group" id="form-distrito">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12">Distrito</label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <select class="form-control" name="cbx_nivel_distrito" id="cbx_nivel_distrito" required="">
		                <option value="0">Seleccionar Red</option>
                        <option value="01">Carabayllo</option>
                      </select>
		            </div>
		          </div>

          <div class="form-group" id="form-microred" style="display: block;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Microred</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_microred" id="cbx_microred" required=""><option value="0">Seleccionar MicroRed</option><option value="03">COLLIQUE III ZONA</option></select>
            </div>
          </div>

          <div class="form-group" id="form-establecimiento" style="display: block;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Establecimiento</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_establecimiento" id="cbx_establecimiento" required=""><option value="0">Seleccionar Establecimiento</option><option value="010">P.S. LOS GERANIOS</option></select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_tipo" id="cbx_tipo" required="">
                <option value="0">Seleccionar tipo</option>
                <option value="01">Reporte Mensual</option>
                <option value="02">Reporte Trimestral</option>
                <option value="03">Reporte Semestral</option>
                <option value="04">Reporte Anual</option>
              </select>
            </div>
          </div>

          <div class="form-group" id="form-mes" style="display: none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mensual</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_mes" id="cbx_mes">
                <option value="0">Seleccionar mes</option>
                                    <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                  </select>
            </div>
          </div> 

          <div class="form-group" id="form-trimestre" style="display: none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trimeste</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_trimestre" id="cbx_trimestre">
                <option value="0">Seleccionar trimestre</option>
                <option value="01">Primer trimestre</option>
                <option value="02">Segundo trimestre</option>
                <option value="03">Tercer trimestre</option>
                <option value="04">Cuarto trimestre</option>
                
              </select>
            </div>
          </div>

          <div class="form-group" id="form-semestre" style="display: none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semestre</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_semestre" id="cbx_semestre">
                <option value="0">Seleccionar Semestre</option>
                <option value="01">Primer Semestre</option>
                <option value="02">Segundo Semestre</option>                          
              </select>
            </div>

          </div>

          <div class="form-group" id="form-anual">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Año</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="cbx_anual" id="cbx_anual" required="">
                <option value="0">Seleccionar Año</option>
                                    <option value="01">2017</option>
                                        <option value="02">2018</option>
                                  </select>
            </div>
          </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <!--<button id="reporte16" type="submit" class="btn btn-success">Consultar</button>-->
              <button id="exportar_excel" class="btn btn-success">Exportar</button>
              <!--<button class="btn btn-primary" type="reset">Reset</button>-->
            </div>
          </div>

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