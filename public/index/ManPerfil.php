<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
<?php include 'public/user/ajax/ActualizarPerfil.php';?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">

        <div class="col-md-12">
          <h3><i class="fa fa-edit"></i>Modificar Perfil de Usuario</h3>
        </div>
 
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <img src="<?php echo URL_VIEW.'bootstrap-default/img/'.$_usuario[$_SESSION['sesion_id']]['MUSU_IMG']; ?>" class="user-panel"/>
            </div>

            <div class="col-md-9 col-sm-9 col-xs-12 content">
              <form class="form-horizontal" action="<?php echo  URL_WEB,'perfil&mode=actualizar' ?>" method="POST">
                <div class="form-group">
                  <label class="col-lg-3 control-label">Nombre:</label>
                  <div class="col-lg-8">
                    <input class="form-control" type="text" name="p_nombre" id="p_nombre" value="<?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_NOMBRES'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Usuario:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="p_usuario" id="p_usuario" value="<?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_LOGIN'];?>" disabled="true">
                    <input type="hidden" name="email" id="email" value="<?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_LOGIN'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Cambiar Contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" name="p_pass_1" id="p_pass_1" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Repetir contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" name="p_pass_2" id="p_pass_2" value="">
                    <input class="form-control" type="hidden" name="form_perfil" id="form_perfil" value="1">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" value="Guardar" id="gd-perfil">
                    <span></span>
                    <input type="reset" class="btn btn-default" value="Cancel" id="cn-perfil">
                    <a href="index.php" class="hide salir">Salir</a>
                  </div>
                </div>
                
                <?php
                if(isset($mensaje) and isset($class)){
                  echo '<div class="col-md-1"></div><div class="col-md-10"><div class="alert alert-'.$class.'">',$mensaje,'</div></div>';
                }?>
              </form>
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
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>