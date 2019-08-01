  $(function () {
    // Mostrar mensaje si el envio es correcto o tiene errores
    /*$('#usuarios').parsley().on('field:validated', function() {
      var ok = $('.parsley-error').length === 0;
      $('.bs-callout-info').toggleClass('hidden', !ok);
      $('.bs-callout-warning').toggleClass('hidden', ok);
    })*/

    $('#usuarios').on('submit', function(event){
     event.preventDefault();
     if($('#usuarios').parsley().isValid())
     {
       var vData = new FormData(document.getElementById("usuarios"));
       var Tab = $('#txtTab').val();

       if (Tab == 0) {
          var vurl = "backend/datos/controller/usuariosController.php";

       }else if (Tab == 1){
          var vurl = "../../datos/controller/usuariosController.php";
       }else{
          var vurl = "../../datos/controller/usuariosController.php";
       }

      $.ajax({
       url:vurl,
       method:"POST",
       data:vData,
       contentType: false,
       processData: false,
       beforeSend:function(){
        $('#submit').attr('disabled','disabled');
       },
       success:function(data)
       {
         if (data.success){
             // $('#usuarios')[0].reset();
             $('#usuarios').parsley().reset();
             $('#submit').removeAttr("disabled")
             // $('#submit').val('Submit');

             bootbox.confirm({
                 message: data.message,
                 callback: function (result) {
                     document.location.href = "index.php";
                 }
             });


             }
             else{
             bootbox.confirm({
                 message: data.message,
                 callback: function (result) {
                     document.location.href = "index.php";
                 }
             });
             // document.getElementById("login").reset();
             }
         }
      });
     }else{
       alert("paila");
     }
    });

  });

  /***************************************************************/
  /*               CARGA DATOS DE USUARIO                          */
  /***************************************************************/
  function perfil(Id,Tab){
    /* Realiza conexión con el servidor */
    var vId = Id;
    var vTab = Tab;

    var vurl = "";
    if (vTab == 0) {
      var vurl = "../../datos/controller/usuariosController.php";
    }else{
      var vurl = "../../datos/controller/usuariosController.php";
    }
    if(vId != 0){

      $.ajax({
        data: {"accion":"single", "pId":vId},
        type: "POST",
        datatype: "json",
        url: vurl,
      })

      .done(function(data){
        if (data.success) {
          $('#txtDoc').val(data.Cedula);
          $('#txtName').val(data.Nombre);
          $('#txtDir').val(data.Direccion);
          $('#txtTel').val(data.Telefono);
          $('#txtEml').val(data.Email);
          $('#txtUser').val(data.Usuario);
          $("#upd").empty();
          $("#upd").append('<input type="hidden" id="img" name="accion" class="form-control" value="upd">');
          $('#txtId').val(vId);
        }
      })
      .fail(function(){
          alert("Ha ocurrido un problema");
      });
    }
  }


  /* VALIDACION PARA NUEVA CONTRASENA  */
  $(function () {
    // Mostrar mensaje si el envio es correcto o tiene errores


    $('#NuevaContrasena').on('submit', function(event){
     event.preventDefault();
     if($('#NuevaContrasena').parsley().isValid())
     {

      var vPass =  $('#txtPassU2').val();
      var vUserId =  $('#txtUserId').val();

      vData = {"accion": "chg", "pPass":vPass, "pId":vUserId}
      var vurl = "../../datos/controller/usuariosController.php";

      $.ajax({
       url:vurl,
       method:"POST",
       data:vData,
       beforeSend:function(){
        $('#submit').attr('disabled','disabled');
       },
       success:function(data)
       {
         if (data.success){
             // $('#usuarios')[0].reset();
             $('#usuarios').parsley().reset();
             $('#submit').removeAttr("disabled")
             // $('#submit').val('Submit');

             bootbox.confirm({
                 message: data.message,
                 callback: function (result) {
                     document.location.href = "index.php";
                 }
             });


             }
             else{
             bootbox.confirm({
                 message: data.message,
                 callback: function (result) {
                     document.location.href = "index.php";
                 }
             });
             // document.getElementById("login").reset();
             }
         }
      });
     }else{
       alert("paila");
     }
    });

  });


  /***************************************************************/
  /*               CARGA DATOS DE USUARIO                          */
  /***************************************************************/
  function VerUsuario(Id){
    /* Realiza conexión con el servidor */
    var vId = Id;

    var vurl = "";

    var vurl = "../../datos/controller/usuariosController.php";

    if(vId != 0){

      $.ajax({
        data: {"accion":"single", "pId":vId},
        type: "POST",
        datatype: "json",
        url: vurl,
      })

      .done(function(data){
        if (data.success) {
          $('#verUsuario').modal({keyboard: false});
          $("#ft").append('<img src="../../datos/'+data.Foto+'" width="45px">');
          $('#cedu').html(data.Cedula);
          $('#nombre').html(data.Nombre);
          $('#tel').html(data.Telefono);
          $('#dir').html(data.Direccion);
          $('#mail').html(data.Email);
          $('#per').html(data.Perfil);
          $('#usu').html(data.Usuario);
          $('#reg').html(data.Created_at);
          $("#upd").empty();
          $("#upd").append('<input type="hidden" id="img" name="accion" class="form-control" value="upd">');
          $('#txtId').val(vId);
        }
      })
      .fail(function(){
          alert("Ha ocurrido un problema");
      });
    }
  }


  /***************************************************************/
  /*               CARGA DATOS DE USUARIO                          */
  /***************************************************************/
  function UpdatedUsuario(Id){
    /* Realiza conexión con el servidor */
    var vId = Id;
    var vurl = "";
    var vurl = "../../datos/controller/usuariosController.php";
    if(vId != 0){
      $.ajax({
        data: {"accion":"single", "pId":vId},
        type: "POST",
        datatype: "json",
        url: vurl,
      })
      .done(function(data){
        if (data.success) {
          $('#modal-UpdatedUser').modal({keyboard: false});
          $('#txtDocup').val(data.Cedula);
          $('#txtNameup').val(data.Nombre);
          $('#txtDirup').val(data.Direccion);
          $('#txtTelup').val(data.Telefono);
          $('#txtEmlup').val(data.Email);
          $('#txtUserup').val(data.Usuario);
          $('#txtIdup').val(vId);
        }
      })
      .fail(function(){
          alert("Ha ocurrido un problema");
      });
    }
  }






$("#NuevoUsuario").click(function(){
    $("#usuarios")[0].reset();
   $('#modal-User').modal({keyboard: false});

 });



  $('#usuariosup').on('submit', function(event){
   event.preventDefault();
   if($('#usuariosup').parsley().isValid())
   {
     var vData = new FormData(document.getElementById("usuariosup"));
     var Tab = $('#txtTab').val();

     if (Tab == 0) {
        var vurl = "backend/datos/controller/usuariosController.php";

     }else if (Tab == 1){
        var vurl = "../../datos/controller/usuariosController.php";
     }else{
        var vurl = "../../datos/controller/usuariosController.php";
     }



    $.ajax({
     url:vurl,
     method:"POST",
     data:vData,
     contentType: false,
     processData: false,
     beforeSend:function(){
      $('#submit').attr('disabled','disabled');
     },
     success:function(data)
     {
       if (data.success){
           // $('#usuarios')[0].reset();
           $('#usuariosup').parsley().reset();
           $('#submit').removeAttr("disabled")
           // $('#submit').val('Submit');

           bootbox.confirm({
               message: data.message,
               callback: function (result) {
                   document.location.href = "index.php";
               }
           });


           }
           else{
           bootbox.confirm({
               message: data.message,
               callback: function (result) {
                   document.location.href = "index.php";
               }
           });
           // document.getElementById("login").reset();
           }
       }
    });
   }else{
     alert("paila");
   }
  });


  /***************************************************************/
  /*                 Elimina servicio                    */
  /**************************************************************/
  function DelRegistro(Id){
    /* Realiza conexión con el servidor */
    var vId = Id;

    if (!confirm("Esta seguro de ElIMINAR éste registro?")) {
      return;
    };


    var vurl = "../../datos/controller/usuariosController.php";
    if(vId != 0){
      $.ajax({
        data: {"accion":"del", "pId":vId},
        type: "POST",
        datatype: "json",
        url: vurl,
      })
      .done(function(data){
        if (data.success) {

           bootbox.alert(data.message, function() {
               document.location.href = "index.php";
           });

        }else{

            bootbox.alert(data.message, function() {
                document.location.href = "index.php";
            });
        }
      })
      .fail(function(){
          alert("Ha ocurrido un problema");
      });
    }

  }



  $("#refresh").click(function(){
      location.reload(true);
  });








  $(document).ready(function(){
    $('#Date1').val("");

    // bootbox.alert({
    //     message: "This is an alert with a callback!",
    //     size: 'small',
    //     className: 'rubberBand animated',

    //     callback: function () {
    //        document.location.href = "index.php";
    //     }
    // })



  });