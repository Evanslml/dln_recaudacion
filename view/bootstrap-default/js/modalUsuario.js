	
	var $ = jQuery.noConflict();
    $(document).ready(function(){
      load(1);
    });
      
    function load(page){
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./public/user/ajax/Usuarios?action=ajax&page='+page,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./view/bootstrap-default/img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
        }
      });
    } //LOAD
	
	function obtener_datos(id){
			var id = $("#id"+id).val();
			var usuario = $("#usuario"+id).val();
			var perfilId = $("#perfilId"+id).val();
			var nombres = $("#nombres"+id).val();
			var dni = $("#dni"+id).val();
			var establecimiento = $("#establecimiento"+id).val();
			var IdEstablecimiento = $("#IdEstablecimiento"+id).val();
			var telefono = $("#telefono"+id).val();
	
			$("#mod_id").val(id);
			$("#mod_usuario").val(usuario);
			$("#mod_perfilId").val(perfilId);
			$("#mod_nombres").val(nombres);
			$("#mod_dni").val(dni);
			$("#mod_IdEstablecimiento").val(IdEstablecimiento);
			$("#mod_telefono").val(telefono);
		}

	function deshabilitar_datos(id){
			var id_delete = $("#id"+id).val();
			$("#mod_idDelete").val(id_delete);
	}

	function habilitar_datos(id){
			var id_add = $("#id"+id).val();
			$("#mod_idAdd").val(id_add);
	}

	function datos_default(){
			var new_perfilId='03';
			$("#new_perfilId").val(new_perfilId);
	}

