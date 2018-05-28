<?php 

?>
<script>
  
  function Suma_Monto_Total() {
       b1  = Number($('#monto-2').unmask());
       b2  = Number($('#monto-4').unmask());
       b3  = Number($('#monto-6').unmask());
        b4=0;
        for (var i = 8; i <= 25; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          b4 +=y;
        }
        b5=0;
        for (var i = 27; i <= 70; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          b5 +=y;
        }
        b6  = Number($('#monto-72').unmask());
        b7=0;
        for (var i = 74; i <= 75; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          b7 +=y;
        }
      suma=b1+b2+b3+b4+b5+b6+b7;
      sismed = ((b2)/100).toFixed(2);
      rdr = ((b1+b3+b4+b5+b6+b7)/100).toFixed(2);
      final= ((suma)/100).toFixed(2);
       try{
           $("#monto-total").val('S/. '+ final);
           $("#monto-SISMED").val('S/. '+ sismed); 
           $("#monto-RDR").val('S/. '+ rdr); 
       }
       catch(e) {}
    }  

  function Suma_Cant_Total() {
      a1  = Number($("#cantidad-2").val());
      a2  = Number($("#cantidad-4").val());
      a3  = Number($("#cantidad-6").val());
      a4=0;
        for (var i = 8; i <= 25; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          a4 +=y;
        }
      a5=0;
        for (var i = 27; i <= 70; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          a5 +=y;
        }
      a6   = Number($("#cantidad-72").val());
      a7=0;
        for (var i = 74; i <= 75; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          a7 +=y;
        }
      suma=a1+a2+a3+a4+a5+a6+a7;
      rdr=a1+a3+a4+a5+a6+a7;
       try{
           $("#cantidad-total").val(suma); 
           $("#cantidad-SISMED").val(a2);
           $("#cantidad-RDR").val(rdr);
       }
       catch(e) {}
    }   

  function Suma_Monto_Padre1() {
      b  = (Number($('#monto-2').unmask())/100).toFixed(2);
       try{
           $("#monto-1").val('S/. '+ b); 
       }
       catch(e) {}
    }  

  function Suma_Cant_Padre1() {
      a  = Number($("#cantidad-2").val());
       try{
           $("#cantidad-1").val(a); 
       }
       catch(e) {}
    }    

  function Suma_Monto_Padre3() {
      b  = (Number($('#monto-4').unmask())/100).toFixed(2);
       try{
           $("#monto-3").val('S/. '+ b); 
       }
       catch(e) {}
    }   

  function Suma_Cant_Padre3() {
      a  = Number($("#cantidad-4").val());
       try{
           $("#cantidad-3").val(a);
       }
       catch(e) {}
    }   

  function Suma_Monto_Padre5() {
      b  = (Number($('#monto-6').unmask())/100).toFixed(2);
       try{
           $("#monto-5").val('S/. '+ b); 
       }
       catch(e) {}
    }   

  function Suma_Cant_Padre5() {
      a  = Number($("#cantidad-6").val());
       try{
           $("#cantidad-5").val(a);
       }
       catch(e) {}
    }   

  function Suma_Monto_Padre7() {
    try{
        suma=0;
        for (var i = 8; i <= 25; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }

      final= ((suma)/100).toFixed(2);
      $("#monto-7").val('S/. '+ final); 
       }
    catch(e) {}
    } 

  function Suma_Cant_Padre7() {
    try{
        suma=0;
        for (var i = 8; i <= 25; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }
      $("#cantidad-7").val(suma); 
       }
    catch(e) {}
    } 

  function Suma_Monto_Padre26() {
    try{
        suma=0;
        for (var i = 27; i <= 70; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }

      final= ((suma)/100).toFixed(2);
      $("#monto-26").val('S/. '+ final); 
       }
    catch(e) {}
    } 

  function Suma_Cant_Padre26() {
    try{
        suma=0;
        for (var i = 27; i <= 70; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }
      $("#cantidad-26").val(suma); 
       }
    catch(e) {}
    } 

  function Suma_Monto_Padre71() {
      b  = (Number($('#monto-72').unmask())/100).toFixed(2);
       try{
           $("#monto-71").val('S/. '+ b); 
       }
       catch(e) {}
    }   

  function Suma_Cant_Padre71() {
      a  = Number($("#cantidad-72").val());
       try{
           $("#cantidad-71").val(a);
       }
       catch(e) {}
    } 

  function Suma_Monto_Padre73() {
    try{
        suma=0;
        for (var i = 74; i <= 75; i++) {
          x = '#monto-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }

      final= ((suma)/100).toFixed(2);
      $("#monto-73").val('S/. '+ final); 
       }
    catch(e) {}
    } 

  function Suma_Cant_Padre73() {
    try{
        suma=0;
        for (var i = 74; i <= 75; i++) {
          x = '#cantidad-'+i;
          y = 'var'+i;
          y = Number($(x).unmask());
          suma +=y;
        }
      $("#cantidad-73").val(suma); 
       }
    catch(e) {}
    } 

</script>
