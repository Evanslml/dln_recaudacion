<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo TITLE_WEB; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-default/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!--<link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-default/css/estilo.min.css">-->
  <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-default/css/estilo.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-default/css/icheck/square/green.css">
  <!--Estilo -->
  <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-default/css/skin-blue-light.css">
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo URL_VIEW; ?>bootstrap-default/js/jquery-2.2.3.min.js"></script>
  <!--custom-->
  <script src="<?php echo URL_VIEW; ?>bootstrap-default/js/custom.js"></script>
  <!--Sweet-Alert-->
  <link rel="stylesheet" href="<?php echo URL_VIEW; ?>sweet-alert/sweetalert.css">

  <?php

    if(isset($_GET['view'])) {
      $vista = $_GET['view'];

      //var_dump($vista);
      switch ($vista) {
        case 'todosformatos':
        case 'formato':
        ?>
        <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-datepicker/1.3.0/css/datepicker.css">
        <script src="view/jquery-price-format/jquery.priceformat.min.js"></script>
        <script src="<?php echo URL_VIEW; ?>bootstrap-default/js/formulario.js"></script>
        <?php
        break;
        
        case 'reporteGeneral':
        ?>
        <link rel="stylesheet" href="<?php echo URL_VIEW; ?>bootstrap-datepicker/1.3.0/css/datepicker.css">
        <script src="<?php echo URL_VIEW; ?>bootstrap-default/js/Rpt_General.js"></script>
        <?php
        break;        

        default:
          # code...
          break;
      }
    }

  ?>
  
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>