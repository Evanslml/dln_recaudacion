<?php

require_once('../../../core/core.php');
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';    

    //SAVE VOUCHER
    if($action == 'json'){

        //header('Content-Type: text/plain');
        /*
        if (isset($_REQUEST['myData'])){
            $param = json_decode($_REQUEST['myData']);    
        }else{
            $param ="Variable no definida";
        }*/

        //$decoded = json_decode($_GET['myData'],true);
        
        //echo "json";
        //var_dump($decoded);
/*
         foreach($param  as $val){
            echo "<br> - valor: ".$val;
        }
*/
        $data = json_decode($_POST['data1']);
        $id_usuario= $_ListaUsuario[$_SESSION['sesion_id']]['MUSU_ID'];
        $vouchers = array();
        $fechas = array();
        $montos = array();

        foreach($data  as $key=>$val){

            if($key ==0){
                $id = $val;

            } else if($key ==1){
                $nFilas = $val;

            } else if(($key+1) %3 == 0){
                $vouchers[] = $val;

            }else if(($key +3) %3 == 0){
                $fechas[] = $val;

            }else if(($key+2) %3 == 0){
                $montos[] = $val;

            } /*else{
                echo "<br> - valor: ".$val;
            }*/
        }
        
        //echo $vouchers[1];

        $now = new DateTime();
        $h=$now->format('Y-m-d H:i:s');
        
        for ($i=1; $i<=$nFilas; $i++) {
            $n= $i-1; 
            $e = date($fechas[$n]);
            $f = date("Y-m-d", strtotime($e));
            $new= 'IngresoVoucher' . $n;
            $new = new RecaudacionVoucher($id,$vouchers[$n],$f,$montos[$n],1,$h,$id_usuario);
            $new->IngresoVocuherRecaudacion();
        }

        var_dump($new);
        

    }


    //PAGINATION
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

        $numrows = Recaudacion::CantidadTotalRecaudacionFecha($e,$fecha_inicio,$fecha_final);

        //var_dump($numrows);
        $total_pages = ceil($numrows/$per_page);

        $reload = './public/index/AllFormat.php';
        $query = Recaudacion::BuscarRecaudacionFecha($e,$fecha_inicio,$fecha_final,$offset,$per_page);
        //var_dump($query);
        //var_dump($_ListaUsuario[$_SESSION['sesion_id']][5]);

        //loop through fetched data

        $perf_id =$_usuario[$_SESSION['sesion_id']]['MPERF_ID'];

        if ($numrows>0){
            ?>

            <div class="table-responsive table_hover_select">
              <table class="table table-striped">
                <thead>
                    <tr class="info"> 
                        <td> <span><b>ID Formulario</b></span> </td> 
                        <td> <span><b>Establecimiento</b></span> </td> 
                        <td> <span><b>Fecha</b></span> </td> 
                        <td> <span><b>Tipo</b></span> </td> 
                        <td> <span><b>Boleta INICIO</b></span> </td> 
                        <td> <span><b>Boleta FIN</b></span> </td> 
                        <td> <span><b>Cantidad Total</b></span> </td> 
                        <td> <span><b>Monto Total</b></span> </td> 
                        <td> <span><b>Acción</b></span> </td> 
                    </tr>
                    
                </thead>
                <tbody>

                    <?php
                    foreach ($query as $key => $value) {

                        if($value[9]=='1'){
                        echo '<tr style="background:#dff0d8;color:#000 !important">';
                        } else{
                        echo '<tr>';   
                        }
                        echo '<td>',$value[0],'</td>'; //ID
                        echo '<td>',$value[10],'</td>'; //
                        echo '<td>',$value[3],'</td>'; //Fecha
                        
                        if($value[4]=='01'){
                        echo '<td>SISMED</td>'; //Fecha
                        }else{
                        echo '<td>R.D.R</td>'; //Fecha
                        }
                        echo '<td>',$value[5],'</td>'; //
                        echo '<td>',$value[6],'</td>'; //
                        echo '<td>',$value[7],'</td>'; 
                        echo '<td style="padding: 8px 15px;"> S/. <span class="pull-right">',$value[8],'</span></td>'; 
                        echo '<td>';
                        echo '<a href="#" class="btn btn-default btn-accion" title="Imprimir formulario" onclick="imprimir(',$value[0],');"><i class="fa fa-print"></i></a>'; //
                        if( (($value[9]=='0') && ($perf_id=='01')) || (($value[9]=='0') && ($perf_id=='02')) ) {
                        echo '<form id="EditarFormulario" action="./editarformato" method="post" style="display: inline-block;">
                         <input type="hidden" name="Idformulario" value="',$value[0],'" />
                         <button type="submit" class="btn btn-default btn-accion"><i class="fa fa-pencil"></i></button>
                        </form>
                        '; 
                        }
                        if($value[9]=='0'){
                        echo '<a data-toggle="modal" data-target="#Ingreso_Voucher" class="btn btn-default btn-accion" title="Agregar Voucher" 
                        onclick="agregar(',$value[0],',',$value[8],');"><i class="fa fa-credit-card"></i></a>'; //
                        }
                        echo '</td>'; 
                        echo  '</tr>';
                    }
                    ?>

                <tr style="background: #fff">
                    <td colspan=9>
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