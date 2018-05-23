
      var $ = jQuery.noConflict();
      $(document).ready(function(){

    
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
          $(celdas_disable_1).prop('disabled', true).addClass('disable-1-css');
          $(celdas_disable_2).prop('disabled', true).addClass('disable-2-css');

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

          if(!$('#cantidad-1').val()){var c1=0}else{var c1 = $('#cantidad-1').val();}          
          if(!$('#cantidad-2').val()){var c2=0}else{var c2 = $('#cantidad-2').val();}
          if(!$('#cantidad-3').val()){var c3=0}else{var c3 = $('#cantidad-3').val();}
          if(!$('#cantidad-4').val()){var c4=0}else{var c4 = $('#cantidad-4').val();}
          if(!$('#cantidad-5').val()){var c5=0}else{var c5 = $('#cantidad-5').val();}
          if(!$('#cantidad-6').val()){var c6=0}else{var c6 = $('#cantidad-6').val();}
          if(!$('#cantidad-7').val()){var c7=0}else{var c7 = $('#cantidad-7').val();}
          if(!$('#cantidad-8').val()){var c8=0}else{var c8 = $('#cantidad-8').val();}
          if(!$('#cantidad-9').val()){var c9=0}else{var c9 = $('#cantidad-9').val();}
          if(!$('#cantidad-10').val()){var c10=0}else{var c10 = $('#cantidad-10').val();}
          if(!$('#cantidad-11').val()){var c11=0}else{var c11 = $('#cantidad-11').val();}
          if(!$('#cantidad-12').val()){var c12=0}else{var c12 = $('#cantidad-12').val();}
          if(!$('#cantidad-13').val()){var c13=0}else{var c13 = $('#cantidad-13').val();}
          if(!$('#cantidad-14').val()){var c14=0}else{var c14 = $('#cantidad-14').val();}
          if(!$('#cantidad-15').val()){var c15=0}else{var c15 = $('#cantidad-15').val();}
          if(!$('#cantidad-16').val()){var c16=0}else{var c16 = $('#cantidad-16').val();}
          if(!$('#cantidad-17').val()){var c17=0}else{var c17 = $('#cantidad-17').val();}
          if(!$('#cantidad-18').val()){var c18=0}else{var c18 = $('#cantidad-18').val();}
          if(!$('#cantidad-19').val()){var c19=0}else{var c19 = $('#cantidad-19').val();}
          if(!$('#cantidad-20').val()){var c20=0}else{var c20 = $('#cantidad-20').val();}
          if(!$('#cantidad-21').val()){var c21=0}else{var c21 = $('#cantidad-21').val();}
          if(!$('#cantidad-22').val()){var c22=0}else{var c22 = $('#cantidad-22').val();}
          if(!$('#cantidad-23').val()){var c23=0}else{var c23 = $('#cantidad-23').val();}
          if(!$('#cantidad-24').val()){var c24=0}else{var c24 = $('#cantidad-24').val();}
          if(!$('#cantidad-25').val()){var c25=0}else{var c25 = $('#cantidad-25').val();}
          if(!$('#cantidad-26').val()){var c26=0}else{var c26 = $('#cantidad-26').val();}
          if(!$('#cantidad-27').val()){var c27=0}else{var c27 = $('#cantidad-27').val();}
          if(!$('#cantidad-28').val()){var c28=0}else{var c28 = $('#cantidad-28').val();}
          if(!$('#cantidad-29').val()){var c29=0}else{var c29 = $('#cantidad-29').val();}
          if(!$('#cantidad-30').val()){var c30=0}else{var c30 = $('#cantidad-30').val();}
          if(!$('#cantidad-31').val()){var c31=0}else{var c31 = $('#cantidad-31').val();}
          if(!$('#cantidad-32').val()){var c32=0}else{var c32 = $('#cantidad-32').val();}
          if(!$('#cantidad-33').val()){var c33=0}else{var c33 = $('#cantidad-33').val();}
          if(!$('#cantidad-34').val()){var c34=0}else{var c34 = $('#cantidad-34').val();}
          if(!$('#cantidad-35').val()){var c35=0}else{var c35 = $('#cantidad-35').val();}
          if(!$('#cantidad-36').val()){var c36=0}else{var c36 = $('#cantidad-36').val();}
          if(!$('#cantidad-37').val()){var c37=0}else{var c37 = $('#cantidad-37').val();}
          if(!$('#cantidad-38').val()){var c38=0}else{var c38 = $('#cantidad-38').val();}
          if(!$('#cantidad-39').val()){var c39=0}else{var c39 = $('#cantidad-39').val();}
          if(!$('#cantidad-40').val()){var c40=0}else{var c40 = $('#cantidad-40').val();}
          if(!$('#cantidad-41').val()){var c41=0}else{var c41 = $('#cantidad-41').val();}
          if(!$('#cantidad-42').val()){var c42=0}else{var c42 = $('#cantidad-42').val();}
          if(!$('#cantidad-43').val()){var c43=0}else{var c43 = $('#cantidad-43').val();}
          if(!$('#cantidad-44').val()){var c44=0}else{var c44 = $('#cantidad-44').val();}
          if(!$('#cantidad-45').val()){var c45=0}else{var c45 = $('#cantidad-45').val();}
          if(!$('#cantidad-46').val()){var c46=0}else{var c46 = $('#cantidad-46').val();}
          if(!$('#cantidad-47').val()){var c47=0}else{var c47 = $('#cantidad-47').val();}
          if(!$('#cantidad-48').val()){var c48=0}else{var c48 = $('#cantidad-48').val();}
          if(!$('#cantidad-49').val()){var c49=0}else{var c49 = $('#cantidad-49').val();}
          if(!$('#cantidad-50').val()){var c50=0}else{var c50 = $('#cantidad-50').val();}
          if(!$('#cantidad-51').val()){var c51=0}else{var c51 = $('#cantidad-51').val();}
          if(!$('#cantidad-52').val()){var c52=0}else{var c52 = $('#cantidad-52').val();}
          if(!$('#cantidad-53').val()){var c53=0}else{var c53 = $('#cantidad-53').val();}
          if(!$('#cantidad-54').val()){var c54=0}else{var c54 = $('#cantidad-54').val();}
          if(!$('#cantidad-55').val()){var c55=0}else{var c55 = $('#cantidad-55').val();}
          if(!$('#cantidad-56').val()){var c56=0}else{var c56 = $('#cantidad-56').val();}
          if(!$('#cantidad-57').val()){var c57=0}else{var c57 = $('#cantidad-57').val();}
          if(!$('#cantidad-58').val()){var c58=0}else{var c58 = $('#cantidad-58').val();}
          if(!$('#cantidad-59').val()){var c59=0}else{var c59 = $('#cantidad-59').val();}
          if(!$('#cantidad-60').val()){var c60=0}else{var c60 = $('#cantidad-60').val();}
          if(!$('#cantidad-61').val()){var c61=0}else{var c61 = $('#cantidad-61').val();}
          if(!$('#cantidad-62').val()){var c62=0}else{var c62 = $('#cantidad-62').val();}
          if(!$('#cantidad-63').val()){var c63=0}else{var c63 = $('#cantidad-63').val();}
          if(!$('#cantidad-64').val()){var c64=0}else{var c64 = $('#cantidad-64').val();}
          if(!$('#cantidad-65').val()){var c65=0}else{var c65 = $('#cantidad-65').val();}
          if(!$('#cantidad-66').val()){var c66=0}else{var c66 = $('#cantidad-66').val();}
          
          var m1 = $('#monto-1').unmask();
          var m2 = $('#monto-2').unmask();
          var m3 = $('#monto-3').unmask();
          var m4 = $('#monto-4').unmask();
          var m5 = $('#monto-5').unmask();
          var m6 = $('#monto-6').unmask();
          var m7 = $('#monto-7').unmask();
          var m8 = $('#monto-8').unmask();
          var m9 = $('#monto-9').unmask();
          var m10 = $('#monto-10').unmask();
          var m11 = $('#monto-11').unmask();
          var m12 = $('#monto-12').unmask();
          var m13 = $('#monto-13').unmask();
          var m14 = $('#monto-14').unmask();
          var m15 = $('#monto-15').unmask();
          var m16 = $('#monto-16').unmask();
          var m17 = $('#monto-17').unmask();
          var m18 = $('#monto-18').unmask();
          var m19 = $('#monto-19').unmask();
          var m20 = $('#monto-20').unmask();
          var m21 = $('#monto-21').unmask();
          var m22 = $('#monto-22').unmask();
          var m23 = $('#monto-23').unmask();
          var m24 = $('#monto-24').unmask();
          var m25 = $('#monto-25').unmask();
          var m26 = $('#monto-26').unmask();
          var m27 = $('#monto-27').unmask();
          var m28 = $('#monto-28').unmask();
          var m29 = $('#monto-29').unmask();
          var m30 = $('#monto-30').unmask();
          var m31 = $('#monto-31').unmask();
          var m32 = $('#monto-32').unmask();
          var m33 = $('#monto-33').unmask();
          var m34 = $('#monto-34').unmask();
          var m35 = $('#monto-35').unmask();
          var m36 = $('#monto-36').unmask();
          var m37 = $('#monto-37').unmask();
          var m38 = $('#monto-38').unmask();
          var m39 = $('#monto-39').unmask();
          var m40 = $('#monto-40').unmask();
          var m41 = $('#monto-41').unmask();
          var m42 = $('#monto-42').unmask();
          var m43 = $('#monto-43').unmask();
          var m44 = $('#monto-44').unmask();
          var m45 = $('#monto-45').unmask();
          var m46 = $('#monto-46').unmask();
          var m47 = $('#monto-47').unmask();
          var m48 = $('#monto-48').unmask();
          var m49 = $('#monto-49').unmask();
          var m50 = $('#monto-50').unmask();
          var m51 = $('#monto-51').unmask();
          var m52 = $('#monto-52').unmask();
          var m53 = $('#monto-53').unmask();
          var m54 = $('#monto-54').unmask();
          var m55 = $('#monto-55').unmask();
          var m56 = $('#monto-56').unmask();
          var m57 = $('#monto-57').unmask();
          var m58 = $('#monto-58').unmask();
          var m59 = $('#monto-59').unmask();
          var m60 = $('#monto-60').unmask();
          var m61 = $('#monto-61').unmask();
          var m62 = $('#monto-62').unmask();
          var m63 = $('#monto-63').unmask();
          var m64 = $('#monto-64').unmask();
          var m65 = $('#monto-65').unmask();
          var m66 = $('#monto-66').unmask();
          
          importe = parseInt(m1) + parseInt(m3) + parseInt(m5) + parseInt(m21) + parseInt(m62);
          importe = (importe/100).toFixed(2);
          cantidad = parseInt(c1) + parseInt(c3) + parseInt(c5) + parseInt(c21) + parseInt(c62);

          var parametros = 
          'bolinirdr='+bolinirdr+'&bolfinrdr='+bolfinrdr+'&bolinisismed='+bolinisismed+'&bolfinsismed='+bolfinsismed+
          '&date='+date+'&id_establecimiento='+id_establecimiento+
          '&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+
          '&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&c15='+c15+'&c16='+c16+'&c17='+c17+'&c18='+c18+'&c19='+c19+'&c20='+c20+
          '&c21='+c21+'&c22='+c22+'&c23='+c23+'&c24='+c24+'&c25='+c25+'&c26='+c26+'&c27='+c27+'&c28='+c28+'&c29='+c29+'&c30='+c30+
          '&c31='+c31+'&c32='+c32+'&c33='+c33+'&c34='+c34+'&c35='+c35+'&c36='+c36+'&c37='+c37+'&c38='+c38+'&c39='+c39+'&c40='+c40+
          '&c41='+c41+'&c42='+c42+'&c43='+c43+'&c44='+c44+'&c45='+c45+'&c46='+c46+'&c47='+c47+'&c48='+c48+'&c49='+c49+'&c50='+c50+
          '&c51='+c51+'&c52='+c52+'&c53='+c53+'&c54='+c54+'&c55='+c55+'&c56='+c56+'&c57='+c57+'&c58='+c58+'&c59='+c59+'&c60='+c60+
          '&c61='+c61+'&c62='+c62+'&c63='+c63+'&c64='+c64+'&c65='+c65+'&c66='+c66+
          '&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&m5='+m5+'&m6='+m6+'&m7='+m7+'&m8='+m8+'&m9='+m9+'&m10='+m10+
          '&m11='+m11+'&m12='+m12+'&m13='+m13+'&m14='+m14+'&m15='+m15+'&m16='+m16+'&m17='+m17+'&m18='+m18+'&m19='+m19+'&m20='+m20+
          '&m21='+m21+'&m22='+m22+'&m23='+m23+'&m24='+m24+'&m25='+m25+'&m26='+m26+'&m27='+m27+'&m28='+m28+'&m29='+m29+'&m30='+m30+
          '&m31='+m31+'&m32='+m32+'&m33='+m33+'&m34='+m34+'&m35='+m35+'&m36='+m36+'&m37='+m37+'&m38='+m38+'&m39='+m39+'&m40='+m40+
          '&m41='+m41+'&m42='+m42+'&m43='+m43+'&m44='+m44+'&m45='+m45+'&m46='+m46+'&m47='+m47+'&m48='+m48+'&m49='+m49+'&m50='+m50+
          '&m51='+m51+'&m52='+m52+'&m53='+m53+'&m54='+m54+'&m55='+m55+'&m56='+m56+'&m57='+m57+'&m58='+m58+'&m59='+m59+'&m60='+m60+
          '&m61='+m61+'&m62='+m62+'&m63='+m63+'&m64='+m64+'&m65='+m65+'&m66='+m66+'&importe='+importe+'&cantidad='+cantidad
          ;

            swal({
              title: "Atención!!!",
              text: "El cantidad total es: "+ cantidad +" y el monto total es: S/. "+ importe,
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
                    type: "POST",
                    url: "./public/user/ajax/GuardarFormulario.php",
                    data: parametros,
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

        } //<!--save_recaudacion-->


          $(".btn-save").click(function() {
              save_recaudacion();
          });

      });