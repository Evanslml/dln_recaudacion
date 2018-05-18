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




 });