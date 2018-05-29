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
<?php include 'view/bootstrap-default/js/calculos.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      
      <div id="resultados"></div>
      <div class="row">

        <div class="panel panel-primary panel-head"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Registro de Recaudación Diaria</h3> 

            <div class="panel-tools">
              <div class="button btn-save"><a href="#"><i class="fa fa-floppy-o"></i><span>Guardar</span></a></div>
              <div class="button btn-cancel"><a href="#"><i class="fa fa-pencil"></i><span>Editar</span></a></div>
              <div class="button btn-cancel"><a href="./"><i class="fa fa-times"></i><span>Cancelar</span></a></div>
            </div>

          </div>

          <div class="panel-body">

            <div class="panel-uno">
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Fecha:</label>
                      <div class="col-md-9 col-xs-12">

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

              <?php  

            if($_ListaUsuario[$_SESSION['sesion_id']]['NESTA_RENAES'] == '00000'){ ?>

              <div class="col-md-4" style="margin: 10px 0;">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Renipres:</label>
                      <div class="col-md-9 col-xs-12">
                          <select class="form-control" id="mod_Establecimiento" name="mod_Establecimiento">
                            <option value="00000">SELECCIONE ESTABLECIMIENTO</option>
                            <?php foreach ($_ListaEstablecimientos as $key => $value) {
                            echo '<option value=',$value[3],' >',$value[5],' - ', $value[3] ,' </option>';
                            }
                            ?>
                          </select>                       
                      </div>
                  </div>
                </div>
              </div>
            <?php } ?>

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

           <div class="panel-body table_hover_select">
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
                    <tr class="disable-3-css">
                      <td>FILA</td>
                      <td>MEF</td>
                      <td>TOTAL GENERAL DEL DIA (1+3+5+7+26+71+73)</td>
                      <td><input id="cantidad-total" type="text" class="celdas_disable-3 form-control" value="0" style="border:none"/></td>
                      <td><input id="monto-total" type="text" value="000" name="type-price" class="celdas_disable-3 type-price form-control" style="border:none"/></td>
                    </tr>
                    <tr class="disable-3-css">
                      <td>FILA</td>
                      <td>MEF</td>
                      <td>TOTAL GENERAL DEL DIA R.D.R (1+5+7+26+71+73)</td>
                      <td><input id="cantidad-RDR" type="text" class="celdas_disable-3 form-control" value="0" style="border:none"/></td>
                      <td><input id="monto-RDR" type="text" value="000" name="type-price" class="celdas_disable-3 type-price form-control" style="border:none"/></td>
                    </tr>
                    <tr class="disable-3-css">
                      <td>FILA</td>
                      <td>MEF</td>
                      <td>TOTAL GENERAL DEL DIA SISMED(3)</td>
                      <td><input id="cantidad-SISMED" type="text" class="celdas_disable-3 form-control" value="0" style="border:none"/></td>
                      <td><input id="monto-SISMED" type="text" value="000" name="type-price" class="celdas_disable-3 type-price form-control" style="border:none"/></td>
                    </tr>
                      <?php

                      //var_dump($_ListaClasificador);

                        foreach ($_ListaClasificador as $key => $value) {

                          $id= $key;
                          $clasificador= $value[1];
                          $descripcion= $value[2];
                          $class_padre= $value[3];
                          $estado= $value[6];

                          /*echo '<tr>';*/
/*                          echo '<td>',$id,'</td>';*/

                          switch ($class_padre) {
                            case '0':
                              echo '<tr class="disable-1-css" style="color:#000 !important;">';
                              echo '<td>',$id,'</td>';
                              echo '<td><b>',$clasificador,'</b></td>';
                              echo '<td><b>',$descripcion,'</b></td>';
                              echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable form-control" placeholder="0" style="border:none"/></td>';
                              echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="000" name="type-price" class="celdas_disable type-price form-control" style="border:none"/></td>';
                              echo '</tr>';
                            break;

                            default:
                              if($estado =='0'){
                                  echo '<tr class="disable-2-css">';
                                  echo '<td>',$id,'</td>';
                                  echo '<td>',$clasificador,'</td>';
                                  echo '<td>',$descripcion,'</td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable-2 form-control" placeholder="0"/></td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="000" name="type-price" class="celdas_disable-2 type-price form-control" /></td>';
                                  echo '</tr>';
                              }else{
                                  echo '<tr>';
                                  echo '<td>',$id,'</td>';
                                  echo '<td>',$clasificador,'</td>';
                                  echo '<td>',$descripcion,'</td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input onKeyUp="Suma_Cant_Padre',$class_padre,'();Suma_Cant_Total()" id="cantidad-',$id,'" type="text" class="form-control" placeholder="0"/></td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input onKeyUp="Suma_Monto_Padre',$class_padre,'();Suma_Monto_Total()" id="monto-',$id,'" type="text" value="000" name="type-price" class="type-price form-control" /></td>';
                                  echo '</tr>';
                              }
                            break;

                          }

                          //echo '</tr>';
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