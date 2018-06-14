<?php 

class Recaudacion
{
	  
    protected $lrcau_id;
    protected $nesta_renaes;
    protected $lanio_id;
    protected $lmes_id;
    protected $lrecau_fecrec;
    protected $lcomp_id;
    protected $lrectip_id;
    protected $lbol_ini;
    protected $lbol_fin;
    protected $lcant;
    protected $limp;
    protected $fecha_ingreso;
    protected $lrecau_estado;
    protected $musu_id;

    function __construct($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n)
    {
      $this->lrcau_id = $a;
      $this->nesta_renaes = $b;
      $this->lanio_id = $c;
      $this->lmes_id = $d;
      $this->lrecau_fecrec = $e;
      $this->lcomp_id = $f;
      $this->lrectip_id = $g;
      $this->lbol_ini = $h;
      $this->lbol_fin = $i;
      $this->lcant = $j;
      $this->limp = $k;
      $this->fecha_ingreso = $l;
      $this->lrecau_estado = $m;
      $this->musu_id = $n;
    }

    public function BuscarRecaudacion(){
      $db = new Conexion();
      $sql = $db->query("SELECT * FROM lrecaudacion WHERE LRECAU_ID='$this->lrcau_id';");
        if($db->rows($sql)>0 ){
          $existe= 1;
        }else {
          $existe=0;
        }
        return $existe;
      $db->close();      
    }

    public function EliminarRecaudacion (){
      $db = new Conexion();
      $sql1 = $db->query("DELETE FROM lrecaudacion WHERE LRECAU_ID='$this->lrcau_id';");
      $sql2 = $db->query("DELETE FROM lrecaudacion_detalle WHERE LRECAU_ID='$this->lrcau_id';");
      $db->close();
    } 

    public function IngresarRecaudacion (){
      $db = new Conexion();
      $sql = $db->query("
      INSERT INTO lrecaudacion (LRECAU_ID,NESTA_RENAES,LANIO_ID,LMES_ID,LRECAU_FECREC,
        LCOMP_ID,LRECTIP_ID,LBOL_INI,LBOL_FIN,LCANT,LIMP,
        FECHA_INGRESO,LRECAU_ESTADO,MUSU_ID) 
      VALUES(
        '$this->lrcau_id',
        '$this->nesta_renaes',
        '$this->lanio_id',
        '$this->lmes_id',
        '$this->lrecau_fecrec',
        '$this->lcomp_id',
        '$this->lrectip_id',
        '$this->lbol_ini',
        '$this->lbol_fin',
        '$this->lcant',
        '$this->limp',
        '$this->fecha_ingreso',
        '$this->lrecau_estado',
        '$this->musu_id'
      );");
      $db->close();
    } 

/*
    public static function ListarRecaudacion($a){
      $db = new Conexion();
      $sql = $db->query("SELECT A.LCLAS_ID,A.LCLAS_ALIAS,A.LCLAS_NOMBRE,A.LCLAS_PADRE,B.LCOMP_NOMBRE,C.LRECTIP_NOMBRE,A.LCLAS_ESTADO,D.CANTIDAD,D.MONTO from lclasificador A 
      INNER JOIN lcomponente B
      ON A.LCOMP_ID = B.LCOMP_ID
      INNER JOIN lrecaudacion_tipo C
      ON C.LRECTIP_ID = A.LRECTIP_ID
      INNER JOIN lrecaudacion_detalle D
      ON A.LCLAS_ID=D.IDITEM
      AND A.LCOMP_ID='01'
      AND D.LRECAU_ID LIKE '%$a'
      ORDER BY LCLAS_ID
      ");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
          $dato[] = $d; //ALL
        }
      } else {
        $dato = false;
      }
      return $dato;
      $db->close();      
    }
*/

    public static function BuscarRecaudacionFecha ($e,$fi,$ff,$offset,$per_page){
      $db = new Conexion();
      $sql = $db->query("
      SELECT 
      A.LRECAU_ID,A.NESTA_RENAES,A.LANIO_ID,A.LRECAU_FECREC,A.LRECTIP_ID,A.LBOL_INI,A.LBOL_FIN,A.LCANT,A.LIMP,A.LRECAU_ESTADO,B.NEST_NOMBRE
      FROM lrecaudacion A
      INNER JOIN nestablecimiento B
      ON A.NESTA_RENAES = B.NESTA_RENAES
      WHERE A.NESTA_RENAES='$e'
      AND (A.LRECAU_FECREC BETWEEN '$fi' AND '$ff')
      ORDER BY A.LRECAU_FECREC DESC,A.LRECTIP_ID DESC
      LIMIT $offset,$per_page
      ;");

      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[] = $d; //ALL
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
      
    }     

    public static function CantidadTotalRecaudacionFecha ($e,$fi,$ff){
      $db = new Conexion();
      $sql = $db->query("
      SELECT * FROM lrecaudacion A
      WHERE NESTA_RENAES = '$e' 
      AND (A.LRECAU_FECREC BETWEEN '$fi' AND '$ff')
      ;");
      $count= $db->rows($sql);
      return $count;
    } 

    public static function VerListaFormulario ($a){
      $db = new Conexion();
      $sql = $db->query("
      SELECT A.IDITEM,B.LCLAS_ALIAS,B.LCLAS_PADRE,B.LCLAS_NOMBRE,A.CANTIDAD,A.MONTO,B.LCLAS_ESTADO FROM lrecaudacion_detalle A
      INNER JOIN lclasificador B
      ON A.IDITEM=B.LCLAS_ID
      WHERE A.LRECAU_ID LIKE '%$a'
      AND B.LCLAS_ESTADO='1'
      ORDER BY B.LCLAS_ID
      ;");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[] = $d; //ALL
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
    }     

    public static function ExisteFormulario ($a){
      $db = new Conexion();
      $sql = $db->query("
      SELECT * FROM lrecaudacion WHERE LRECAU_ID = '$a'
      ;");
      $count= $db->rows($sql);
      return $count;
    }     

    public static function ExisteFormulario_Deposito ($a){
      $db = new Conexion();
      $sql = $db->query("
      SELECT * FROM lrecaudacion_deposito WHERE LRECAU_ID = '$a'
      ;");
      $count= $db->rows($sql);
      return $count;
    } 
    
    public static function VerFormulario_Deposito ($a){
      $db = new Conexion();
      $sql = $db->query("
      SELECT LRECAU_VOUCHER FROM lrecaudacion_deposito WHERE LRECAU_ID ='$a'
      ;");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[] = $d; //ALL
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
    }     


    public static function VerListaFormulariodetalles_Uno ($a){
      $db = new Conexion();
      $sql = $db->query("
      SELECT A.NESTA_RENAES,C.NEST_NOMBRE,A.LRECAU_FECREC,
      SUBSTRING(A.LRECAU_FECREC,1,4) AÑO,SUBSTRING(A.LRECAU_FECREC,6,2) MES,SUBSTRING(A.LRECAU_FECREC,9,2) DIA,
      A.LBOL_INI,A.LBOL_FIN,A.LCANT,A.LIMP
      FROM
      (SELECT * FROM lrecaudacion WHERE LRECAU_ID = '$a') A
      INNER JOIN
      (SELECT * FROM nestablecimiento) C
      ON A.NESTA_RENAES = C.NESTA_RENAES
      ;");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[] = $d; //ALL
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
    } 

    public static function VerListaFormulariodetalles ($a,$b){
      $db = new Conexion();
      $sql = $db->query("
      SELECT 
      A.NESTA_RENAES,C.NEST_NOMBRE,A.LRECAU_FECREC,
      SUBSTRING(A.LRECAU_FECREC,1,4) AÑO,SUBSTRING(A.LRECAU_FECREC,6,2) MES,SUBSTRING(A.LRECAU_FECREC,9,2) DIA,
      A.LBOL_INI,A.LBOL_FIN,A.LCANT,A.LIMP,B.LBOL_INI,B.LBOL_FIN,B.LCANT,B.LIMP,
      (A.LCANT + B.LCANT)CANTIDAD,(A.LIMP + B.LIMP)MONTO
      FROM
      (SELECT * FROM lrecaudacion WHERE LRECAU_ID = '$a') A
      INNER JOIN
      (SELECT * FROM lrecaudacion WHERE LRECAU_ID = '$b') B
      ON SUBSTRING(A.LRECAU_ID,5,11)=SUBSTRING(B.LRECAU_ID,5,11)
      INNER JOIN
      (SELECT * FROM nestablecimiento) C
      ON A.NESTA_RENAES = C.NESTA_RENAES
      ;");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[] = $d; //ALL
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
    } 



}

/**
* 
*/
class RecaudacionDetalle extends Recaudacion
{
  
  protected $lrectip_id;
  protected $iditem;
  protected $cantidad;
  protected $monto;
  protected $celda;
   
  function __construct($a,$b,$c,$d,$e,$f)
  {
    $this->lrectip_id =$a;
    $this->lrcau_id =$b;
    $this->iditem =$c;
    $this->cantidad =$d;
    $this->monto =$e;
    $this->celda =$f;
  }

  public function IngresoDetalleRecaudacion (){
      $db = new Conexion();
      $sql = $db->query("INSERT INTO lrecaudacion_detalle (LRECAU_ID,LRECTIP_ID,IDITEM,CANTIDAD,MONTO,CELDA)
      VALUES(
      '$this->lrectip_id',
      '$this->lrcau_id',
      '$this->iditem',
      '$this->cantidad',
      '$this->monto',
      '$this->celda'
      );");
      $db->close();

  }


}


/**
* 
*/
class RecaudacionVoucher extends Recaudacion
{
  protected $lrecau_voucher;
  protected $lrecau_fecha;
  protected $lrecau_monto;
  protected $lrecau_estado;
  protected $fecha_deposito;

  function __construct($a,$b,$c,$d,$e,$f,$g)
  {
    $this->lrcau_id =$a;
    $this->lrecau_voucher =$b;
    $this->lrecau_fecha =$c;
    $this->lrecau_monto =$d;
    $this->lrecau_estado =$e;
    $this->fecha_deposito =$f;
    $this->musu_id =$g;
  }

  public function IngresoVocuherRecaudacion (){
    $db = new Conexion();
    
    $sql1 = $db->query("INSERT INTO lrecaudacion_deposito (LRECAU_ID,LRECAU_VOUCHER,LRECAU_FECHA,LRECAU_MONTO,LRECAU_ESTADO,FECHA_DEPOSITO,MUSU_ID)
      VALUES(
      '$this->lrcau_id',
      '$this->lrecau_voucher',
      '$this->lrecau_fecha',
      '$this->lrecau_monto',
      '$this->lrecau_estado',
      '$this->fecha_deposito',
      '$this->musu_id'
      );");

    $sql2 = $db->query("UPDATE lrecaudacion SET LRECAU_ESTADO='1' WHERE LRECAU_ID= '$this->lrcau_id' ;");
    
    $sql3 = $db->query("SELECT * FROM reporte_planillon WHERE LRECAU_ID= substr('$this->lrcau_id',4,11);");
    $db->close();
  }

  public function EliminarRecaudacion_Deposito (){
      $db = new Conexion();
      $sql1 = $db->query("DELETE FROM lrecaudacion_deposito WHERE LRECAU_ID='$this->lrcau_id';");
      $db->close();
  } 

  public function EliminarPlanillon(){
      $db = new Conexion();
      $sql1 = $db->query("DELETE FROM reporte_planillon WHERE LRECAU_ID='$this->lrcau_id';");
      $db->close();
  }
  public static function IngresoPlanillon($min,$max,$lrecau_id){
      $db = new Conexion();


    $sub= substr($lrecau_id,4,11);
    $tip= substr($lrecau_id,2,2);
    $año= substr($lrecau_id,4,2);
    $mes= substr($lrecau_id,6,2);
    $dia= substr($lrecau_id,8,2);
    $est= substr($lrecau_id,10,5);

    echo $lrecau_id.'<br>';
    echo $tip.'<br>';
    echo $sub.'<br>';
    echo $min.'<br>';
    echo $max.'<br>';
    
    $sql3 = $db->query("SELECT * FROM reporte_planillon WHERE LRECAU_ID= '$lrecau_id';");
    $count= $db->rows($sql3);
   
    if($count==0){

      $sql4=$db->query("
         INSERT INTO reporte_planillon (FECHA_MIN,FECHA_MAX,LRECAU_ID,LRECTIP_ID,LAÑO_ID, MES, DIA, NESTA_RENAES, NEST_NOMBRE, MONTO_TOTAL, MONTO_RDR, MONTO_SISMED, MONTO1, MONTO2, MONTO3, MONTO4, MONTO5, MONTO6, MONTO7, MONTO8, MONTO9, MONTO10, MONTO11, MONTO12, MONTO13, MONTO14, MONTO15, MONTO16, MONTO17, MONTO18, MONTO19, MONTO20, MONTO21, MONTO22, MONTO23, MONTO24, MONTO25, MONTO26, MONTO27, MONTO28, MONTO29,fecha_proceso) 
         SELECT '$min','$max','$lrecau_id','$tip','$año','$mes','$dia','$est',D.NEST_NOMBRE,
         (MONTO1+MONTO3+MONTO5+MONTO7+MONTO26+MONTO71+MONTO73) 'MONTOTOTAL',  (MONTO1+MONTO5+MONTO7+MONTO26+MONTO71+MONTO73) 'MONTORDR', MONTO3 'MONTOSISMED',
         (MONTO2+MONTO4+MONTO6)'1201_0301',MONTO2 '1_3_14_11',MONTO4 '1_3_16_14',MONTO6 '1_3_19_12',
          MONTO7 '1201_0302',MONTO8 '1_3_24_12', (MONTO9+MONTO10+MONTO11+MONTO12) '1_3_24_13', (MONTO13+MONTO14+MONTO15+MONTO16+MONTO17) '1_3_2_14',(MONTO18+MONTO19+MONTO20) '1_3_24_16', MONTO21 '1_3_24_17',(MONTO22+MONTO23+MONTO24+MONTO25) '1_3_24_199',
         (MONTO26+MONTO72) '1201_0303',(MONTO27+MONTO28+MONTO29+MONTO30+MONTO31+MONTO32+MONTO33+MONTO34+MONTO35+MONTO36) '1_3_34_11',(MONTO37+MONTO38) '1_3_34_12', MONTO39 '1_3_34_13',MONTO40 '1_3_34_14',(MONTO41+MONTO42) '1_3_34_15',(MONTO43+MONTO44) '1_3_34_16',(MONTO45+MONTO46+MONTO47+MONTO48+MONTO49) '1_3_34_17',(MONTO50+MONTO51+MONTO52+MONTO53+MONTO54) '1_3_34_199',(MONTO55+MONTO56) '1_3_34_21', MONTO57 '1_3_34_23',(MONTO58+MONTO59+MONTO60) '1_3_34_24', (MONTO61+MONTO62+MONTO63+MONTO64+MONTO65) '1_3_34_31', (MONTO66+MONTO67+MONTO68+MONTO69+MONTO70) '1_3_34_399', MONTO72 '1_3_39_216',
          MONTO73 '1202_',MONTO74 '1_5_21_62_',MONTO75 '1_5_21_699_', CURDATE()
        FROM(

        SELECT 
        IDS,SUM(MONTO1) MONTO1, SUM(MONTO2) MONTO2, SUM(MONTO3) MONTO3, SUM(MONTO4) MONTO4, SUM(MONTO5) MONTO5, SUM(MONTO6) MONTO6, SUM(MONTO7) MONTO7, SUM(MONTO8) MONTO8, SUM(MONTO9) MONTO9, SUM(MONTO10) MONTO10, SUM(MONTO11) MONTO11, SUM(MONTO12) MONTO12, SUM(MONTO13) MONTO13, SUM(MONTO14) MONTO14, SUM(MONTO15) MONTO15, SUM(MONTO16) MONTO16, SUM(MONTO17) MONTO17, SUM(MONTO18) MONTO18, SUM(MONTO19) MONTO19, SUM(MONTO20) MONTO20, SUM(MONTO21) MONTO21, SUM(MONTO22) MONTO22, SUM(MONTO23) MONTO23, SUM(MONTO24) MONTO24, SUM(MONTO25) MONTO25, SUM(MONTO26) MONTO26, SUM(MONTO27) MONTO27, SUM(MONTO28) MONTO28, SUM(MONTO29) MONTO29, SUM(MONTO30) MONTO30, SUM(MONTO31) MONTO31, SUM(MONTO32) MONTO32, SUM(MONTO33) MONTO33, SUM(MONTO34) MONTO34, SUM(MONTO35) MONTO35, SUM(MONTO36) MONTO36, SUM(MONTO37) MONTO37, SUM(MONTO38) MONTO38, SUM(MONTO39) MONTO39, SUM(MONTO40) MONTO40, SUM(MONTO41) MONTO41, SUM(MONTO42) MONTO42, SUM(MONTO43) MONTO43, SUM(MONTO44) MONTO44, SUM(MONTO45) MONTO45, SUM(MONTO46) MONTO46, SUM(MONTO47) MONTO47, SUM(MONTO48) MONTO48, SUM(MONTO49) MONTO49, SUM(MONTO50) MONTO50, SUM(MONTO51) MONTO51, SUM(MONTO52) MONTO52, SUM(MONTO53) MONTO53, SUM(MONTO54) MONTO54, SUM(MONTO55) MONTO55, SUM(MONTO56) MONTO56, SUM(MONTO57) MONTO57, SUM(MONTO58) MONTO58, SUM(MONTO59) MONTO59, SUM(MONTO60) MONTO60, SUM(MONTO61) MONTO61, SUM(MONTO62) MONTO62, SUM(MONTO63) MONTO63, SUM(MONTO64) MONTO64, SUM(MONTO65) MONTO65, SUM(MONTO66) MONTO66, SUM(MONTO67) MONTO67, SUM(MONTO68) MONTO68, SUM(MONTO69) MONTO69, SUM(MONTO70) MONTO70, SUM(MONTO71) MONTO71, SUM(MONTO72) MONTO72, SUM(MONTO73) MONTO73, SUM(MONTO74) MONTO74, SUM(MONTO75) MONTO75
        FROM(
        SELECT LRECAU_ID AS 'IDS',
        CASE WHEN (IDITEM='1') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO1,
        CASE WHEN (IDITEM='2') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO2,
        CASE WHEN (IDITEM='3') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO3,
        CASE WHEN (IDITEM='4') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO4,
        CASE WHEN (IDITEM='5') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO5,
        CASE WHEN (IDITEM='6') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO6,
        CASE WHEN (IDITEM='7') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO7,
        CASE WHEN (IDITEM='8') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO8,
        CASE WHEN (IDITEM='9') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO9,
        CASE WHEN (IDITEM='10') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO10,
        CASE WHEN (IDITEM='11') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO11,
        CASE WHEN (IDITEM='12') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO12,
        CASE WHEN (IDITEM='13') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO13,
        CASE WHEN (IDITEM='14') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO14,
        CASE WHEN (IDITEM='15') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO15,
        CASE WHEN (IDITEM='16') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO16,
        CASE WHEN (IDITEM='17') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO17,
        CASE WHEN (IDITEM='18') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO18,
        CASE WHEN (IDITEM='19') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO19,
        CASE WHEN (IDITEM='20') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO20,
        CASE WHEN (IDITEM='21') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO21,
        CASE WHEN (IDITEM='22') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO22,
        CASE WHEN (IDITEM='23') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO23,
        CASE WHEN (IDITEM='24') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO24,
        CASE WHEN (IDITEM='25') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO25,
        CASE WHEN (IDITEM='26') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO26,
        CASE WHEN (IDITEM='27') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO27,
        CASE WHEN (IDITEM='28') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO28,
        CASE WHEN (IDITEM='29') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO29,
        CASE WHEN (IDITEM='30') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO30,
        CASE WHEN (IDITEM='31') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO31,
        CASE WHEN (IDITEM='32') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO32,
        CASE WHEN (IDITEM='33') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO33,
        CASE WHEN (IDITEM='34') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO34,
        CASE WHEN (IDITEM='35') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO35,
        CASE WHEN (IDITEM='36') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO36,
        CASE WHEN (IDITEM='37') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO37,
        CASE WHEN (IDITEM='38') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO38,
        CASE WHEN (IDITEM='39') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO39,
        CASE WHEN (IDITEM='40') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO40,
        CASE WHEN (IDITEM='41') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO41,
        CASE WHEN (IDITEM='42') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO42,
        CASE WHEN (IDITEM='43') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO43,
        CASE WHEN (IDITEM='44') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO44,
        CASE WHEN (IDITEM='45') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO45,
        CASE WHEN (IDITEM='46') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO46,
        CASE WHEN (IDITEM='47') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO47,
        CASE WHEN (IDITEM='48') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO48,
        CASE WHEN (IDITEM='49') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO49,
        CASE WHEN (IDITEM='50') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO50,
        CASE WHEN (IDITEM='51') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO51,
        CASE WHEN (IDITEM='52') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO52,
        CASE WHEN (IDITEM='53') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO53,
        CASE WHEN (IDITEM='54') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO54,
        CASE WHEN (IDITEM='55') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO55,
        CASE WHEN (IDITEM='56') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO56,
        CASE WHEN (IDITEM='57') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO57,
        CASE WHEN (IDITEM='58') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO58,
        CASE WHEN (IDITEM='59') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO59,
        CASE WHEN (IDITEM='60') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO60,
        CASE WHEN (IDITEM='61') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO61,
        CASE WHEN (IDITEM='62') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO62,
        CASE WHEN (IDITEM='63') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO63,
        CASE WHEN (IDITEM='64') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO64,
        CASE WHEN (IDITEM='65') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO65,
        CASE WHEN (IDITEM='66') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO66,
        CASE WHEN (IDITEM='67') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO67,
        CASE WHEN (IDITEM='68') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO68,
        CASE WHEN (IDITEM='69') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO69,
        CASE WHEN (IDITEM='70') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO70,
        CASE WHEN (IDITEM='71') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO71,
        CASE WHEN (IDITEM='72') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO72,
        CASE WHEN (IDITEM='73') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO73,
        CASE WHEN (IDITEM='74') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO74,
        CASE WHEN (IDITEM='75') THEN MONTO ELSE CAST('0' AS DECIMAL(11,2)) END AS MONTO75
        FROM(
        select * from lrecaudacion_detalle where lrecau_id in('$lrecau_id')
        )A
        )B GROUP BY IDS
        )C
        INNER JOIN nestablecimiento D
        ON SUBSTRING(C.IDS,11,5)=D.NESTA_RENAES
        ");
        echo 'Se guardaro satisfactoriamente';
      } else{
        echo 'Ya existe';
      }
      

/*
      $x= 2018;
      $y= 6;
      $sql1 = $db->prepare('CALL Actualizar_reporte(?,?)');
      $sql1->bind_param("ii",$x,$y);
      $status = $sql1->execute();
      if ($status) {
         echo 'Se guardó satisfactoriamente';
      } else {
         echo 'Hubo un error en el guardado';
      }  
*/
      $db->close();
  }


}