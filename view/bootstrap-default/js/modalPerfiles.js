	/*var $ = jQuery.noConflict();
    $(document).ready(function(){
	$('#editar_Perfil').modal('show'); 
	});
*/
	function CrearPerfil(){

		var perfil = $("#new_perfil").val();
		var descripcion = $("#new_descripcion").val();
		var nFilas = $(".nlistas li").length;
		var array = new Array();
		
		if(perfil ==''){
			  //alert("Debe ingresar el nombre del perfil");
			  $("#mensaje").html('<div class="alert alert-danger" role="alert">\
	          <button type="button" class="close" data-dismiss="alert">&times;</button>\
	          <strong>Error!</strong> \
	          Debe ingresar el nombre del perfil</div>');
	          return false;
		}else if(descripcion ==''){
			  //alert("Debe ingresar una descripción para el perfil");
			  $("#mensaje").html('<div class="alert alert-danger" role="alert">\
	          <button type="button" class="close" data-dismiss="alert">&times;</button>\
	          <strong>Error!</strong> \
	          Debe ingresar una descripción para el perfil</div>');
			  return false;
		} else{

				array.push(perfil,descripcion);
				for (var i = 1; i <= nFilas; i++) {
					var j = zeroFill(i,2);
					var x = 'x'.concat(j);
					var MyCheck = 'MyCheck'.concat(j);

					var x = document.getElementById(MyCheck).checked;
					if (x ==true){
						array.push(j);
					}
				}
				
				//alert(array);
				 $("#mensaje").html('<div class="alert alert-success" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Bien!</strong> \
                      Se creó el perfil satisfactoriamente</div>');

		          $.ajax({
		          type: 'POST',
		          url: './public/user/ajax/Perfiles.php?action=nuevoperfil',
		          data: { 'data1':JSON.stringify(array) } ,
		          success: function (response) {

		              setTimeout(function(){
		                    //$('#nuevo_Perfil').modal('hide');
		                    location.reload();
		              },1500);
		              console.log(response);
		          },
		          error: function () {
		              alert("error");
		          }
		      	}); 


        }

	}


	function obtener_datos(id){
		var a=zeroFill(id,2)
      	NewURL("perfiles","editid",a);
	}

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


    function NewURL($a,$b,$c) {

		var str0 = "./";
		var str1 = $a;
		var str2 = "?";
		var str3 = $b;
		var str4 = "=";
		var str5 = $c;
		var url = str0.concat(str1,str2,str3,str4,str5);
        
        window.location.assign(url);
    }


	function zeroFill( number, width ) {
      width -= number.toString().length;
      if ( width > 0 )
      {
        return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
      }
      return number + ""; // siempre devuelve tipo cadena
    }
