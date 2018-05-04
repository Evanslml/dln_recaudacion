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
    protected $lrecau_inibol;
    protected $lrecau_finbol;
    protected $lrecau_importe;
    protected $lrecau_fecdep;


    function __construct($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k)
    {
      $this->lrcau_id =$a;
      $this->nesta_renaes =$b;
      $this->lanio_id =$c;
      $this->lmes_id =$d;
      $this->lrecau_fecrec =$e;
      $this->lcomp_id =$f;
      $this->lrectip_id =$g;
      $this->lrecau_inibol =$h;
      $this->lrecau_finbol =$i;
      $this->lrecau_importe =$j;
      $this->lrecau_fecdep =$k;
    }

    public function IngresarRecaudacion (){
      $db = new Conexion();
      $sql = $db->query("INSERT INTO LRECAUDACION VALUES('$this->lrcau_id','$this->nesta_renaes','$this->lanio_id','$this->lmes_id',
      '$this->lrecau_fecrec','$this->lcomp_id','$this->lrectip_id','$this->lrecau_inibol','$this->lrecau_finbol','$this->lrecau_importe','$this->lrecau_fecdep')");

    } 


}

