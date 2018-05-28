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
                <span id="loader"></span>
				        <div id="resultados"></div><!-- Carga los datos ajax -->
              	<div class='outer_div'></div>
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