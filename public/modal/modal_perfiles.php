<?php
	
	if (isset($_SESSION['sesion_id'])){

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';   
?>

	
	<div class="modal fade" id="editar_Perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Editar Perfil</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			
			<?php

			 if($action == 'json'){

			 	echo 'hola';
			 }

			 ?>
	      		<?php 
	      		//$permioso = Permiso('02');
	      		//var_dump($permioso);
	      		?>
	       		<form action="" method="POST">
	       			<p class="text-danger"><i class="fa fa-exclamation-circle"></i> Está seguro de deshabilitar el Usuario</p>
	       			<input type="hidden" name="mod_id" id="mod_id">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Aceptar</button>
	        	</form>
	      </div>
	    </div>
	  </div>
	</div>













<?php
   	} 
?>