<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="build/custom.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <div class="bs-callout bs-callout-warning hidden">
      <h4>Oh snap!</h4>
      <p>This form seems to be invalid :(</p>
    </div>

    <div class="bs-callout bs-callout-info hidden">
      <h4>Yay!</h4>
      <p>Everything seems to be ok :)</p>
    </div>

    <form id="usuarios"  role="form" data-parsley-validate="" novalidate="novalidate" enctype="multipart/form-data">
      <div class="form-group has-feedback">
        <input type="file" class="form-control" placeholder="Adjunte archivo"  data-parsley-required-message="Adjunte archivo" required="" name="txtImg" id="txtImg">
        <span class="glyphicon glyphicon-file form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Cédula" data-parsley-type="number" data-parsley-required-message="Campo requerido" required="" name="txtDoc" id="txtDoc">
        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nombre Completo"  data-parsley-required-message="Campo requerido" required="" name="txtName" id="txtName">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Dirección" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtDir" id="txtDir">
        <span class="glyphicon glyphicon-th-large form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Celular o teléfono" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtTel" id="txtTel">
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" required="" data-parsley-trigger="keyup" data-parsley-type="email"  data-parsley-required-message="Campo requerido" name="txtEml" id="txtEml">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Escriba un nombre de usuario" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtUser" id="txtUser">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="txtPass" placeholder="Contraseña" required="" data-parsley-required-message="Campo requerido" name="txtPass" id="txtPass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirme Contraseña" required="" data-parsley-equalto="#txtPass" data-parsley-required-message="Campo requerido">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="check" required=""> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="txtId" id="txtId" value="0">
          <input type="hidden" name="txtTab" id="txtTab" value="0">
          <input type="hidden" name="txtPerfil" id="txtPerfil" value="2">
          <input type="hidden" name="accion" id="" value="ins">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="index.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Parsleyjs -->
<script src="bower_components/parsleyjs/parsley.js"></script>
<script src="bower_components/bootbox/bootbox.min.js"></script>
<script src="bower_components/bootbox/bootbox.locales.min.js"></script>
<script src="backend/js/usuarios.js"></script>
<script>
  $(function () {
    $('#check').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '50%' /* optional */
    });
  });

</script>
</body>
</html>
