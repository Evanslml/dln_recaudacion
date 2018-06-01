  $(document).ready(function(){

        $("#form-distrito").hide();
        $("#form-establecimientos").hide();

        $('#cbx_tipo_nivel').on('change',function(){
            var nivel  = $(this).val();
            switch(nivel){
              case "02":
                $("#form-distrito").show();
                $("#form-establecimientos").hide();
                break; 
              case "03":
                $("#form-distrito").hide();
                $("#form-establecimientos").show();
                break;
              default:
                $("#form-distrito").hide();
                $("#form-establecimientos").hide();
                break;
            }

        });
        
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




      function imprimir(in_data){
          event.preventDefault();
          
          var tipo_reporte = $('#cbx_tipo_reporte').val();
          var tipo_recaudacion = $('#cbx_tipo_recaudacion').val();
          var tipo_nivel = $('#cbx_tipo_nivel').val();
          var date1 = $('#datepicker1 input').val();
          var date2 = $('#datepicker2 input').val();

          if(tipo_reporte=='0'){
             $("#resultados").html('<div class="alert alert-danger" role="alert">\
             <button type="button" class="close" data-dismiss="alert">&times;</button>\
             <strong>Error!</strong> \
             Debe seleccionar un tipo de reporte</div>');
             $('#cbx_tipo_reporte').focus();
             $('.lbl_tipo_reporte').css('color','red');
             return false;
          }else{
             $('.lbl_tipo_reporte').css('color','#000');
          }

          switch (tipo_nivel){

            case '0':
             $("#resultados").html('<div class="alert alert-danger" role="alert">\
             <button type="button" class="close" data-dismiss="alert">&times;</button>\
             <strong>Error!</strong> \
             Debe seleccionar el nivel del reporte</div>');
             $("#cbx_tipo_nivel").focus();
             $('.lbl_tipo_nivel').css('color','red');
             return false;
             break;            

             case '02':
             var distrito = $('#cbx_nivel_distrito').val();
             var lbl_distrito = $('#cbx_nivel_distrito option:selected').text();;
             $('.lbl_tipo_nivel').css('color','#000');

               if(distrito=='0'){
                  $("#resultados").html('<div class="alert alert-danger" role="alert">\
                 <button type="button" class="close" data-dismiss="alert">&times;</button>\
                 <strong>Error!</strong> \
                 Debe seleccionar el Distrito</div>');
                 $("#cbx_nivel_distrito").focus();
                 $('.lbl_nivel_distrito').css('color','red');
                 return false;
               } else{
                $(".lbl_nivel_distrito").css('color','#000');
               }
            var establecimiento='00';
            var lbl_establecimiento='00';

             break;

             case '03':
             var establecimiento = $('#cbx_establecimiento').val();
             var lbl_establecimiento = $('#cbx_establecimiento option:selected').text();
             $('.lbl_tipo_nivel').css('color','#000');
               if(establecimiento=='0'){
                  $("#resultados").html('<div class="alert alert-danger" role="alert">\
                 <button type="button" class="close" data-dismiss="alert">&times;</button>\
                 <strong>Error!</strong> \
                 Debe seleccionar el Establecimiento</div>');
                 $("#cbx_establecimiento").focus();
                 $('.lbl_establecimiento').css('color','red');
                 return false;
               } else{
                $(".lbl_establecimiento").css('color','#000');
               }
             var distrito='00';
             var lbl_distrito='00';
             break;

             default:
             $('.lbl_tipo_nivel').css('color','#000');
             var distrito='00';
             var lbl_distrito='00';
             var establecimiento='00';
             var lbl_establecimiento='00';
             break;

          }

          var parametros = 'tipo_recaudacion='+tipo_recaudacion+'&tipo_nivel='+tipo_nivel+'&distrito='+distrito+'&establecimiento='+establecimiento+'&date1='+date1+'&date2='+date2+'&lbl_distrito='+lbl_distrito+'&lbl_establecimiento='+lbl_establecimiento;
          var pageexc01='./core/excel/report_01.php?'+parametros;
          var pageexc02='./core/excel/report_02.php?'+parametros;
          var pageexc03='./core/excel/report_03.php?'+parametros;
          //var pageexc04='./core/excel/report_04.php?'+parametros;
          var pagepdf01='./core/pdf/documentos/reporte_01.php?'+parametros;
          var pagepdf02='./core/pdf/documentos/reporte_02.php?'+parametros;
          var pagepdf03='./core/pdf/documentos/reporte_03.php?'+parametros;
          var pagepdf04='./core/pdf/documentos/reporte_04.php?'+parametros;

          if(in_data=='excel'){
            switch(tipo_reporte){
              case '01':
              $.ajax({
                        url: pageexc01,
                        beforeSend: function(datos){
                           $("#resultados").html('<div class="alert alert-warning" role="alert">\
                           <button type="button" class="close" data-dismiss="alert">&times;</button>\
                           <strong>En Proceso!</strong> \
                           Cargando...</div>');
                          $(".loading").show();
                          },
                        success: function(datos){
                          window.location = pageexc01;
                          }
                    }).done(function(){
                     $(".loading").hide();
                     $("#resultados").html('<div class="alert alert-success" role="alert">\
                     <button type="button" class="close" data-dismiss="alert">&times;</button>\
                     <strong>Completo!</strong> \
                     Su descarga se realizó con éxito</div>');
                    });
              break;

              case '02':
              $.ajax({
                        url: pageexc02,
                        beforeSend: function(datos){
                           $("#resultados").html('<div class="alert alert-warning" role="alert">\
                           <button type="button" class="close" data-dismiss="alert">&times;</button>\
                           <strong>En Proceso!</strong> \
                           Cargando...</div>');
                          $(".loading").show();
                          },
                        success: function(datos){
                          window.location = pageexc02;
                          }
                    }).done(function(){
                     $(".loading").hide();
                     $("#resultados").html('<div class="alert alert-success" role="alert">\
                     <button type="button" class="close" data-dismiss="alert">&times;</button>\
                     <strong>Completo!</strong> \
                     Su descarga se realizó con éxito</div>');
                    });
              break;

              case '03':
              $.ajax({
                        url: pageexc03,
                        beforeSend: function(datos){
                           $("#resultados").html('<div class="alert alert-warning" role="alert">\
                           <button type="button" class="close" data-dismiss="alert">&times;</button>\
                           <strong>En Proceso!</strong> \
                           Cargando...</div>');
                          $(".loading").show();
                          },
                        success: function(datos){
                          window.location = pageexc03;
                          }
                    }).done(function(){
                     $(".loading").hide();
                     $("#resultados").html('<div class="alert alert-success" role="alert">\
                     <button type="button" class="close" data-dismiss="alert">&times;</button>\
                     <strong>Completo!</strong> \
                     Su descarga se realizó con éxito</div>');
                    });
              break;

              case '04':
              console.log("en proceso");
              break;
            }
          }else if(in_data=='pdf'){ //if PDF
            switch(tipo_reporte){
              case '01':
              VentanaCentrada(pagepdf01,'Formulario','','1024','768','true');
              break;
              case '02':
              VentanaCentrada(pagepdf02,'Formulario','','1024','768','true');
              break;
              case '03':
              VentanaCentrada(pagepdf03,'Formulario','','1024','768','true');
              break;
              case '04':
              VentanaCentrada(pagepdf04,'Formulario','','1024','768','true');
              break;
            }
          } //else PDF

/*          console.log(tipo_reporte);*/
/*          console.log(tipo_recaudacion);*/
/*          console.log(tipo_nivel);*/
/*          console.log(distrito);*/
/*          console.log(establecimiento);*/
      } //Function imprimir


      $('.exportar_excel').click(function() {
          imprimir('excel');
      }); 

      $('.exportar_pdf').click(function() {
          imprimir('pdf');
      });

 });