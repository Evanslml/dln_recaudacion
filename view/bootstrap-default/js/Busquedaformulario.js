      var $ = jQuery.noConflict();
      $(document).ready(function(){

      $("#calcular_lista").click(function(){
      load(1);
      });
      load(1);

      var date = new Date();
  		var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
  		var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

  		var first = primerDia.getDate()+'-'+(primerDia.getMonth()+1)+'-'+(primerDia.getFullYear());
  		var last  = ultimoDia.getDate()+'-'+(primerDia.getMonth()+1)+'-'+(primerDia.getFullYear());

		    $("#datepicker1").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format: 'dd-mm-yyyy'
        }).datepicker('update', first);		

        $("#datepicker2").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format: 'dd-mm-yyyy'
        }).datepicker('update', last);


//modal voucher
          //var today = new Date(); 
          var d = date.getDate(); 
          var dd = zeroFill(d,2); 
          var m = date.getMonth()+1; 
          var mm = zeroFill(m,2); 
          var yyyy = date.getFullYear(); 

//Format price
          


          formatprice();
          formatdate();

            $("#btnAdd").bind("click", function () {
                var div = $("<tr />");
                div.html(GetDynamicTextBox('Ingrese N° Voucher',yyyy+'-'+mm+'-'+dd,'000'));
                $("#TextBoxContainer").append(div);
            });
            $("body").on("click", ".remove", function () {
                $(this).closest("tr").remove();
            });

          $("#btn_submit").click(function(){
            event.preventDefault();
            

            var nFilas = $("#TextBoxContainer tr").length;
            /*
            for (var i = 0; i <= nFilas; i++) {
              Things[i]
            }*/

            var voucher1 = $("#TextBoxContainer tr:nth-child(1) td input#voucher").val();
            var fecha1 = $("#TextBoxContainer tr:nth-child(1) td input#fecha").val();
            var monto1 = $("#TextBoxContainer tr:nth-child(1) td input#price").unmask();            

            var voucher2 = $("#TextBoxContainer tr:nth-child(2) td input#voucher").val();
            var fecha2 = $("#TextBoxContainer tr:nth-child(2) td input#fecha").val();
            var monto2 = $("#TextBoxContainer tr:nth-child(2) td input#price").unmask();
            
            //$('#Ingreso_Voucher').modal('hide');  //Si todo sale bien cerrar

            console.log("N°: "+ nFilas + " V: " + voucher1 + " F: " + fecha1 + " m: " +monto1);
            console.log("N°: "+ nFilas + " V: " + voucher2 + " F: " + fecha2 + " m: " +monto2);
            
          });



      }); //

      function GetDynamicTextBox(a,b,c) {
        
        return '<td><input id="voucher" name = "voucher" type="text" placeholder = "' + a + '" class="form-control" /></td>' + 
        '<td><script> formatdate(); </script><input id="fecha" name="fecha" type="text" placeholder= "' + b + '" class="form-control inputdate" /></td>' +
        '<td><script> formatprice(); </script><input id="price" type="text" name="type-price" class="type-price form-control" value="'+ c +'" /></td>' + 
        '<td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>'
    }


    function load(page){
      //var fi= $("#datepicker1 input").val();
      //var ff= $("#datepicker2 input").val();
      //var e = $("#id_establecimiento").val();
      var fecha_inicio = document.getElementById("fecha_inicio").value;
      var fecha_final = document.getElementById("fecha_final").value;
      var e = document.getElementById("id_establecimiento").value;
      
      $("#loader").fadeIn('slow');
      $.ajax({
        //url:'./public/user/ajax/AllFormularios.php?action=ajax&page='+page+'&fi='+fi+'&ff='+ff+'&e='+e,
        url:'./public/user/ajax/AllFormularios.php?action=ajax&page='+page+'&e='+e+'&fecha_inicio='+fecha_inicio+'&fecha_final='+fecha_final,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./view/bootstrap-default/img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
        }
      })
    }

    function editar(parametro){
      var a= parametro;
      alert(a);
    }   


    function agregar(parametro){
      var a = zeroFill(parametro,13);
      $("#mod_idForm").val(a);
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

    function formatprice(){
        $('.type-price').priceFormat({
              prefix: 'S/. ',
              centsSeparator: '.',
              thousandsSeparator: ','
          });
    }

    function formatdate(){
          $('.inputdate').datepicker({
          autoclose: true, 
          todayHighlight: true,
          format: 'dd-mm-yyyy'
          })
    }