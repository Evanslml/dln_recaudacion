	
	function obtener_datos(id){
			var id = $("#id"+id).val();
			var usuario = $("#usuario"+id).val();
			var perfilid = $("#perfilid"+id).val();
			var nombres = $("#nombres"+id).val();
			var establecimiento = $("#establecimiento"+id).val();
	
			$("#mod_id").val(id);
			$("#mod_usuario").val(usuario);
			$("#mod_perfil").val(perfilid);
			$("#mod_nombres").val(nombres);
			$("#mod_establecimiento").val(establecimiento);
		}

	function eliminar(id){
		
	}