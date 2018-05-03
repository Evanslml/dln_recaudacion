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
<script src="view/bootstrap-default/js/formulario.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">

        <div class="panel panel-primary panel-head"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Registro de Recaudación Diaria</h3> 

            <div class="panel-tools">
              <div class="button btn-save"><a href="#"><i class="fa fa-floppy-o"></i><span>Guardar</span></a></div>
              <div class="button btn-cancel"><a href="#"><i class="fa fa-pencil"></i><span>Editar</span></a></div>
              <div class="button btn-cancel"><a href="#"><i class="fa fa-times"></i><span>Cancelar</span></a></div>
            </div>

          </div>

          <div class="panel-body">

            <div class="panel-uno">
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Fecha:</label>
                      <div class="col-md-9 col-xs-12">

<!--
                          <div class='input-group date' id='datetimepicker1'>
                              <input type='text' id="date" name="date" class="form-control" readonly/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
-->
        

                        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                            <input class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>

                        
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                        <label class="col-md-4 col-xs-12 control-label">Boletas RDR:</label>
                        <div class="col-md-4 col-xs-6 addal">
                          <input class="form-control onlynumber" type="text" name="bolinirdr" id="bolinirdr" value="">
                        </div>
                       
                        <div class="col-md-4 col-xs-6">
                          <input class="form-control onlynumber" type="text" name="bolfinrdr" id="bolfinrdr" value="">
                        </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                        <label class="col-md-4 col-xs-12 control-label">Boletas SISMED:</label>
                        <div class="col-md-4 col-xs-6 addal">
                          <input class="form-control onlynumber" type="text" name="bolinisismed" id="bolinisismed" value="">
                        </div>
                       
                        <div class="col-md-4 col-xs-6">
                          <input class="form-control onlynumber" type="text" name="bolfinsismed" id="bolfinsismed" value="">
                        </div>
                  </div>
                </div>
              </div>
            </div> <!--panel-uno-->
          </div> <!--panel-body-->
        </div> <!--panel-primary-->


        <div class="panel panel-primary panel-head filterable"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Liquidación diaria de Recaudación</h3> 
            <div class="pull-right" style="margin-top: 12px;">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
            </div>
          </div>

           <div class="panel-body">
              <table id="table_recaudacion" class="table table-striped table-bordered table-hover">
                 <thead>
                      <tr class="filters">
                          <th><input type="text" class="form-control" placeholder="#" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Clasificador" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Descripción" disabled></th>
                          <th><!--<input type="text" class="form-control" placeholder="Cantidad" disabled>-->Cantidad</th>
                          <th><!--<input type="text" class="form-control" placeholder="Monto" disabled>-->Monto</th>
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