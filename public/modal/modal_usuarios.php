<?php
	
	if (isset($_SESSION['sesion_id'])){
?>
    <!-- Modal -->
	<div class="modal fade" id="Lista_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Editar Usuario</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	
	        <form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
				<!--<div id="resultados_ajax2"></div>-->
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_nombres" name="mod_nombres"  required>
						<input type="hidden" name="mod_id" id="mod_id">
					</div>
				  </div>
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_usuario" name="mod_usuario"  required>
					</div>
				  </div>
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Perfil</label>
					<div class="col-sm-8">
					  <select class="form-control" >
					  	<?php foreach ($_ListaPerfil as $key => $value) {
					  		echo "<option value='$key'>$value[2]</option>";
					  	}
					  	?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Establecimiento</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_establecimiento" name="mod_establecimiento"  required>
					</div>
				  </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>

	      	</form>
	    </div>
	  </div>
	</div>    <!-- Modal -->


	<div class="modal fade" id="Deshabilitar_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Deshabilitar Usuario</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>



<?php
   	} 
?>