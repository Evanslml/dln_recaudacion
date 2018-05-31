
      var $ = jQuery.noConflict();
      $(document).ready(function(){

        var temporal1 = $('#id_establecimiento').val();
        if(temporal1 =='00000'){
          $('#mod_Establecimiento option[value=00000]').attr('selected','selected');
        } //SELECTED DEFAULT
        

        $("#table_recaudacion input").focus(function() {
          $(this).parents('tr').addClass("selected_tr");
        });

        $('#table_recaudacion input').blur(function(){ 
          $(this).parents('tr').removeClass("selected_tr")
        });

        $("#datepicker").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format: 'dd-mm-yyyy'
        }).datepicker('update', new Date());


        /*format price*/
          $('.type-price').priceFormat({
              prefix: 'S/. ',
              centsSeparator: '.',
              thousandsSeparator: ','
          });

        /*input onlynumber*/
          $("#table_recaudacion tbody input, .onlynumber").keypress(function (e) {
           if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
          }
          });

        /*disable*/
          var celdas_disable_1='.celdas_disable';
          var celdas_disable_2='.celdas_disable-2';
          var celdas_disable_3='.celdas_disable-3';
          $(celdas_disable_1).prop('disabled', true).addClass('disable-1-css');
          $(celdas_disable_2).prop('disabled', true).addClass('disable-2-css');
          $(celdas_disable_3).prop('disabled', true).addClass('disable-3-css');

          $('.filterable .btn-filter').click(function(){
              var $panel = $(this).parents('.filterable'),
              $filters = $panel.find('.filters input'),
              $tbody = $panel.find('.table tbody');
              if ($filters.prop('disabled') == true) {
                  $filters.prop('disabled', false);
                  $filters.first().focus();
              } else {
                  $filters.val('').prop('disabled', true);
                  $tbody.find('.no-result').remove();
                  $tbody.find('tr').show();
              }
          });

          $('.filterable .filters input').keyup(function(e){
              /* Ignore tab key */
              var code = e.keyCode || e.which;
              if (code == '9') return;
              /* Useful DOM data and selectors */
              var $input = $(this),
              inputContent = $input.val().toLowerCase(),
              $panel = $input.parents('.filterable'),
              column = $panel.find('.filters th').index($input.parents('th')),
              $table = $panel.find('.table'),
              $rows = $table.find('tbody tr');
              /* Dirtiest filter function ever ;) */
              var $filteredRows = $rows.filter(function(){
                  var value = $(this).find('td').eq(column).text().toLowerCase();
                  return value.indexOf(inputContent) === -1;
              });
              /* Clean previous no-result if exist */
              $table.find('tbody .no-result').remove();
              /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
              $rows.show();
              $filteredRows.hide();
              /* Prepend no-result row if all rows are filtered */
              if ($filteredRows.length === $rows.length) {
                  $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
              }
          });

        /*save*/

        function save_recaudacion(){

          event.preventDefault();
          $(".loading").show();
          var cantidad_total = $('#cantidad-total').val();
          var monto_total = $('#monto-total').val();
          var monto_total = monto_total.slice(4);
          var cantidad_SISMED = $('#cantidad-SISMED').val();
          var monto_SISMED = $('#monto-SISMED').val();
          var monto_SISMED = monto_SISMED.slice(4);
          var cantidad_RDR = $('#cantidad-RDR').val();
          var monto_RDR = $('#monto-RDR').val();
          var monto_RDR = monto_RDR.slice(4);
          var bolinirdr = $('#bolinirdr').val();
          var bolfinrdr = $('#bolfinrdr').val();
          var bolinisismed = $('#bolinisismed').val();
          var bolfinsismed = $('#bolfinsismed').val();
          var date = $('#datepicker input').val();
          var temporal1 = $('#id_establecimiento').val();

          if(temporal1 =='00000'){
            var temporal2 = $('#mod_Establecimiento').val();
            var id_establecimiento = temporal2;
          }else{
            var id_establecimiento = temporal1;
          }

          if(bolinirdr =='' && bolfinrdr=='' && bolinisismed=='' && bolfinsismed==''){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar BOLETAS RDR O SISMED</div>');
              $(".loading img").hide(); return false;
          }else if((bolinirdr !=='' && bolfinrdr=='') || (bolinirdr =='' && bolfinrdr !== '')){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe completar las BOLETAS RDR </div>');
              $(".loading img").hide(); return false;
          }else if((bolinisismed !=='' && bolfinsismed=='') || (bolinisismed =='' && bolfinsismed !== '')){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe completar las BOLETAS SISMED </div>');
              $(".loading img").hide(); return false;
          }else if(parseInt(bolinirdr) >= parseInt(bolfinrdr)){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar las boletas RDR en forma Ascendente </div>');
              $(".loading img").hide(); return false;
          }else if(parseInt(bolinisismed) >= parseInt(bolfinsismed)){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar las boletas SISMED en forma Ascendente </div>');
              $(".loading img").hide(); return false;
          }else if(cantidad_total==0 || monto_total=='0.00'){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar algún monto para realizar la Recaudación Diaria </div>');
              $(".loading img").hide(); return false;
          }else if((bolinisismed =='' || bolfinsismed=='') && (cantidad_SISMED!=='0' || monto_SISMED!=='0.00')) {
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar las boletas de SISMED </div>');
              $(".loading img").hide(); 
              return false;
          }else if((bolinirdr =='' || bolfinrdr=='') && (cantidad_RDR!=='0' || monto_RDR!=='0.00')) {
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar las boletas de RDR </div>');
              $(".loading img").hide(); return false;
          }
          else{

                var array = new Array();
                array.push(bolinirdr,bolfinrdr,bolinisismed,bolfinsismed,date,id_establecimiento,cantidad_total,monto_total,cantidad_SISMED,monto_SISMED,cantidad_RDR,monto_RDR);

                for (var i = 1; i <= 75; i++) {
                  x = '#cantidad-'+i;
                  a = '#monto-'+i;
                  y = 'c'+i;
                  b = 'm'+i;
                  //var m1 = $('#monto-1').unmask();
                  //if(!$('#cantidad-2').val()){var c2=0}else{var c2 = $('#cantidad-2').val();}
                  if(!$(x).val()){var y=0}else{var y = $(x).val();}
                  var b = $(a).unmask();
                  array.push(y,b);
                }

                console.log(array);


                  swal({
                    html:true,
                    title: "<h4>Atención!!! <span>Se van a guardar los datos</span></h4>",
                    text: "<table class='table table-striped'><thead><tr><th><b>Descripción</b></th><th><b>Cantidad</b></th><th><b>Monto</b></th></tr></thead><tbody><tr><th>R.D.R</th><th>"+cantidad_RDR+"</th><th>S/. "+monto_RDR+"</th></tr><tr><th>SISMED</th><th>"+cantidad_SISMED+"</th><th>S/."+monto_SISMED+"</th></tr><tr><th>TOTAL</th><th>"+cantidad_total+"</th><th>S/. "+monto_total+"</th></tr></tbody></table>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#27ae60",
                    confirmButtonText: "Sí, guardar!",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  },
                  function(inputValue){
                    //Use the "Strict Equality Comparison" to accept the user's input "false" as string)
                    if (inputValue===false) {
                      swal.close();
                      $(".loading img").hide();
                    } else {
                      $.ajax({
                            type: 'POST',
                            url: './public/user/ajax/GuardarFormulario.php',
                            data: { 'data1':JSON.stringify(array) } ,
                           beforeSend: function(objeto){
                            $('#btn-save a').attr("disabled", true);
                            $("#resultados").html("Mensaje: Cargando...");
                            },
                          success: function(datos){
                            $('#btn-save a').attr("disabled", false);
                            $("#resultados").html(datos);
                            //$('#datos_caja')[0].reset();
                            console.log(datos);
                            $(".loading").hide(); 
                            swal.close();
                            }
                      });
                      
                    }
                  });



              
          }
        
        } //<!--save_recaudacion-->


        function update_recaudacion(){
            event.preventDefault();
            $(".loading").show();
            var cantidad_total = $('#cantidad-total').val();
            var monto_total = $('#monto-total').val();
            var monto_total = monto_total.slice(4);
            var cantidad_SISMED = $('#cantidad-SISMED').val();
            var monto_SISMED = $('#monto-SISMED').val();
            var monto_SISMED = monto_SISMED.slice(4);
            var cantidad_RDR = $('#cantidad-RDR').val();
            var monto_RDR = $('#monto-RDR').val();
            var monto_RDR = monto_RDR.slice(4);
            var bolinirdr = $('#bolinirdr').val();
            var bolfinrdr = $('#bolfinrdr').val();
            var bolinisismed = $('#bolinisismed').val();
            var bolfinsismed = $('#bolfinsismed').val();
            var date = $('#mod_fecha').val();
            var id_establecimiento = $('#mod_Establecimiento').val();

             if(bolinirdr =='' && bolfinrdr=='' && bolinisismed=='' && bolfinsismed==''){
              $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
              Debe ingresar BOLETAS RDR O SISMED</div>');
              $(".loading img").hide(); return false;
            }else if((bolinirdr !=='' && bolfinrdr=='') || (bolinirdr =='' && bolfinrdr !== '')){
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe completar las BOLETAS RDR </div>');
                $(".loading img").hide(); return false;
            }else if((bolinisismed !=='' && bolfinsismed=='') || (bolinisismed =='' && bolfinsismed !== '')){
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe completar las BOLETAS SISMED </div>');
                $(".loading img").hide(); return false;
            }else if(parseInt(bolinirdr) >= parseInt(bolfinrdr)){
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe ingresar las boletas RDR en forma Ascendente </div>');
                $(".loading img").hide(); return false;
            }else if(parseInt(bolinisismed) >= parseInt(bolfinsismed)){
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe ingresar las boletas SISMED en forma Ascendente </div>');
                $(".loading img").hide(); return false;
            }else if(cantidad_total==0 || monto_total=='0.00'){
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe ingresar algún monto para realizar la Recaudación Diaria </div>');
                $(".loading img").hide(); return false;
            }else if((bolinisismed =='' || bolfinsismed=='') && (cantidad_SISMED!=='0' || monto_SISMED!=='0.00')) {
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe ingresar las boletas de SISMED </div>');
                $(".loading img").hide(); 
                return false;
            }else if((bolinirdr =='' || bolfinrdr=='') && (cantidad_RDR!=='0' || monto_RDR!=='0.00')) {
                $("#resultados").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>\
                Debe ingresar las boletas de RDR </div>');
                $(".loading img").hide(); return false;
            }
            else{
                  var array = new Array();
                  array.push(bolinirdr,bolfinrdr,bolinisismed,bolfinsismed,date,id_establecimiento,cantidad_total,monto_total,cantidad_SISMED,monto_SISMED,cantidad_RDR,monto_RDR);

                  for (var i = 1; i <= 75; i++) {
                    x = '#cantidad-'+i;
                    a = '#monto-'+i;
                    y = 'c'+i;
                    b = 'm'+i;
                    //var m1 = $('#monto-1').unmask();
                    //if(!$('#cantidad-2').val()){var c2=0}else{var c2 = $('#cantidad-2').val();}
                    if(!$(x).val()){var y=0}else{var y = $(x).val();}
                    var b = $(a).unmask();
                    array.push(y,b);
                  }

                  console.log(array);

                  swal({
                    html:true,
                    title: "<h4>Atención!!! <span>Se van a actualizar los datos</span></h4>",
                    text: "<table class='table table-striped'><thead><tr><th><b>Descripción</b></th><th><b>Cantidad</b></th><th><b>Monto</b></th></tr></thead><tbody><tr><th>R.D.R</th><th>"+cantidad_RDR+"</th><th>S/. "+monto_RDR+"</th></tr><tr><th>SISMED</th><th>"+cantidad_SISMED+"</th><th>S/."+monto_SISMED+"</th></tr><tr><th>TOTAL</th><th>"+cantidad_total+"</th><th>S/. "+monto_total+"</th></tr></tbody></table>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#27ae60",
                    confirmButtonText: "Sí, actualizar!",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  },
                  function(inputValue){
                    //Use the "Strict Equality Comparison" to accept the user's input "false" as string)
                    if (inputValue===false) {
                      swal.close();
                      $(".loading img").hide();
                    } else {
                      $.ajax({
                            type: 'POST',
                            url: './public/user/ajax/ActualizarFormulario.php',
                            data: { 'data1':JSON.stringify(array) } ,
                           beforeSend: function(objeto){
                            $('#btn-actualizar a').attr("disabled", true);
                            $("#resultados").html("Mensaje: Cargando...");
                            },
                          success: function(datos){
                            $('#btn-actualizar a').attr("disabled", false);
                            $("#resultados").html(datos);
                            //$('#datos_caja')[0].reset();
                            console.log(datos);
                            $(".loading").hide(); 
                            swal.close();
                            }
                      });
                      
                    }
                  });

            } //ELSE

          //alert("asd");
        }


          $(".btn-save").click(function() {
              save_recaudacion();
          });

          $(".btn-actualizar").click(function() {
              update_recaudacion();
          });

      });