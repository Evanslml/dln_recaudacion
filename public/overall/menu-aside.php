<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
 
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
 
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo URL_VIEW.'bootstrap-default/img/'.$_usuario[$_SESSION['sesion_id']]['MUSU_IMG']; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_NOMBRES']; ?></p>
        <!-- Status -->
      </div>
    </div>
 
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <?php 
      $demo= $_usuario[$_SESSION['sesion_id']]['MPERF_ID']; 


      $salt="lu";
      $pass="123456";

      $clave_crypt = crypt($pass, $salt);
      echo $clave_crypt;


      ?>
      
      <p style="color: #f1f1f1">
      <?php
            echo $demo;
      ?>
      </p>


      <li class="header">MENU OPCIONES</li>
      <li class="active"><a href="<?php echo URL_WEB;?>formato"><i class="fa fa-link"></i> <span>Pruebas</span></a></li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Menu General</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>