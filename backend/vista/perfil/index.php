<?php
  include_once("../../../backend/datos/AnsTek_libs/integracion.inc.php");
  include_once("../resource/header.php");
  include_once("../resource/nav.php");
  include_once("../resource/librerias.php");
  include_once("../../datos/model/usuarios.class.php");
  if(Session::get('Perfil') != 1)
  header('Location: logout.php');

  /* NOMBRE PARA LA SESSION*/
  $vname = Session::get('Nombre');
  $vfoto = Session::get('Foto');
  $vPerfil = Session::get('Perfil');
  $Id = Session::get('Id');

  if ($vPerfil = 1) {
    $vPerfil = "Administrador";
  }elseif($vPerfil = 2){
    $vPerfil = "Usuario";
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | User Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php LibreriasCss(); ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- IMPRIMIMOS EL HEADER DE LA PAGINA -->
  <?php HeaderAdmin(); ?>

  <!-- IMPRIMIMOS EL NAV DE LA PAGINA -->
  <?php NavAdmin(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Datos de Perfil
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Perfil</a></li>
        <li class="active">Datos perfil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../../backend/datos/<?php echo $vfoto; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $vname; ?></h3>

              <p class="text-muted text-center"><?php echo $vPerfil; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Datos</a></li>
              <li><a href="#timeline" data-toggle="tab">Contrasena</a></li>
              <li><a href="#settings" data-toggle="tab">Otros</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form class="form-horizontal" id="usuarios">
                  <div class="form-group">
                    <label for="txtImg" class="col-sm-2 control-label">Foto de Perfil</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" placeholder="Adjunte archivo"  name="txtImg" id="txtImg">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Cédula</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Cédula" data-parsley-type="number" data-parsley-required-message="Campo requerido" required="" name="txtDoc" id="txtDoc">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Nombre Completo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nombre Completo"  data-parsley-required-message="Campo requerido" required="" name="txtName" id="txtName">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Dirección" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtDir" id="txtDir">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Celular o teléfono" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtTel" id="txtTel">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" placeholder="Email" required="" data-parsley-trigger="keyup" data-parsley-type="email"  data-parsley-required-message="Campo requerido" name="txtEml" id="txtEml">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Escriba un nombre de usuario" required="" data-parsley-trigger="keyup"   data-parsley-required-message="Campo requerido" name="txtUser" id="txtUser">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div id="upd"></div>
                      <input type="hidden" name="txtId" id="txtId" value="">
                      <input type="hidden" name="txtTab" id="txtTab" value="1">
                      <button type="submit" class="btn btn-danger">Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <form class="form-horizontal" id="NuevaContrasena">
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Nueva Contrasena</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Nueva contrasena" required="" data-parsley-trigger="keyup" data-parsley-required-message="Campo requerido" name="txtPassU" id="txtPassU">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Confirmar Contrasena</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Escriba un nombre de usuario" required="" data-parsley-trigger="keyup" data-parsley-equalto="#txtPassU"  data-parsley-equalto-message="Las contrasenas no coinciden"  data-parsley-required-message="Campo requerido" name="txtPassU2" id="txtPassU2">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="hidden" name="txtUserId" id="txtUserId" value=<?php echo $Id;?>>
                      <button type="submit" class="btn btn-danger">Actualizar</button>
                    </div>
                  </div>
                </form>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <!-- Post -->
                <div class="post">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../../dist/img/user1-128x128.jpg" alt="user image">
                  <span class="username">
                    <a href="#">Jonathan Burke Jr.</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
                <span class="description">Shared publicly - 7:30 PM today</span>
                </div>
                <!-- /.user-block -->
                <p>
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore the hate as they create awesome
                tools to help create filler text for everyone from bacon lovers
                to Charlie Sheen fans.
                </p>
                <ul class="list-inline">
                <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                </li>
                <li class="pull-right">
                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
                </ul>

                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../../dist/img/user7-128x128.jpg" alt="User Image">
                  <span class="username">
                    <a href="#">Sarah Ross</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
                <span class="description">Sent you a message - 3 days ago</span>
                </div>
                <!-- /.user-block -->
                <p>
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore the hate as they create awesome
                tools to help create filler text for everyone from bacon lovers
                to Charlie Sheen fans.
                </p>

                <form class="form-horizontal">
                <div class="form-group margin-bottom-none">
                <div class="col-sm-9">
                  <input class="form-control input-sm" placeholder="Response">
                </div>
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                </div>
                </div>
                </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../../dist/img/user6-128x128.jpg" alt="User Image">
                  <span class="username">
                    <a href="#">Adam Jones</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
                <span class="description">Posted 5 photos - 5 days ago</span>
                </div>
                <!-- /.user-block -->
                <div class="row margin-bottom">
                <div class="col-sm-6">
                <img class="img-responsive" src="../../../dist/img/photo1.png" alt="Photo">
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <img class="img-responsive" src="../../../dist/img/photo2.png" alt="Photo">
                    <br>
                    <img class="img-responsive" src="../../../dist/img/photo3.jpg" alt="Photo">
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <img class="img-responsive" src="../../../dist/img/photo4.jpg" alt="Photo">
                    <br>
                    <img class="img-responsive" src="../../../dist/img/photo1.png" alt="Photo">
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <ul class="list-inline">
                <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                </li>
                <li class="pull-right">
                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
                </ul>

                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php LibreriasJs(); ?>





<script src="../../js/usuarios.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    var vId = '<?php echo $Id; ?>';
    perfil(vId,0);

  });
</script>



</body>
</html>
