<?php

require_once('../../../core/core.php');
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';    

    if($action == 'ajax'){

         if(empty($_REQUEST['fecha_inicio'])){
            $fecha_inicio = new DateTime();
            $fecha_inicio->modify('first day of this month');
            $fecha_inicio = $fecha_inicio->format('Y-m-d');
        }else{
            $fecha_inicio =   date($_REQUEST['fecha_inicio']);
            $fecha_inicio =   date("Y-m-d", strtotime($fecha_inicio));   
        }

         if(empty($_REQUEST['fecha_final'])){
            $fecha_final = new DateTime();
            $fecha_final->modify('last day of this month');
            $fecha_final = $fecha_final->format('Y-m-d');
        }else{
            $fecha_final =   date($_REQUEST['fecha_final']);
            $fecha_final =   date("Y-m-d", strtotime($fecha_final));   
        }
        
         $e =   $_REQUEST['e'];

         /*
         var_dump($fecha_inicio);
         var_dump($fecha_final);
         var_dump($e);
         */
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/

        $numrows = Recaudacion::CantidadTotlaRecaudacionFecha($e,$fecha_inicio,$fecha_final);
        //var_dump($numrows);
        $total_pages = ceil($numrows/$per_page);
        $reload = './public/index/AllFormat.php';
        $query = Recaudacion::BuscarRecaudacionFecha($e,$fecha_inicio,$fecha_final,$offset,$per_page);
        //var_dump($query);
        //var_dump($_ListaUsuario[$_SESSION['sesion_id']][5]);

        //loop through fetched data
        if ($numrows>0){
            ?>

            <div class="table-responsive">
              <table class="table table-striped ">
                <thead>
                    <tr class="info"> 
                        <td> <span><b>ID Formulario</b></span> </td> 
                        <td> <span><b>Establecimiento</b></span> </td> 
                        <td> <span><b>Fecha</b></span> </td> 
                        <td> <span><b>Boleta RDR</b></span> </td> 
                        <td> <span><b>Boleta SISMED</b></span> </td> 
                        <td> <span><b>Cantidad Total</b></span> </td> 
                        <td> <span><b>Monto Total</b></span> </td> 
                        <td> <span><b>Acción</b></span> </td> 
                    </tr>
                    
                </thead>
                <tbody>

                    <?php
                    foreach ($query as $key => $value) {
                        if($value[12]=='1'){
                        echo '<tr style="background:#dff0d8">';
                        } else{
                        echo '<tr>';   
                        }
                        echo '<td>',$value[0],'</td>'; //ID
                        echo '<td>',$value[13],'</td>'; //
                        echo '<td>',$value[3],'</td>'; //Fecha
                        echo '<td>del ',$value[4],' al ',$value[5],'</td>'; //
                        echo '<td>del ',$value[8],' al ',$value[9],'</td>'; //
                        echo '<td>',$value[6] + $value[10],'</td>'; //
                        echo '<td> S/. ',$value[7] + $value[11],'</td>'; //
                        echo '<td>';
                        if($_ListaUsuario[$_SESSION['sesion_id']][5] == '01' || $_ListaUsuario[$_SESSION['sesion_id']][5] == '02' ) {//si es administrador
                        echo '<a href="#" class="btn btn-default btn-accion" title="Editar formulario" onclick="editar(',$value[0],');"><i class="fa fa-pencil"></i></a>'; //
                        }
                        if($value[12]=='0' || $_ListaUsuario[$_SESSION['sesion_id']][5] == '01' || $_ListaUsuario[$_SESSION['sesion_id']][5] == '02'){
                        echo '<a data-toggle="modal" data-target="#Ingreso_Voucher" class="btn btn-default btn-accion" title="Agregar Voucher" 
                        onclick="agregar(',$key,');"><i class="fa fa-credit-card"></i></a>'; //
                        }
                        echo '</td>'; //
                        echo  '</tr>';
                    }
                    ?>

                <tr>
                    <td colspan=8>
                        <span class="pull-right">
                            <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                        <span>
                    </td>
                </tr>
                </tbody>
              </table>
            </div>
            <?php
        }
    }
?>