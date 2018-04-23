<?php
 //configuramos timezone vease http://php.net/manual/en/timezones.php
 date_default_timezone_set('America/Lima');
  
 //definimos ruta y titulo del sitio
 define('URL_VIEW','http://localhost:8080/diris/dirislimanorte_recaudacion/0.2/view/');
 define('TITLE_WEB','RECAUDACION DIRIS');
 define('URL_WEB','http://localhost:8080/diris/dirislimanorte_recaudacion/0.2/');
 define('NOMBRE_WEB','RECAUDACION');
 
 define('WWW','http://dirislimanorte.gob.pe/');
 //definimos url de inicios
 $Extencion = substr(strrchr(__FILE__, '.'), 1);
 //Conexion a la bases de datos
 require_once('classConexion/conexion.' . $Extencion);
 require_once('funciones/usuario.' . $Extencion);
 require_once('funciones/permiso.' . $Extencion);
 //instaciamos User() para utilizarlo en el sitio
 
 $_usuario = Acceso::User();
 $_ListaUsuario = Acceso::ListaUsuarioPerfil();
 $_ListaPerfil = Acceso::ListaPerfil();


 if (isset($_SESSION['sesion_id'])){ //Si esta logeado y  variable SESSION esta definida
	 $MPERF_ID = $_usuario[$_SESSION['sesion_id']]['MPERF_ID'];
	 $_permiso = Permiso($MPERF_ID);
 }
 
?>