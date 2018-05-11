<?php
	
	if (isset($_SESSION['sesion_id'])){

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';   
?>

	<div class="modal fade" id="nuevo_Perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Nuevo Perfil</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="http://192.168.0.150:8080/dln_recaudacion/usuario&amp;mode=agregar" class="form-horizontal" method="POST">
				<!--<div id="resultados_ajax2"></div>-->
				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Perfil</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="new_perfil" name="new_perfil" style="text-transform:uppercase">
						<input type="hidden" name="new_id" id="new_id">
					</div>
				  </div>

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Descripción</label>
					<div class="col-sm-8">
					  <input type="email" class="form-control" id="new_descripcion" name="new_descripcion" style="text-transform:uppercase">
					</div>
				  </div>				  

				  <div class="form-group">
					<label for="mod_nombre" class="col-sm-3 control-label">Permisos</label>
					<div class="col-sm-8 nlistas">

						<?php foreach ($_permiso as $key => $value) {
				            if($value[5]=='0'){
				              echo "<li style=\"display: block;\">";
				                  echo "<label class=\"container_checkbox\"> ".$value[3]."<input type=\"checkbox\" id=\"MyCheck".$key."\"><span class=\"checkmark\"></span></label>";
				                  $id=$value[1]; //MOBJ_ID
				                  echo "<ul class=\"nav child_menu\" style=\"padding-left: 35px;\">";
				                  foreach ($_permiso as $key1 => $value1) {
				                     if($value1[5]==$id){//SI OBJ_PADRE ES IGUAL AL ID
				                      echo "<li>";
				                      echo "<label class=\"container_checkbox\"> ".$value1[3]."<input type=\"checkbox\" id=\"MyCheck".$key1."\"><span class=\"checkmark\"></span>";
				                      echo "</li>";
				                      }
				                  }
				                  echo "</ul>";
				              echo "</li>";
				            }
				        } ?>

					</div>
				  </div>
				<?php
		    ?>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary" onclick="myPerfil()">Aceptar</button>
	      </div>
	    </div>
	  </div>
	</div>




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