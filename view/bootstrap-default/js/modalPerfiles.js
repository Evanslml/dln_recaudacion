	

	function myPerfil(){

		var perfil = $("#new_perfil").val();
		var descripcion = $("#new_descripcion").val();
		var nFilas = $(".nlistas li").length;
		var array = new Array();
		
		if(perfil ==''){
			alert("Debe ingresar el nombre del perfil");
			 return false;
		}else if(descripcion ==''){
			alert("Debe ingresar una descripción para el perfil");
			 return false;
		}

		array.push(perfil,descripcion);

		for (var i = 1; i <= nFilas; i++) {
			var j = zeroFill(i,2)
			var x = 'x'.concat(j);
			var MyCheck = 'MyCheck'.concat(j);

			var x = document.getElementById(MyCheck).checked;
			if (x ==true){
				array.push(j);
			}
		}
		
		alert(array);

	}

	function obtener_datos(id){
		var a=zeroFill(id,2)
		$("#mod_id").val(a);

			$.ajax({
	              type: 'POST',
	              url: './public/user/ajax/Perfiles.php?action=json',
	              data: { 'data': a } ,
	              success: function (response) {
	                  console.log(response);
	              },
	              error: function () {
	                  alert("error");
	              }
      		}); 
	}

	function zeroFill( number, width )
    {
      width -= number.toString().length;
      if ( width > 0 )
      {
        return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
      }
      return number + ""; // siempre devuelve tipo cadena
    }
