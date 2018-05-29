<?php

require_once('../../../core/core.php');

    //PAGINATION
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';    
    if($action == 'ajax'){

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 15; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        $numrows = Acceso::ListaUsuarioPerfilpaginationTotal();
        $total_pages = ceil($numrows/$per_page);
        $reload = './public/index/ManUsuario.php';
        $query = Acceso::ListaUsuarioPerfilpagination($offset,$per_page);   
        $perf_id =$_usuario[$_SESSION['sesion_id']]['MPERF_ID'];

        if ($numrows>0){
            ?>

            <div class="table-responsive table_hover_select">
                    <table class="table table-striped overflow-min">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CORREO</th>
                                <th>PERFIL</th>
                                <th>DNI</th>
                                <th>NOMBRES COMPLETOS</th>
                                <th>ESTABLECIMIENTO</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $n=0;
                                foreach ($query as $key => $value) {
                                    $n++;
                                    $id= $key;
                                    $usuario= $value[1];
                                    $perfilId= $value[5];
                                    $perfil= $value[6];
                                    $nombres= $value[3];
                                    $establecimiento= $value[7];
                                    $IdEstablecimiento= $value[8];
                                    $telefono= $value[4];
                                    $dni= $value[10];

                                    echo '<input type="hidden" value="',$id,'" id="id',$id,'"/>';
                                    echo '<input type="hidden" value="',$usuario,'" id="usuario',$id,'"/>';
                                    echo '<input type="hidden" value="',$perfilId,'" id="perfilId',$id,'"/>';
                                    echo '<input type="hidden" value="',$nombres,'" id="nombres',$id,'"/>';
                                    echo '<input type="hidden" value="',$dni,'" id="dni',$id,'"/>';
                                    echo '<input type="hidden" value="',$establecimiento,'" id="establecimiento',$id,'"/>';
                                    echo '<input type="hidden" value="',$IdEstablecimiento,'" id="IdEstablecimiento',$id,'"/>';
                                    echo '<input type="hidden" value="',$telefono,'" id="telefono',$id,'"/>';

                                    if($value[9] =='0'){
                                    echo '<tr class="alert alert-danger">';
                                    }else{
                                    echo '<tr>';
                                    }
                                    //echo '<tr>';
                                    echo '<td>',$id,'</td>';
                                    echo '<td>',$usuario,'</td>';
                                    echo '<td>',$perfil,'</td>';
                                    echo '<td>',$dni,'</td>';
                                    echo '<td>',$nombres,'</td>';
                                    echo '<td>',$establecimiento,'</td>';
                                    echo '<td>';
                                    echo '<a data-toggle="modal" title="editar" onclick="obtener_datos(',$id,')" data-target="#Lista_Usuario" class="btn-accion"><i class="fa fa-pencil"></i></a>';
                                    if($value[9] =='0'){
                                    echo '<a data-toggle="modal" title="Habilitar" onclick="habilitar_datos(',$id,')" data-target="#Habilitar_Usuario" class="btn-accion"><i class="fa fa-reply"></i></a>';
                                    }else{
                                    echo '<a data-toggle="modal" title="Deshabilitar" onclick="deshabilitar_datos(',$id,')" data-target="#Deshabilitar_Usuario" class="btn-accion"><i class="fa fa-share"></i></a>';
                                    }

                                    //echo '<i class="fa fa-undo"></i>';
                                    echo '';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>  
                            <tr>
                                <td colspan=9 style="background: #fff;">
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