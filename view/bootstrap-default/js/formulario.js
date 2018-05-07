
      var $ = jQuery.noConflict();
      $(document).ready(function(){


        /*date time*/
        /*var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        $('#startdatetime-from').datetimepicker({
            language: 'en',
            format: 'yyyy-MM-dd hh:mm'
        });
        $("#startdatetime-from").data('DateTimePicker').setLocalDate(new Date(year, month, day, 00, 01));
        */
        
        /*
          $('#datetimepicker1').datetimepicker({
            format: "L"
          });
        */

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

        //Sumas
        $("#cantidad-2,#monto-2").change(function(){
          a  = Number($("#cantidad-2").val());
          b  = (Number($('#monto-2').unmask())/100).toFixed(2);
          $("#cantidad-1").val(a); 
          $("#monto-1").val('S/. '+ b); 
        });

        $("#cantidad-4,#monto-4").change(function(){
          a  = Number($("#cantidad-4").val());
          b  = (Number($('#monto-4').unmask())/100).toFixed(2);
          $("#cantidad-3").val(a); 
          $("#monto-3").val('S/. '+ b); 
        });
        
        $("#cantidad-6,#monto-6,#cantidad-7,#monto-7,#cantidad-8,#monto-8,#cantidad-9,#monto-9,#cantidad-10,#monto-10,#cantidad-11,#monto-11,#cantidad-12,#monto-12,#cantidad-13,#monto-13,#cantidad-14,#monto-14,#cantidad-15,#monto-15,#cantidad-16,#monto-16,#cantidad-17,#monto-17,#cantidad-18,#monto-18,#cantidad-19,#monto-19,#cantidad-20,#monto-20").change(function(){
          a  = Number($("#cantidad-6").val());
          b  = Number($('#monto-6').unmask());
          c  = Number($("#cantidad-7").val());
          d  = Number($('#monto-7').unmask());
          e  = Number($("#cantidad-8").val());
          f  = Number($('#monto-8').unmask());
          g  = Number($("#cantidad-9").val());
          h  = Number($('#monto-9').unmask());
          i  = Number($("#cantidad-10").val());
          j  = Number($('#monto-10').unmask());
          k  = Number($("#cantidad-11").val());
          l  = Number($('#monto-11').unmask());
          m  = Number($("#cantidad-12").val());
          n  = Number($('#monto-12').unmask());
          o  = Number($("#cantidad-13").val());
          p  = Number($('#monto-13').unmask());
          q  = Number($("#cantidad-14").val());
          r  = Number($('#monto-14').unmask());
          s  = Number($("#cantidad-15").val());
          t  = Number($('#monto-15').unmask());
          u  = Number($("#cantidad-16").val());
          v  = Number($('#monto-16').unmask());
          w  = Number($("#cantidad-17").val());
          x  = Number($('#monto-17').unmask());
          y  = Number($("#cantidad-18").val());
          z  = Number($('#monto-18').unmask());
          a1  = Number($("#cantidad-19").val());
          b1  = Number($('#monto-19').unmask());
          c1  = Number($("#cantidad-20").val());
          d1  = Number($('#monto-20').unmask());

          suma1= a+c+e+g+i+k+m+o+q+s+u+w+y+a1+c1;
          suma2= ((b+d+f+h+j+l+n+p+r+t+v+x+z+b1+d1)/100).toFixed(2);

          $("#cantidad-5").val(suma1); 
          $("#monto-5").val('S/. '+ suma2); 

        });
        

        $("#cantidad-22,#monto-22,#cantidad-23,#monto-23,#cantidad-24,#monto-24,#cantidad-25,#monto-25,#cantidad-26,#monto-26,#cantidad-27,#monto-27,#cantidad-28,#monto-28,#cantidad-29,#monto-29,#cantidad-30,#monto-30,#cantidad-31,#monto-31,#cantidad-32,#monto-32,#cantidad-33,#monto-33,#cantidad-34,#monto-34,#cantidad-35,#monto-35,#cantidad-36,#monto-36,#cantidad-37,#monto-37,#cantidad-38,#monto-38,#cantidad-39,#monto-39,#cantidad-40,#monto-40,#cantidad-41,#monto-41,#cantidad-42,#monto-42,#cantidad-43,#monto-43,#cantidad-44,#monto-44,#cantidad-45,#monto-45,#cantidad-46,#monto-46,#cantidad-47,#monto-47,#cantidad-48,#monto-48,#cantidad-49,#monto-49,#cantidad-50,#monto-50,#cantidad-51,#monto-51,#cantidad-52,#monto-52,#cantidad-53,#monto-53,#cantidad-54,#monto-54,#cantidad-55,#monto-55,#cantidad-56,#monto-56,#cantidad-57,#monto-57,#cantidad-58,#monto-58,#cantidad-59,#monto-59,#cantidad-60,#monto-60,#cantidad-61,#monto-61").change(function(){
          
          a  = Number($("#cantidad-22").val());
          b  = Number($('#monto-22').unmask());
          c  = Number($("#cantidad-23").val());
          d  = Number($('#monto-23').unmask());
          e  = Number($("#cantidad-24").val());
          f  = Number($('#monto-24').unmask());
          g  = Number($("#cantidad-25").val());
          h  = Number($('#monto-25').unmask());
          i  = Number($("#cantidad-26").val());
          j  = Number($('#monto-26').unmask());
          k  = Number($("#cantidad-27").val());
          l  = Number($('#monto-27').unmask());
          m  = Number($("#cantidad-28").val());
          n  = Number($('#monto-28').unmask());
          o  = Number($("#cantidad-29").val());
          p  = Number($('#monto-29').unmask());
          q  = Number($("#cantidad-30").val());
          r  = Number($('#monto-30').unmask());
          s  = Number($("#cantidad-31").val());
          t  = Number($('#monto-31').unmask());
          u  = Number($("#cantidad-32").val());
          v  = Number($('#monto-32').unmask());
          w  = Number($("#cantidad-33").val());
          x  = Number($('#monto-33').unmask());
          y  = Number($("#cantidad-34").val());
          z  = Number($('#monto-34').unmask());
          a1  = Number($("#cantidad-35").val());
          b1  = Number($('#monto-35').unmask());
          c1  = Number($("#cantidad-36").val());
          d1  = Number($('#monto-36').unmask());
          e1  = Number($("#cantidad-37").val());
          f1  = Number($('#monto-37').unmask());
          g1  = Number($("#cantidad-38").val());
          h1  = Number($('#monto-38').unmask());
          i1  = Number($("#cantidad-39").val());
          j1  = Number($('#monto-39').unmask());
          k1  = Number($("#cantidad-40").val());
          l1  = Number($('#monto-40').unmask());
          m1  = Number($("#cantidad-41").val());
          n1  = Number($('#monto-41').unmask());
          o1  = Number($("#cantidad-42").val());
          p1  = Number($('#monto-42').unmask());
          q1  = Number($("#cantidad-43").val());
          r1  = Number($('#monto-43').unmask());
          s1  = Number($("#cantidad-44").val());
          t1  = Number($('#monto-44').unmask());
          u1  = Number($("#cantidad-45").val());
          v1  = Number($('#monto-45').unmask());
          w1  = Number($("#cantidad-46").val());
          x1  = Number($('#monto-46').unmask());
          y1  = Number($("#cantidad-47").val());
          z1  = Number($('#monto-47').unmask());
          a2  = Number($("#cantidad-48").val());
          b2  = Number($('#monto-48').unmask());
          c2  = Number($("#cantidad-49").val());
          d2  = Number($('#monto-49').unmask());
          e2  = Number($("#cantidad-50").val());
          f2  = Number($('#monto-50').unmask());
          g2  = Number($("#cantidad-51").val());
          h2  = Number($('#monto-51').unmask());
          i2  = Number($("#cantidad-52").val());
          j2  = Number($('#monto-52').unmask());
          k2  = Number($("#cantidad-53").val());
          l2  = Number($('#monto-53').unmask());
          m2  = Number($("#cantidad-54").val());
          n2  = Number($('#monto-54').unmask());
          o2  = Number($("#cantidad-55").val());
          p2  = Number($('#monto-55').unmask());
          q2  = Number($("#cantidad-56").val());
          r2  = Number($('#monto-56').unmask());
          s2  = Number($("#cantidad-57").val());
          t2  = Number($('#monto-57').unmask());
          u2  = Number($("#cantidad-58").val());
          v2  = Number($('#monto-58').unmask());
          w2  = Number($("#cantidad-59").val());
          x2  = Number($('#monto-59').unmask());
          y2  = Number($("#cantidad-60").val());
          z2  = Number($('#monto-60').unmask());
          a3  = Number($("#cantidad-61").val());
          b3  = Number($('#monto-61').unmask());

          suma1=   a+c+e+g+i+k+m+o+q+s+u+w+y+a1+c1+e1+g1+i1+k1+m1+o1+q1+s1+u1+w1+y1+a2+c2+e2+g2+i2+k2+m2+o2+q2+s2+u2+w2+y2+a3;
          suma2= ((b+d+f+h+j+l+n+p+r+t+v+x+z+b1+d1+f1+h1+j1+l1+n1+p1+r1+t1+v1+x1+z1+b2+d2+f2+h2+j2+l2+n2+p2+r2+t2+v2+x2+z2+b3)/100).toFixed(2);

          $("#cantidad-21").val(suma1); 
          $("#monto-21").val('S/. '+ suma2); 
        });

        $("#cantidad-63,#monto-63").change(function(){
          a  = Number($("#cantidad-63").val());
          b  = (Number($('#monto-63').unmask())/100).toFixed(2);
          $("#cantidad-62").val(a); 
          $("#monto-62").val('S/. '+ b); 
        });

        /*save*/

        function save_recaudacion(){

          var bolinirdr = $('#bolinirdr').val();
          var bolfinrdr = $('#bolfinrdr').val();
          var bolinisismed = $('#bolinisismed').val();
          var bolfinsismed = $('#bolfinsismed').val();
          var date = $('#datepicker input').val();
          var id_establecimiento = $('#id_establecimiento').val();

          var c1 = $('#cantidad-1').val();
          var c2 = $('#cantidad-2').val();
          var c3 = $('#cantidad-3').val();
          var c4 = $('#cantidad-4').val();
          var c5 = $('#cantidad-5').val();
          var c6 = $('#cantidad-6').val();
          var c7 = $('#cantidad-7').val();
          var c8 = $('#cantidad-8').val();
          var c9 = $('#cantidad-9').val();
          var c10 = $('#cantidad-10').val();
          var c11 = $('#cantidad-11').val();
          var c12 = $('#cantidad-12').val();
          var c13 = $('#cantidad-13').val();
          var c14 = $('#cantidad-14').val();
          var c15 = $('#cantidad-15').val();
          var c16 = $('#cantidad-16').val();
          var c17 = $('#cantidad-17').val();
          var c18 = $('#cantidad-18').val();
          var c19 = $('#cantidad-19').val();
          var c20 = $('#cantidad-20').val();
          var c21 = $('#cantidad-21').val();
          var c22 = $('#cantidad-22').val();
          var c23 = $('#cantidad-23').val();
          var c24 = $('#cantidad-24').val();
          var c25 = $('#cantidad-25').val();
          var c26 = $('#cantidad-26').val();
          var c27 = $('#cantidad-27').val();
          var c28 = $('#cantidad-28').val();
          var c29 = $('#cantidad-29').val();
          var c30 = $('#cantidad-30').val();
          var c31 = $('#cantidad-31').val();
          var c32 = $('#cantidad-32').val();
          var c33 = $('#cantidad-33').val();
          var c34 = $('#cantidad-34').val();
          var c35 = $('#cantidad-35').val();
          var c36 = $('#cantidad-36').val();
          var c37 = $('#cantidad-37').val();
          var c38 = $('#cantidad-38').val();
          var c39 = $('#cantidad-39').val();
          var c40 = $('#cantidad-40').val();
          var c41 = $('#cantidad-41').val();
          var c42 = $('#cantidad-42').val();
          var c43 = $('#cantidad-43').val();
          var c44 = $('#cantidad-44').val();
          var c45 = $('#cantidad-45').val();
          var c46 = $('#cantidad-46').val();
          var c47 = $('#cantidad-47').val();
          var c48 = $('#cantidad-48').val();
          var c49 = $('#cantidad-49').val();
          var c50 = $('#cantidad-50').val();
          var c51 = $('#cantidad-51').val();
          var c52 = $('#cantidad-52').val();
          var c53 = $('#cantidad-53').val();
          var c54 = $('#cantidad-54').val();
          var c55 = $('#cantidad-55').val();
          var c56 = $('#cantidad-56').val();
          var c57 = $('#cantidad-57').val();
          var c58 = $('#cantidad-58').val();
          var c59 = $('#cantidad-59').val();
          var c60 = $('#cantidad-60').val();
          var c61 = $('#cantidad-61').val();
          var c62 = $('#cantidad-62').val();
          var c63 = $('#cantidad-63').val();
          
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
                 
          var parametros = 
          'bolinirdr='+bolinirdr+'&bolfinrdr='+bolfinrdr+'&bolinisismed='+bolinisismed+'&bolfinsismed='+bolfinsismed+
          '&date='+date+'&id_establecimiento='+id_establecimiento+
          '&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+
          '&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&c15='+c15+'&c16='+c16+'&c17='+c17+'&c18='+c18+'&c19='+c19+'&c20='+c20+
          '&c21='+c21+'&c22='+c22+'&c23='+c23+'&c24='+c24+'&c25='+c25+'&c26='+c26+'&c27='+c27+'&c28='+c28+'&c29='+c29+'&c30='+c30+
          '&c31='+c31+'&c32='+c32+'&c33='+c33+'&c34='+c34+'&c35='+c35+'&c36='+c36+'&c37='+c37+'&c38='+c38+'&c39='+c39+'&c40='+c40+
          '&c41='+c41+'&c42='+c42+'&c43='+c43+'&c44='+c44+'&c45='+c45+'&c46='+c46+'&c47='+c47+'&c48='+c48+'&c49='+c49+'&c50='+c50+
          '&c51='+c51+'&c52='+c52+'&c53='+c53+'&c54='+c54+'&c55='+c55+'&c56='+c56+'&c57='+c57+'&c58='+c58+'&c59='+c59+'&c60='+c60+
          '&c61='+c61+'&c62='+c62+'&c63='+c63+
          '&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&m5='+m5+'&m6='+m6+'&m7='+m7+'&m8='+m8+'&m9='+m9+'&m10='+m10+
          '&m11='+m11+'&m12='+m12+'&m13='+m13+'&m14='+m14+'&m15='+m15+'&m16='+m16+'&m17='+m17+'&m18='+m18+'&m19='+m19+'&m20='+m20+
          '&m21='+m21+'&m22='+m22+'&m23='+m23+'&m24='+m24+'&m25='+m25+'&m26='+m26+'&m27='+m27+'&m28='+m28+'&m29='+m29+'&m30='+m30+
          '&m31='+m31+'&m32='+m32+'&m33='+m33+'&m34='+m34+'&m35='+m35+'&m36='+m36+'&m37='+m37+'&m38='+m38+'&m39='+m39+'&m40='+m40+
          '&m41='+m41+'&m42='+m42+'&m43='+m43+'&m44='+m44+'&m45='+m45+'&m46='+m46+'&m47='+m47+'&m48='+m48+'&m49='+m49+'&m50='+m50+
          '&m51='+m51+'&m52='+m52+'&m53='+m53+'&m54='+m54+'&m55='+m55+'&m56='+m56+'&m57='+m57+'&m58='+m58+'&m59='+m59+'&m60='+m60+
          '&m61='+m61+'&m62='+m62+'&m63='+m63
          ;

          $.ajax({
                type: "POST",
                url: "public/user/ajax/GuardarFormulario.php",
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
                    }
            });

          event.preventDefault();
/*

           }  //Fin else
*/

        } //<!--save_recaudacion-->


          $(".btn-save").click(function() {
              save_recaudacion();
          });

      });