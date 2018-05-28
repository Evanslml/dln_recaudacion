<?php
  // validamos el request para el login del sitio.
  if (!isset($_SESSION)) {
    session_start();
  }
  #Constantes de conexión
  
/*  define('DB_HOST','localhost');*/
/*  define('DB_USER','root');*/
/*  define('DB_PASS','P4ssw0rd>2018');*/
/*  define('DB_NAME','dln_recaudacion');*/

/*define('DB_HOST','localhost');*/
/*define('DB_USER','root');*/
/*define('DB_PASS','root');*/
/*define('DB_NAME','02_dln_recaudacion');*/

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','02_dln_recaudacion');

  //creamos la conexion
  class Conexion extends mysqli {

      public function __construct() {
        parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connect_errno ? die('Error en la conexión a la base de datos') : null;
        $this->set_charset("utf8");
      }

      public function recorrer($y){
        return mysqli_fetch_array($y);
      }
     
      public function rows($y){
        return mysqli_num_rows($y);
      }
  }
  
?>