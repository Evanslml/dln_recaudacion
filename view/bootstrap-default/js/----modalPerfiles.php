<?php

?>
<script>
	var $ = jQuery.noConflict();
	$(document).ready(function(){



	function ActualizarPerfil(){
		var Idperfil = $("#mod_id").val();
		var perfil = $("#mod_perfil").val();
		var descripcion = $("#mod_descripcion").val();
		var nFilas = $(".mod_nlistas li").length;
		var array = new Array();

		if(perfil ==''){
			  //alert("Debe ingresar el nombre del perfil");
			  $("#mod_mensaje").html('<div class="alert alert-danger" role="alert">\
	          <button type="button" class="close" data-dismiss="alert">&times;</button>\
	          <strong>Error!</strong> \
	          Debe ingresar el nombre del perfil</div>');
	          return false;
		}else if(descripcion ==''){
			  //alert("Debe ingresar una descripción para el perfil");
			  $("#mod_mensaje").html('<div class="alert alert-danger" role="alert">\
	          <button type="button" class="close" data-dismiss="alert">&times;</button>\
	          <strong>Error!</strong> \
	          Debe ingresar una descripción para el perfil</div>');
			  return false;
		} else{

				array.push(Idperfil,perfil,descripcion);
				for (var i = 1; i <= nFilas; i++) {
					var j = zeroFill(i,2);
					var x = 'x'.concat(j);
					var MyCheck = 'mod_MyCheck'.concat(j);

					var x = document.getElementById(MyCheck).checked;
					if (x ==true){
						array.push(j);
					}
				}

				//console.log(nFilas);
				//console.log(array);

				 $("#mod_mensaje").html('<div class="alert alert-success" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Bien!</strong> \
                      Se modificó el perfil satisfactoriamente</div>');

		          $.ajax({
		          type: 'POST',
		          url: './public/user/ajax/Perfiles.php?action=editarperfil',
		          data: { 'data1':JSON.stringify(array) } ,
		          success: function (response) {

		              setTimeout(function(){
		                    //$('#nuevo_Perfil').modal('hide');
		                    //location.reload();
		                    NewURL("perfiles","","");

		              },1500);
		              console.log(response);
		          },
		          error: function () {
		              alert("error");
		          }
		      	}); 


		}

	}



	});
</script>