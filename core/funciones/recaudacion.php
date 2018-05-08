<?php 

class Recaudacion
{
	  
    protected $lrcau_id;
    protected $nesta_renaes;
    protected $lanio_id;
    protected $lmes_id;
    protected $lrecau_fecrec;
    protected $lcomp_id;
    protected $lbol_rdrini;
    protected $lbol_rdrfin;
    protected $lcant_rdr;
    protected $limp_rdr;
    protected $lbol_sismedini;
    protected $lbol_sismedfin;
    protected $lcant_sismed;
    protected $limp_sismed;
    protected $fecha_ingreso;
    protected $lrecau_estado;


    function __construct($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p)
    {
      $this->lrcau_id =$a;
      $this->nesta_renaes =$b;
      $this->lanio_id =$c;
      $this->lmes_id =$d;
      $this->lrecau_fecrec =$e;
      $this->lcomp_id =$f;
      $this->lbol_rdrini =$g;
      $this->lbol_rdrfin =$h;
      $this->lcant_rdr =$i;
      $this->limp_rdr =$j;
      $this->lbol_sismedini =$k;
      $this->lbol_sismedfin =$l;
      $this->lcant_sismed =$m;
      $this->limp_sismed =$n;
      $this->fecha_ingreso =$o;
      $this->lrecau_estado =$p;
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

    public function IngresarRecaudacion (){
      $db = new Conexion();
      $sql = $db->query("INSERT INTO lrecaudacion (LRECAU_ID,NESTA_RENAES,LANIO_ID,LMES_ID,LRECAU_FECREC,
      LCOMP_ID,LBOL_RDRINI,LBOL_RDRFIN,LCANT_RDR,LIMP_RDR,LBOL_SISMEDINI,LBOL_SISMEDFIN,LCANT_SISMED,LIMP_SISMED,FECHA_INGRESO,LRECAU_ESTADO) 
      VALUES(
      '$this->lrcau_id',
      '$this->nesta_renaes',
      '$this->lanio_id',
      '$this->lmes_id',
      '$this->lrecau_fecrec',
      '$this->lcomp_id',
      '$this->lbol_rdrini',
      '$this->lbol_rdrfin',
      '$this->lcant_rdr',
      '$this->limp_rdr',
      '$this->lbol_sismedini',
      '$this->lbol_sismedfin',
      '$this->lcant_sismed',
      '$this->limp_sismed',
      '$this->fecha_ingreso',
      '$this->lrecau_estado'
      );");
      $db->close();
    } 

    public static function BuscarRecaudacionFecha ($e,$fi,$ff,$offset,$per_page){
      $db = new Conexion();
      $sql = $db->query("SELECT 
      A.LRECAU_ID,A.NESTA_RENAES,A.LANIO_ID,A.LRECAU_FECREC,
      A.LBOL_RDRINI,A.LBOL_RDRFIN,A.LCANT_RDR,A.LIMP_RDR,
      A.LBOL_SISMEDINI,A.LBOL_SISMEDFIN,A.LCANT_SISMED,A.LIMP_SISMED,
      A.LRECAU_ESTADO, B.NEST_NOMBRE
      FROM lrecaudacion A INNER JOIN nestablecimiento B on A.NESTA_RENAES=B.NESTA_RENAES
      WHERE SUBSTRING(A.LRECAU_ID,9,5)= '$e' 
      AND (A.LRECAU_FECREC BETWEEN '$fi' AND '$ff')
      order by A.LRECAU_FECREC desc
      LIMIT $offset,$per_page
      ;");
      if($sql->num_rows > 0) {
      while($d = $sql->fetch_array()) {
        $dato[$d['LRECAU_ID']] = $d;
      }
      } else {
        $dato = false;
      }
      $sql->free();
      $db->close();
      return $dato;
      
    }     

    public static function CantidadTotlaRecaudacionFecha ($e,$fi,$ff){
      $db = new Conexion();
      $sql = $db->query("SELECT * FROM lrecaudacion A
      WHERE SUBSTRING(A.LRECAU_ID,9,5)= '$e' 
      AND (A.LRECAU_FECREC BETWEEN '$fi' AND '$ff')
      order by LRECAU_FECREC desc
      ;");
      $count= $db->rows($sql);
      return $count;
      
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

  function __construct($a,$b,$c,$d,$e,$f)
  {
    $this->lrcau_id =$a;
    $this->lrecau_voucher =$b;
    $this->lrecau_fecha =$c;
    $this->lrecau_monto =$d;
    $this->lrecau_estado =$e;
    $this->fecha_deposito =$f;
  }

  public function IngresoVocuherRecaudacion (){
    $db = new Conexion();
    $sql = $db->query("INSERT INTO lrecaudacion_deposito (LRECAU_ID,LRECAU_VOUCHER,LRECAU_FECHA,LRECAU_MONTO,LRECAU_ESTADO,FECHA_DEPOSITO)
      VALUES(
      '$this->lrcau_id',
      '$this->lrecau_voucher',
      '$this->lrecau_fecha',
      '$this->lrecau_monto',
      '$this->lrecau_estado',
      '$this->fecha_deposito'
      );");
    $sql1 = $db->query("UPDATE lrecaudacion SET LRECAU_ESTADO='1' WHERE LRECAU_ID= '$this->lrcau_id' ;");
      $db->close();
  }


}