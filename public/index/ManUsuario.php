<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/user/ajax/EditarUsuario.php';?> <!--before to head-->
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
<?php include 'public/modal/modal_usuarios.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">
	
        <div class="col-md-12">
          <h3><i class="fa fa-user"></i> Administrador de usuarios</h3>
        </div>
 		<?php 
 		if (isset($_SESSION['arrayMensaje'])){

 			if(!empty($_SESSION['arrayMensaje'])){
 				//var_dump($_SESSION['arrayMensaje']);
	 			$arrayMensaje=$_SESSION['arrayMensaje'];
	 			echo '<div class="col-md-6" id="result"><div id="resultMessage" class="alert alert-',$arrayMensaje['class'],'" >',$arrayMensaje['mensaje'],'</div></div>';	
 			}
 		}
 		?>
        <div class="col-md-12">

        <div class="row">
        	<div class="col-xs-12">
        		<button data-toggle="modal" title="Agregar Usuario" onclick="datos_default()" data-target="#crear_Usuario"  class="btn btn-primary"><i class="fa fa-user"></i>Agregar Usuario</button>
        	</div>
        </div>
          <div class="box box-primary">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 content">
              <?php //var_dump($_ListaUsuario);?>
				
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
								foreach ($_ListaUsuario as $key => $value) {
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
									echo '<td>',$n,'</td>';
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
						</tbody>
					</table>
				</div>
            </div>
          </div>
          </div>
        </div>

      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<script src="<?php echo URL_VIEW; ?>bootstrap-default/js/modalUsuario.js"></script>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>