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
        case 'todosformatos':
        case 'formato':
        ?>
          <script src="<?php echo URL_VIEW; ?>bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
          <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>';-->

        <?php  
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