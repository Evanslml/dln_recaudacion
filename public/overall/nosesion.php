<body class="hold-transition login-page">

<div class="row">
  <div class="backstrech col-md-6 user-login-slide">
  </div>
  <div class="col-md-6 user-login-slide">
      <div class="login-box">
        <div class="login-logo">
          <a><b>RECAUDACION</b> WEB</a>
          <img src="<?php echo URL_VIEW;?>/bootstrap-default/img/logo.png"/>
        </div>


        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Inicie sesión</p>
       
          <div onKeyPress="return runScriptLogin(event)">
            <div class="form-group has-feedback">
              <input type="email" id="correo" class="form-control" placeholder="Correo">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" id="password" class="form-control" placeholder="Contraseña">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" id="sesion" value="1"> Recuerdeme
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="pull-right btn btn-success" onClick="goLogin()">Login <i class="fa fa-arrow-circle-right"></i></button>
              </div>
              <!-- /.col -->
            </div>
          </div><!--run script-->
       
        </div>
        <!-- /.login-box-body -->
       <div id="_AJAX_LOGIN_"></div>
      </div>

      <div id="container-footer"></div>

      <div class="row container-copyrigth">
        <div class="col-xs-4">
          <ul class="social">
            <li><a href="#" target="blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" target="blank"><i class="fa fa-youtube-play"></i></a></li>
            <li><a href="<?php echo WWW;?>" target="blank"><i class="fa fa-globe"></i></a></li>
          </ul>
        </div>
        <div class="col-xs-8">
          <ul class="info">
            <p>Copyright © DIRIS Lima Norte 2018</p>
          </ul>
        </div>
      </div>
  </div>
</div>


<!-- /.login-box -->
<script src="<?php echo URL_VIEW; ?>bootstrap-default/js/login.js"></script>
<script src="<?php echo URL_VIEW; ?>bootstrap-default/js/jquery.backstretch.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });

     $(".backstrech").backstretch([
                "view/bootstrap-default/img/slider/minsa.png",
                "view/bootstrap-default/img/slider/contador_man.png",
                "view/bootstrap-default/img/slider/diris.png",
                "view/bootstrap-default/img/slider/farmaceutico.png",
            ], {
                fade: 750,
                duration: 4000,
                preload: 0,
                start: 2
  });
     
  });
</script>
