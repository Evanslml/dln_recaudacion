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
    <div id="sidebar-menu">
    <ul class="sidebar-menu">
      <li class="header">MENU OPCIONES</li>
      <?php 
        //var_dump($_permiso);

        foreach ($_permiso as $key => $value) {
            

            if($value[5]=='0'){

              echo "<li>";
                  echo "<a><i class='".$value[8]."'></i><span>".$value[3]."</span></a>";

                  $id=$value[1]; //MOBJ_ID
                  //echo $id;

                  echo "<ul class=\"nav child_menu\">";
                  foreach ($_permiso as $key1 => $value1) {
                     if($value1[5]==$id){//SI OBJ_PADRE ES IGUAL AL ID
                      echo "<li>";
                      echo "<a href='".URL_WEB.$value1[4]."'><i class='".$value1[8]."'></i><span>".$value1[3]."</span></a>";
                      echo "</li>";
                      }
                  }
                  echo "</ul>";

              echo "</li>";
            }


            
        }

      ?>
      
    
      <!--<li class="active"><a href="<?php echo URL_WEB;?>formato"><i class="fa fa-link"></i> <span>Pruebas</span></a></li>-->
      <!-- Optionally, you can add icons to the links -->
      <!--<li><a href="#"><i class="fa fa-link"></i> <span>Menu General</span></a></li>-->
    </ul>
  </div>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>