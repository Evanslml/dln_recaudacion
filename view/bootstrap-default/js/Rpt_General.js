  $(document).ready(function(){


        $("#form-distrito").hide();

        $('#cbx_tipo_nivel').on('change',function(){
            var nivel  = $(this).val();
            switch(nivel){
              case "02":
                $("#form-distrito").show();
                break;
            }

        });

 });