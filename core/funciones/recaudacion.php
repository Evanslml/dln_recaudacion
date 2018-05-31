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
      ORDER BY A.LRECAU_FECREC DESC,A.LRECTIP_ID 
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
      SUM(A.LCANT + B.LCANT)CANTIDAD,SUM(A.LIMP + B.LIMP)MONTO
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
    
    $db->close();
  }


}