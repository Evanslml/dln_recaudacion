function goLogin() {
  var connect, form, response, result, user, pass, sesion;
  user = __('correo').value;
  pass = __('password').value;
  sesion = __('sesion').checked ? true : false;
  form = 'user=' + user + '&pass=' + pass + '&sesion=' + sesion;
  connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function() {
    if(connect.readyState == 4 && connect.status == 200) {
      if(connect.responseText == 1) {
        result = '<div class="alert alert-form alert-success text-xs-center">';
        result += '<span>Conectado..!';
        result += '<strong> Estamos redireccionando...</strong></span>';
        result += '</div>';
		__('_AJAX_LOGIN_').innerHTML = result;
		location.reload();
      } else {
        __('_AJAX_LOGIN_').innerHTML = connect.responseText;
      }
    } else if(connect.readyState != 4) {
      result = '<div class="alert alert-form alert-warning text-xs-center">';
      result += '<span>Procesando...';
      result += '<strong> espere porfavor....   </strong> <img src="http://localhost:8080/diris/dirislimanorte_recaudacion/0.2/view/bootstrap-default/img/ajax-loader.gif"> </span>';
      result += '</div>';
      __('_AJAX_LOGIN_').innerHTML = result;
    }
  }
  connect.open('POST','http://localhost:8080/diris/dirislimanorte_recaudacion/0.2/ajax.php?mode=login',true);
  connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  connect.send(form);
}

function runScriptLogin(e) {
  if(e.keyCode == 13) {
    goLogin();
  }
}