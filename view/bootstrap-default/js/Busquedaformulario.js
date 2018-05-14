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
//--------------------------------------------------------------------------
          
          formatprice();
          formatdate();

//Add row Table          
//--------------------------------------------------------------------------
            $("#btnAdd").bind("click", function () {
                var div = $("<tr />");
                div.html(GetDynamicTextBox('Ingrese N° Voucher',yyyy+'-'+mm+'-'+dd,'000'));
                $("#TextBoxContainer").append(div);
            });
            $("body").on("click", ".remove", function () {
                $(this).closest("tr").remove();
            });

//BTN save modal
//--------------------------------------------------------------------------
          $("#btn_submit").click(function(event){
            event.preventDefault();
            
            var id = $("#mod_idForm").val();
            var montototal = $("#mod_monto").val();
            var nFilas = $("#TextBoxContainer tr").length;
            var array = new Array();
            
            array.push(id,nFilas);
            
            for (var i = 1; i <= nFilas; i++) {
              
                  var vouchers = 'voucher'.concat(i);
                  var fechas = 'fecha'.concat(i);
                  var montos = 'monto'.concat(i);

                  var vouchers = $("#TextBoxContainer tr:nth-child("+i+") td input#voucher").val();
                  if(vouchers.length == 0){
                    $("#mensaje").html('<div class="alert alert-danger" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Error!</strong> \
                      Debe Ingresar el número de operación del voucher en la fila'+ i +'</div>');
                    return false;
                  }
                  var fechas = $("#TextBoxContainer tr:nth-child("+i+") td input#fecha").val();
                  if(fechas.length == 0){
                    $("#mensaje").html('<div class="alert alert-danger" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Error!</strong> \
                      Debe Ingresar la fecha del depósito del voucher en la fila '+ i +'</div>');
                    return false;
                  }
                  var montos = (Number($("#TextBoxContainer tr:nth-child("+i+") td input#price").unmask())/100).toFixed(2);
                  if(montos == '0.00'){
                    $("#mensaje").html('<div class="alert alert-danger" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Error!</strong> \
                      Debe Ingresar un monto en la fila '+ i +'</div>');
                    return false;
                  }
                  
                  array.push(vouchers,fechas,montos);
              //console.log(array[i]);
            }

            var montoingresado = new Array();
            array.forEach( function(valor, indice, array) {
                //console.log("En el índice " + indice + " hay este valor: " + valor);
                if(indice ==0 && valor=='0.00'){
                    alert("Error : Intente nuevamente");
                    return false;
                } else if(indice ==1 && valor=='000000000000000'){
                    alert("Error : Intente nuevamente");
                    return false;
                } else if(indice > 1 && (indice+2) %3 ==0 ){
                    montoingresado.push(valor*100);
                }
            });

            //Calculando suma monto
            //console.log(montoingresado);
            sumamontoingresado = 0;
            montoingresado.forEach( function(valor, indice, array){
              sumamontoingresado += parseInt(valor);
            });

            sumamontoingresado = ((sumamontoingresado)/100).toFixed(2);
            console.log(sumamontoingresado);

            if(sumamontoingresado != montototal){
              $("#mensaje").html('<div class="alert alert-danger" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Error!</strong> \
                      El monto total debe de ser '+ montototal +'</div>');
              return false;
            } else{
              $("#mensaje").html('<div class="alert alert-success" role="alert">\
                      <button type="button" class="close" data-dismiss="alert">&times;</button>\
                      <strong>Bien!</strong> \
                      Se guardo satisfactoriamente los datos</div>');
             //console.log(array);
              $.ajax({
                      type: 'POST',
                      url: './public/user/ajax/AllFormularios.php?action=json',
                      data: { 'data1':JSON.stringify(array) } ,
                      success: function (response) {

                          setTimeout(function(){
                                //$('#Ingreso_Voucher').modal('hide');
                                location.reload();
                          },1500); 
                          console.log(response);
                      },
                      error: function () {
                          alert("error");
                      }
                  }); 

            }

 /*         
            var voucher1 = $("#TextBoxContainer tr:nth-child(1) td input#voucher").val();
            var fecha1 = $("#TextBoxContainer tr:nth-child(1) td input#fecha").val();
            var monto1 = $("#TextBoxContainer tr:nth-child(1) td input#price").unmask();            

            var voucher2 = $("#TextBoxContainer tr:nth-child(2) td input#voucher").val();
            var fecha2 = $("#TextBoxContainer tr:nth-child(2) td input#fecha").val();
            var monto2 = $("#TextBoxContainer tr:nth-child(2) td input#price").unmask();
            
            //$('#Ingreso_Voucher').modal('hide');  //Si todo sale bien cerrar

            console.log("N°: "+ nFilas + " V: " + voucher1 + " F: " + fecha1 + " m: " +monto1);
            console.log("N°: "+ nFilas + " V: " + voucher2 + " F: " + fecha2 + " m: " +monto2);
   */         
          });
//---------------------------------------------------------


      }); // -Ready Function

      function GetDynamicTextBox(a,b,c) {
        
        return '<td><input id="voucher" name = "voucher" type="text" placeholder = "' + a + '" class="form-control" /></td>' + 
        '<td><script> formatdate(); </script><input id="fecha" name="fecha" type="text" placeholder= "' + b + '" class="form-control inputdate" /></td>' +
        '<td><script> formatprice(); </script><input id="price" type="text" name="type-price" class="type-price form-control" value="'+ c +'" /></td>' + 
        '<td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>';
    }


    function load(page){
      //var fi= $("#datepicker1 input").val();
      //var ff= $("#datepicker2 input").val();
      //var e = $("#id_establecimiento").val();
      var fecha_inicio = document.getElementById("fecha_inicio").value;
      var fecha_final = document.getElementById("fecha_final").value;
      var c = document.getElementById("id_establecimiento").value;
      
      if(c=='00000'){
        var d = document.getElementById("mod_Establecimiento").value;
        var e = d;
      }else{
        var e = c;
      }

      //alert(e);

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


    } //LOAD

    function editar(parametro){
      var a= parametro;
      alert(a);
    }   


    function agregar(a,b){
      $("#mensaje").html("");
      $('#TextBoxContainer tr td:nth-child(1) input').val('');
      $('#TextBoxContainer tr td:nth-child(2) input').val('');
      $('#TextBoxContainer tr td:nth-child(3) input').val('S/ 0.00');
      var id = zeroFill(a,13);
      var monto = b.toFixed(2) ;
      $("#mod_idForm").val(id);
      $("#mod_monto").val(monto);
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