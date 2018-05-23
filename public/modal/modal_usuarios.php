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
	        	
	        <form action="<?php echo  URL_WEB,'usuario&mode=modificar'?>" class="form-horizontal" method="post">
				<!--<div id="resultados_ajax2"></div>-->
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_nombres" name="mod_nombres" style="text-transform:uppercase">
						<input type="hidden" name="mod_id" id="mod_id">
					</div>
				  </div>
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_usuario" name="mod_usuario" readonly>
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="mod_telefono" name="mod_telefono">
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Perfil</label>
					<div class="col-sm-8">
						
						<!--<input type="text"  class="form-control" id="mod_perfil" name="mod_perfil" readonly>-->
						  <select class="form-control" id="mod_perfilId" name="mod_perfilId">
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

					  <?php //var_dump($_ListaEstablecimientos)?>
					  <!--<input type="text" class="form-control" id="mod_establecimiento" name="mod_establecimiento"  required>-->

					  		<select class="form-control" id="mod_IdEstablecimiento" name="mod_IdEstablecimiento">
					  			<?php foreach ($_ListaEstablecimientos as $key => $value) {
						  		echo '<option value=',$value[3],'>',$value[5],' - ', $value[3] ,' </option>';
							  	}
							  	?>
					  		</select>


					</div>
				  </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Actualizar</button>
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


	<div class="modal fade" id="Habilitar_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Habilitar Usuario</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       		<form action="<?php echo  URL_WEB,'usuario&mode=habilitar'?>" method="POST">
	       			<p class="text-danger"><i class="fa fa-exclamation-circle"></i> Está seguro de habilitar el Usuario</p>
	       			<input type="hidden" name="mod_idAdd" id="mod_idAdd">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Aceptar</button>
	        	</form>
	      </div>
	    </div>
	  </div>
	</div>


	
	<!-- Modal -->
	<div class="modal fade" id="crear_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Crear Usuario</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	
	        <form action="<?php echo  URL_WEB,'usuario&mode=agregar'?>" class="form-horizontal" method="POST">
				<!--<div id="resultados_ajax2"></div>-->
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="new_nombres" name="new_nombres" style="text-transform:uppercase">
						<input type="hidden" name="new_id" id="new_id">
					</div>
				  </div>
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-8">
					  <input type="email" class="form-control" id="new_usuario" name="new_usuario">
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-8">
					  <input type="password" class="form-control" id="new_password" name="new_password">
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="new_telefono" name="new_telefono">
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Perfil</label>
					<div class="col-sm-8">
						  <select class="form-control" id="new_perfilId" name="new_perfilId">
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
					  		<select class="form-control" id="new_IdEstablecimiento" name="new_IdEstablecimiento">
					  			<?php foreach ($_ListaEstablecimientos as $key => $value) {
						  		echo '<option value=',$value[3],'>',$value[5],' - ', $value[3] ,' </option>';
							  	}
							  	?>
					  		</select>
					</div>
				  </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Guardar</button>
	      </div>

	      	</form>
	    </div>
	  </div>
	</div>    <!-- Modal -->



<?php
   	} 
?>