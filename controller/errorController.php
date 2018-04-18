<?php
//llamamos desde una carpeta publica el header
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
     //si no existe la sesion enviamos al formulario de inicio de sesion
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php 
//tomamos el control de lo que queremos mostrar en pantalla si se inicia la sesion mostarmos el header el menu y el footer 
include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Página de error..
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php /*se ha creado una constante url_web desde el core para ser utilizada por todo el sitio*/ echo URL_WEB; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">error</li>
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="glyphicon glyphicon-thumbs-down"></i>
 
              <h3 class="box-title">Error 404 Pagina no encontrada ..!</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>Not Found!</h4>
 
                <p>Al parecer esta página no existe o ha sido eliminada por el administrador, si crees que es un error hazlo saber..</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
 
        </div>
      <!-- Contenido de index -->
    </section>
  
 </div><!--//content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer.php'; ?>