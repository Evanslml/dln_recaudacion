<?php
	
	if (isset($_SESSION['sesion_id'])){
?>

	<div class="modal fade" id="crear_Perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Crear Perfil</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       		<form action="<?php echo  URL_WEB,'usuario&mode=deshabilitar'?>" method="POST">
	       			<p class="text-danger"><i class="fa fa-exclamation-circle"></i> Está seguro de deshabilitar el Usuario</p>
	       			<input type="hidden" name="mod_idDelete" id="mod_idDelete">
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