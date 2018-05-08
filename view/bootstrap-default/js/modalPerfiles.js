	
	function obtener_datos(id){
		var a=zeroFill(id,2)
		$("#mod_id").val(a);

//		var parametros = 'data='+a;
//				$.ajax({
//		              type: 'POST',
//		              url: './public/modal/modal_perfiles.php?action=json',
//		              data: { 'data': parametros } ,
//		              success: function (response) {
//		                  console.log(response);
//		              },
//		              error: function () {
//		                  alert("error");
//		              }
//          		}); 
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
/*
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

*/