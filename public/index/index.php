<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
 
<?php
/*
$salt = substr ('jbsb01@hotmail.com', 0, 2);
$clave_crypt = crypt('06855009', $salt);
var_dump($clave_crypt);*/
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil de Usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">perfil de usuario</li>
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?php /*url_view esta constatnte la definimos en el core*/ echo URL_VIEW; ?>bootstrap-default/img/slider/diris.png') center center;background-size: 100%;">
              <h3 class="widget-user-username"><?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_NOMBRES']; ?></h3>
              <h5 class="widget-user-desc"><?php echo $_ListaUsuario[$_SESSION['sesion_id']]['MPERF_NOMBRE'];?></h5>
              <small><?php echo $_ListaUsuario[$_SESSION['sesion_id']]['NEST_NOMBRE']?></small>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo URL_VIEW; ?>bootstrap-default/img/<?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_IMG']; ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <!--<h5 class="description-header">30</h5>
                    <span class="description-text">SEGUIDORES</span>-->
                  </div>
                </div>
 
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <!--<h5 class="description-header">115</h5>
                    <span class="description-text">Me Gusta</span>-->
                  </div>
                </div>
 
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <!--<h5 class="description-header">12</h5>
                    <span class="description-text">Publicaciones</span>-->
                  </div>
                </div>
 
              </div>
              <!-- /.row -->
            </div><!--footer-->
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 
 
 
      <div class="row">
        <div class="col-md-6">
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong>S/. CUENTA EN SOLES - BANCO DE LA NACION (R.D.R)</strong>
              <p class="text-muted"> 00-068-371767 </p>
              <hr>
              <strong>S/. CUENTA EN SOLES - BANCO DE LA NACION (SISMED)</strong>
              <p class="text-muted"> 00-068-371872 </p> 
              <hr>
              <strong><i class="fa fa-caret-square-o-right"></i> Manual de usuario</strong>
              <p>Puedes descargar el manual de Usurio haciendo <a href="#"> click Aquí </a></p>
              <hr>
              <!--<strong><i class="fa fa-pencil margin-r-5"></i> Habilidades</strong>
 
              <p>
                <span class="label label-success">Php</span>
                <span class="label label-danger">Mysql</span>
                <span class="label label-warning">Ajax</span>
                <span class="label label-info">Bootstrap</span>
              </p>
 
              <hr>
 
              <strong><i class="fa fa-pencil margin-r-5"></i> Experto en</strong>
 
              <p>
                <span class="label label-info">Programación</span>
              </p>
 
              <hr>-->
 
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>
              <p>La aplicación se debe registrar diariamente</p>
              <p>Si Ud. encuentra dificultades en la plataforma sirvase a llamar al <b><i class="fa fa-phone"></i> (01) 201-1340 Anexo 152</b> (OFICINA GENERAL DE TECNOLOGIA Y LA INFORMACION) o al correo desarrollo.ti@dirislimanorte.gob.pe</p>
              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
        </div>
 
      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>