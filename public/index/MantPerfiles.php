<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>

<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
<?php include 'public/modal/modal_perfiles.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">
	
        <div class="col-md-12">
          <h3><i class="fa fa-edit"></i>Administrador de perfiles</h3>
        </div>
 
        <div class="col-md-12">

        <div class="row">
        	<div class="col-xs-12">
        		<button data-toggle="modal" title="Crear Perfil" onclick="" data-target="#nuevo_Perfil"  class="btn btn-primary"><i class="fa fa-user"></i> Agregar Perfil</button>
        	</div>
        </div>
          <div class="box box-primary">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 content">
              <?php //var_dump($_ListaPerfil);?>
				
				<div class="table-responsive">
  					<table class="table table-striped ">
						<thead>
							<tr>
								<th>#</th>
								<th>Perfil</th>
								<th>Descripción</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						
							<?php
								foreach ($_ListaPerfil as $key => $value) {

									$id= $key;
									$perfil= $value[1];
									$descripcion= $value[3];

									echo '<input type="hidden" value="',$id,'" id="id',$id,'"/>';
									echo '<input type="hidden" value="',$perfil,'" id="perfil',$id,'"/>';
									echo '<input type="hidden" value="',$descripcion,'" id="descripcion',$id,'"/>';

									echo '<tr>';
									echo '<td>',$id,'</td>';
									echo '<td>',$perfil,'</td>';
									echo '<td>',$descripcion,'</td>';
									echo '<td>';
									echo '<a data-toggle="modal" onclick="obtener_datos(',$id,')" data-target="#editar_Perfil" class="btn-accion"><i class="fa fa-pencil"></i></a>';
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
<script src="<?php echo URL_VIEW; ?>bootstrap-default/js/modalPerfiles.js"></script>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>