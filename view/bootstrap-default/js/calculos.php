<?php 

?>
<script>
  
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
      b  = Number($('#monto-6').unmask());
      d  = Number($('#monto-7').unmask());
      f  = Number($('#monto-8').unmask());
      h  = Number($('#monto-9').unmask());
      j  = Number($('#monto-10').unmask());
      l  = Number($('#monto-11').unmask());
      n  = Number($('#monto-12').unmask());
      p  = Number($('#monto-13').unmask());
      r  = Number($('#monto-14').unmask());
      t  = Number($('#monto-15').unmask());
      v  = Number($('#monto-16').unmask());
      x  = Number($('#monto-17').unmask());
      z  = Number($('#monto-18').unmask());
      b1  = Number($('#monto-19').unmask());
      d1  = Number($('#monto-20').unmask());
      suma2= ((b+d+f+h+j+l+n+p+r+t+v+x+z+b1+d1)/100).toFixed(2);
       try{
           $("#monto-5").val('S/. '+ suma2); 
       }
       catch(e) {}
    } 

  function Suma_Cant_Padre5() {
      a  = Number($("#cantidad-6").val());
      c  = Number($("#cantidad-7").val());
      e  = Number($("#cantidad-8").val());
      g  = Number($("#cantidad-9").val());
      i  = Number($("#cantidad-10").val());
      k  = Number($("#cantidad-11").val());
      m  = Number($("#cantidad-12").val());
      o  = Number($("#cantidad-13").val());
      q  = Number($("#cantidad-14").val());
      s  = Number($("#cantidad-15").val());
      u  = Number($("#cantidad-16").val());
      w  = Number($("#cantidad-17").val());
      y  = Number($("#cantidad-18").val());
      a1  = Number($("#cantidad-19").val());
      c1  = Number($("#cantidad-20").val());
      suma1= a+c+e+g+i+k+m+o+q+s+u+w+y+a1+c1;
       try{
          $("#cantidad-5").val(suma1); 
       }
       catch(e) {}
    }    

  function Suma_Monto_Padre21() {
          b  = Number($('#monto-22').unmask());          
          d  = Number($('#monto-23').unmask());          
          f  = Number($('#monto-24').unmask());          
          h  = Number($('#monto-25').unmask());          
          j  = Number($('#monto-26').unmask());          
          l  = Number($('#monto-27').unmask());
          n  = Number($('#monto-28').unmask());
          p  = Number($('#monto-29').unmask());
          r  = Number($('#monto-30').unmask());
          t  = Number($('#monto-31').unmask());
          v  = Number($('#monto-32').unmask());
          x  = Number($('#monto-33').unmask());
          z  = Number($('#monto-34').unmask());
          b1  = Number($('#monto-35').unmask());
          d1  = Number($('#monto-36').unmask());
          f1  = Number($('#monto-37').unmask());
          h1  = Number($('#monto-38').unmask());
          j1  = Number($('#monto-39').unmask());
          l1  = Number($('#monto-40').unmask());
          n1  = Number($('#monto-41').unmask());
          p1  = Number($('#monto-42').unmask());
          r1  = Number($('#monto-43').unmask());
          t1  = Number($('#monto-44').unmask());
          v1  = Number($('#monto-45').unmask());
          x1  = Number($('#monto-46').unmask());
          z1  = Number($('#monto-47').unmask());
          b2  = Number($('#monto-48').unmask());
          d2  = Number($('#monto-49').unmask());
          f2  = Number($('#monto-50').unmask());
          h2  = Number($('#monto-51').unmask());
          j2  = Number($('#monto-52').unmask());
          l2  = Number($('#monto-53').unmask());
          n2  = Number($('#monto-54').unmask());
          p2  = Number($('#monto-55').unmask());
          r2  = Number($('#monto-56').unmask());
          t2  = Number($('#monto-57').unmask());
          v2  = Number($('#monto-58').unmask());
          x2  = Number($('#monto-59').unmask());
          z2  = Number($('#monto-60').unmask());
          b3  = Number($('#monto-61').unmask());
          suma2= ((b+d+f+h+j+l+n+p+r+t+v+x+z+b1+d1+f1+h1+j1+l1+n1+p1+r1+t1+v1+x1+z1+b2+d2+f2+h2+j2+l2+n2+p2+r2+t2+v2+x2+z2+b3)/100).toFixed(2);
       try{
           $("#monto-21").val('S/. '+ suma2); 
       }
       catch(e) {}
    }  

  function Suma_Cant_Padre21() {
          a  = Number($("#cantidad-22").val());
          c  = Number($("#cantidad-23").val());
          e  = Number($("#cantidad-24").val());
          g  = Number($("#cantidad-25").val());
          i  = Number($("#cantidad-26").val());
          k  = Number($("#cantidad-27").val());
          m  = Number($("#cantidad-28").val());
          o  = Number($("#cantidad-29").val());
          q  = Number($("#cantidad-30").val());
          s  = Number($("#cantidad-31").val());
          u  = Number($("#cantidad-32").val());
          w  = Number($("#cantidad-33").val());
          y  = Number($("#cantidad-34").val());
          a1  = Number($("#cantidad-35").val());
          c1  = Number($("#cantidad-36").val());
          e1  = Number($("#cantidad-37").val());
          g1  = Number($("#cantidad-38").val());
          i1  = Number($("#cantidad-39").val());
          k1  = Number($("#cantidad-40").val());
          m1  = Number($("#cantidad-41").val());
          o1  = Number($("#cantidad-42").val());
          q1  = Number($("#cantidad-43").val());
          s1  = Number($("#cantidad-44").val());
          u1  = Number($("#cantidad-45").val());
          w1  = Number($("#cantidad-46").val());
          y1  = Number($("#cantidad-47").val());
          a2  = Number($("#cantidad-48").val());
          c2  = Number($("#cantidad-49").val());
          e2  = Number($("#cantidad-50").val());
          g2  = Number($("#cantidad-51").val());
          i2  = Number($("#cantidad-52").val());
          k2  = Number($("#cantidad-53").val());
          m2  = Number($("#cantidad-54").val());
          o2  = Number($("#cantidad-55").val());
          q2  = Number($("#cantidad-56").val());
          s2  = Number($("#cantidad-57").val());
          u2  = Number($("#cantidad-58").val());
          w2  = Number($("#cantidad-59").val());
          y2  = Number($("#cantidad-60").val());
          a3  = Number($("#cantidad-61").val());
          suma1= ((a+c+e+g+i+k+m+o+q+s+u+w+y+a1+c1+e1+g1+i1+k1+m1+o1+q1+s1+u1+w1+y1+a2+c2+e2+g2+i2+k2+m2+o2+q2+s2+u2+w2+y2+a3)/100).toFixed(2);
       try{
           $("#cantidad-21").val(suma1); 
       }
       catch(e) {}
    }  

  function Suma_Monto_Padre62() {
          b  = (Number($('#monto-63').unmask())/100).toFixed(2);
       try{
          $("#monto-62").val('S/. '+ b); 
       }
       catch(e) {}
    }  

  function Suma_Cant_Padre62() {
          a  = Number($("#cantidad-63").val());
       try{
          $("#cantidad-62").val(a); 
       }
       catch(e) {}
    }  
</script>
