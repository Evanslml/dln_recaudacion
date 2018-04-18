<?php
  // validamos el request para el login del sitio.
  if (!isset($_SESSION)) {
    session_start();
  }
  #Constantes de conexión
  define('DB_HOST','localhost');
  define('DB_USER','root');
  define('DB_PASS','root');
  define('DB_NAME','diris_recaudacion_0.1');
 
  //creamos la conexion
  class Conexion extends mysqli {
      public function __construct() {
        parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connect_errno ? die('Error en la conexión a la base de datos') : null;
        $this->set_charset("utf8");
      }
     
  }
?>