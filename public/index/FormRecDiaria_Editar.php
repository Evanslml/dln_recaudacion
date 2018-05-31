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
      
      <?php

      $id_formulario= $_POST['Idformulario'];
      $id_formulario= substr($id_formulario, 4,11);

      $id_formulario01 = '0101'.$id_formulario;
      $id_formulario02 = '0102'.$id_formulario;

      $query01 = Recaudacion::VerListaFormulario($id_formulario);  //TODO EL CONTENIDO

      $existe1 =  Recaudacion::ExisteFormulario($id_formulario01); //SISMED
      $existe2 =  Recaudacion::ExisteFormulario($id_formulario02); //RDR
      
      $existe3 =  Recaudacion::ExisteFormulario_Deposito($id_formulario01); //SISMED
      $existe4 =  Recaudacion::ExisteFormulario_Deposito($id_formulario02); //RDR

      if($existe1 == 1 && $existe2 == 0 ){
        $query02 = Recaudacion::VerListaFormulariodetalles_Uno($id_formulario01); //SISMED
      }else if($existe1 == 0 && $existe2 == 1 ){ 
        $query02 = Recaudacion::VerListaFormulariodetalles_Uno($id_formulario02); //RDR
      }else{
        $query02 = Recaudacion::VerListaFormulariodetalles($id_formulario01,$id_formulario02); //AMBOS
      }    

/*
      if($existe3 >= 1 && $existe4 == 0 ){
          $query03 = Recaudacion::VerFormulario_Deposito($id_formulario01); //SISMED
      }else if($existe3 == 0 && $existe4 >= 1 ){ 
          $query03 = Recaudacion::VerFormulario_Deposito($id_formulario02); //RDR
      }else if($existe3 == 1 && $existe4 >= 1 ){
          $query03 = Recaudacion::VerFormulario_Deposito($id_formulario01); //AMBOS
          $query04 = Recaudacion::VerFormulario_Deposito($id_formulario02); //AMBOS
      }else{
          $query03='';
      }
*/

      if($existe1 == 1 && $existe2 == 0 ){ //SISMED
        $renaes= $query02[0][0];
        $nombre_establecimiento= $query02[0][1];
        $fecha= $query02[0][2];
        $mes= $query02[0][4];
        $dia= $query02[0][5];
        $cantidad_total = $query02[0][8];
        $monto_total = $query02[0][9];
        $SISMED_BOLINI = $query02[0][6];
        $SISMED_BOLFIN = $query02[0][7];
        $SISMED_CANT = $query02[0][8];
        $SISMED_MONTO = $query02[0][9];
        $RDR_BOLINI = '';
        $RDR_BOLFIN = '';
        $RDR_CANT = '0';
        $RDR_MONTO = '000';

        }else if($existe1 == 0 && $existe2 == 1 ){ //RDR
            $renaes= $query02[0][0];
            $nombre_establecimiento= $query02[0][1];
            $fecha= $query02[0][2];
            $mes= $query02[0][4];
            $dia= $query02[0][5];
            $cantidad_total = $query02[0][8];
            $monto_total = $query02[0][9];
            $SISMED_BOLINI = '';
            $SISMED_BOLFIN = '';
            $SISMED_CANT = '0';
            $SISMED_MONTO = '000';
            $RDR_BOLINI = $query02[0][6];
            $RDR_BOLFIN = $query02[0][7];
            $RDR_CANT = $query02[0][8];
            $RDR_MONTO = $query02[0][9];

        }else{ //AMBOS
            $renaes= $query02[0][0];
            $nombre_establecimiento= $query02[0][1];
            $fecha= $query02[0][2];
            $mes= $query02[0][4];
            $dia= $query02[0][5];
            $cantidad_total = $query02[0][14];
            $monto_total = $query02[0][15];
            $SISMED_BOLINI = $query02[0][6];
            $SISMED_BOLFIN = $query02[0][7];
            $SISMED_CANT = $query02[0][8];
            $SISMED_MONTO = $query02[0][9];
            $RDR_BOLINI = $query02[0][10];
            $RDR_BOLFIN = $query02[0][11];
            $RDR_CANT = $query02[0][12];
            $RDR_MONTO = $query02[0][13];
        }

        $fecha =date("d-m-Y", strtotime($fecha));
        //var_dump($query02);

      ?>

      <div id="resultados"></div>
      <div class="row">
        <div class="panel panel-primary panel-head"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Registro de Recaudación Diaria</h3> 

            <div class="panel-tools">
              <div class="button btn-actualizar"><a href="#"><i class="fa fa-floppy-o"></i><span>Guardar</span></a></div>
              <div class="button"><a href="./todosformatos"><i class="fa fa-credit-card"></i><span>Depositar</span></a></div>
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

<!--
                        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                            <input class="form-control" type="text" value="" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
-->
                        <input id="mod_fecha" type="text" class="form-control" value="<?php echo $fecha;?>" readonly="">
                        
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                        <label class="col-md-4 col-xs-12 control-label">Boletas RDR:</label>
                        <div class="col-md-4 col-xs-6 addal">
                          <input class="form-control onlynumber" type="text" name="bolinirdr" id="bolinirdr" value="<?php echo $RDR_BOLINI;?>">
                        </div>
                       
                        <div class="col-md-4 col-xs-6">
                          <input class="form-control onlynumber" type="text" name="bolfinrdr" id="bolfinrdr" value="<?php echo $RDR_BOLFIN;?>">
                        </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group">
                        <label class="col-md-4 col-xs-12 control-label">Boletas SISMED:</label>
                        <div class="col-md-4 col-xs-6 addal">
                          <input class="form-control onlynumber" type="text" name="bolinisismed" id="bolinisismed" value="<?php echo $SISMED_BOLINI;?>">
                        </div>
                       
                        <div class="col-md-4 col-xs-6">
                          <input class="form-control onlynumber" type="text" name="bolfinsismed" id="bolfinsismed" value="<?php echo $SISMED_BOLFIN;?>">
                        </div>
                  </div>
                </div>
              </div>

              <?php  
/*
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
            <?php } */?>
            
            <div class="col-md-4" style="margin: 10px 0;">
                <div class="row">
                  <div class="form-group">
                      <label for="mod_nombre" class="col-sm-3 col-xs-12 control-label">Renipres:</label>
                      <div class="col-md-9 col-xs-12">
                          <input type="text" class="form-control" value="<?php echo $nombre_establecimiento?>" readonly="">
                          <input id="mod_Establecimiento" type="hidden" class="form-control" value="<?php echo $renaes?>" readonly="">
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
                      <td><input id="cantidad-total" type="text" class="celdas_disable-3 form-control" value="<?php echo $cantidad_total;?>" style="border:none"/></td>
                      <td><input id="monto-total" type="text" value="<?php echo $monto_total;?>" name="type-price" class="celdas_disable-3 type-price form-control" style="border:none"/></td>
                    </tr>
                    <tr class="disable-3-css">
                      <td>FILA</td>
                      <td>MEF</td>
                      <td>TOTAL GENERAL DEL DIA R.D.R (1+5+7+26+71+73)</td>
                      <td><input id="cantidad-RDR" type="text" class="celdas_disable-3 form-control" value="<?php echo $RDR_CANT;?>" style="border:none"/></td>
                      <td><input id="monto-RDR" type="text" value="<?php echo $RDR_MONTO;?>" name="type-price" class="celdas_disable-3 type-price form-control" style="border:none"/></td>
                    </tr>
                    <tr class="disable-3-css">
                      <td>FILA</td>
                      <td>MEF</td>
                      <td>TOTAL GENERAL DEL DIA SISMED(3)</td>
                      <td><input id="cantidad-SISMED" type="text" class="celdas_disable-3 form-control" value="<?php echo $SISMED_CANT;?>" style="border:none"/></td>
                      <td><input id="monto-SISMED" type="text" value="<?php echo $SISMED_MONTO;?>" name="type-price" class="celdas_disable-3 type-price form-control"  style="border:none"/></td>
                    </tr>
                      <?php

                        foreach ($query01 as $key => $value) {

                          $id= $value[0];
                          $clasificador= $value[1];
                          $descripcion= $value[3];
                          $class_padre= $value[2];
                          $estado= $value[6];
                          $cantidad= $value[4];
                          $monto= $value[5];

                          /*echo '<tr>';*/
/*                          echo '<td>',$id,'</td>';*/

                          switch ($class_padre) {
                            case '0':
                              echo '<tr class="disable-1-css" style="color:#000 !important;">';
                              echo '<td>',$id,'</td>';
                              echo '<td><b>',$clasificador,'</b></td>';
                              echo '<td><b>',$descripcion,'</b></td>';
                              echo '<td style="width: 60px; padding: 4px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable form-control" value="',$cantidad,'" style="border:none"/></td>';
                              echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="',$monto,'" name="type-price" class="celdas_disable type-price form-control" style="border:none"/></td>';
                              echo '</tr>';
                            break;

                            default:
                              if($estado =='0'){
                                  echo '<tr class="disable-2-css">';
                                  echo '<td>',$id,'</td>';
                                  echo '<td>',$clasificador,'</td>';
                                  echo '<td>',$descripcion,'</td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input id="cantidad-',$id,'" type="text" class="celdas_disable-2 form-control" value="',$cantidad,'"/></td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input id="monto-',$id,'" type="text" value="',$monto,'" name="type-price" class="celdas_disable-2 type-price form-control" /></td>';
                                  echo '</tr>';
                              }else{
                                  echo '<tr>';
                                  echo '<td>',$id,'</td>';
                                  echo '<td>',$clasificador,'</td>';
                                  echo '<td>',$descripcion,'</td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input onKeyUp="Suma_Cant_Padre',$class_padre,'();Suma_Cant_Total()" id="cantidad-',$id,'" type="text" class="form-control" value="',$cantidad,'" /></td>';
                                  echo '<td style="width: 60px; padding: 5px 2px;"><input onKeyUp="Suma_Monto_Padre',$class_padre,'();Suma_Monto_Total()" id="monto-',$id,'" type="text" value="',$monto,'" name="type-price" class="type-price form-control" /></td>';
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