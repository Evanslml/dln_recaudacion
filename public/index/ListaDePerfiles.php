<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
<?php include 'public/modal/modal_usuarios.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">
	
        <div class="col-md-12">
          <h3><i class="fa fa-edit"></i>Administrador de perfiles</h3>
        </div>
 
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 content">
              <?php //var_dump($_ListaUsuario);?>
				
				<div class="table-responsive">
  					<table class="table table-striped ">
						<thead>
							<tr>
								<th>#</th>
								<th>Usuario</th>
								<th>Perfil</th>
								<th>Nombres</th>
								<th>Establecimiento</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>

							<?php
								foreach ($_ListaUsuario as $key => $value) {

									$id= $key;
									$usuario= $value[1];
									$perfilId= $value[5];
									$perfil= $value[6];
									$nombres= $value[3];
									$establecimiento= $value[7];

									echo '<input type="hidden" value="',$id,'" id="id',$id,'"/>';
									echo '<input type="hidden" value="',$usuario,'" id="usuario',$id,'"/>';
									echo '<input type="hidden" value="',$perfilId,'" id="perfilid',$id,'"/>';
									echo '<input type="hidden" value="',$nombres,'" id="nombres',$id,'"/>';
									echo '<input type="hidden" value="',$establecimiento,'" id="establecimiento',$id,'"/>';

									echo '<tr>';
									echo '<td>',$id,'</td>';
									echo '<td>',$usuario,'</td>';
									echo '<td>',$perfil,'</td>';
									echo '<td>',$nombres,'</td>';
									echo '<td>',$establecimiento,'</td>';
									echo '<td>';
									echo '<a data-toggle="modal" onclick="obtener_datos(',$id,')" data-target="#Lista_Usuario" class="btn-accion"><i class="fa fa-pencil"></i></a></form>';
									echo '<a data-toggle="modal" onclick="eliminar_datos(',$id,')" data-target="#Deshabilitar_Usuario" class="btn-accion"><i class="fa fa-undo"></i></a>';
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