<?php
require_once 'public/overall/header.php'; 
   if (!isset($_SESSION['sesion_id'])){
    include('public/overall/nosesion.php');
   }
 else { ?>
<?php include 'public/overall/menu-header.php'; ?>
<?php include 'public/overall/menu-aside.php'; ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
 
      <div class="row">

        <div class="col-md-12">
          <h3>Registro de Formato de Recaudación Diaria</h3>
        </div>
 
        <div class="col-md-6">

          <div class="form-group">
              <div class='input-group date' id='datetimepicker1'>
                  <input type='text' class="form-control"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
                  
          <script type="text/javascript">
              $(function () {
                  $('#datetimepicker1').datetimepicker();
              });
          </script>

        </div>
        <div class="col-md-6">
         
        </div>

<?php 
class persona{

    public $nombre;
    public $apellido;
    public $age;


    public fullname($nombre,$apellido){
      $this->$nombre=$nombre;
    }
}

?>



        <div class="col-md-4">
          <div class="box box-primary">
            <?php echo $_usuario[$_SESSION['sesion_id']]['MUSU_NOMBRES']; ?>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-primary">
            
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-primary">
            
          </div>
        </div>
         
        <div class="col-md-4">

        </div><!--col-->
      </div><!--row-->
    </section>
  </div><!--content wrapper-->
 
<?php 
 }
?>
<?php require_once 'public/overall/footer-index.php'; ?>
<?php require_once 'public/overall/footer.php'; ?>