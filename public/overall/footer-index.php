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

    if(isset($_GET['view'])) {
      $vista = $_GET['view'];

      //var_dump($vista);
      switch ($vista) {
        case 'formato':
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>';
            echo '<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>';
            echo '<link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">';
          break;
        
        default:
          # code...
          break;
      }
    }/*else{

}*/

} 
else{
  //header('location: index.php?view=error');
}
?>