<?php if(isset($_SESSION['sesion_id']))
{
?>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Visitanos en nuestras redes sociales.
    </div>
    <!-- Default to the left -->
    <strong>Copyright © <?php echo date("Y");?> <a href="#">DIRIS Lima Norte</a>.</strong> derechos reservados.
  </footer>
</div>

<?php 

if(isset($_GET['view']) == 'formato1'){
  $view=$_GET['view'];
  echo $view;
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
  <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">

<?php
}



?>



<?php } 
else{
?>

<?php
/*
    echo'
    <div class="row">
        <nav class="navbar navbar-default">
          <div class="navbar-header">
            <a class="navbar-brand"><strong>Usuario:</strong> admin@gmail.com | <strong>Password:</strong> 123456</a>
         </div>
         </nav>
    </div>';
*/
}
?>