  $(function () {
    // Mostrar mensaje si el envio es correcto o tiene errores
    $('#FormLogin').parsley().on('field:validated', function() {
      // var ok = $('.parsley-error').length === 0;
      // $('.bs-callout-info').toggleClass('hidden', !ok);
      // $('.bs-callout-warning').toggleClass('hidden', ok);
    })
    $('#FormLogin').on('submit', function(event){
     event.preventDefault();
     if($('#FormLogin').parsley().isValid())
     {
      /* Recojemos los datos del formulario*/
      var vUser = $('#txtUser').val();
      var vPass = $('#txtPass').val();
      var vData = {"accion":"login", "txtUser":vUser, "txtPass":vPass}
       var vurl = "backend/datos/controller/accessController.php";
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
             // $('#login')[0].reset();
             $('#FormLogin').parsley().reset();
             $('#submit').removeAttr("disabled")
             // $('#submit').val('Submit');
               if (data.Perfil == 1) {
                  document.location.href = "backend/vista/home/";
               }else{

               }
             }
             else{
             bootbox.alert({
                 message: data.message,
                 size: 'small',
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



  /* PARA RECUPARAR CONTRASENA */
    // Mostrar mensaje si el envio es correcto o tiene errores
    /*$('#RecuperarContrasena').parsley().on('field:validated', function() {
      // var ok = $('.parsley-error').length === 0;
      // $('.bs-callout-info').toggleClass('hidden', !ok);
      // $('.bs-callout-warning').toggleClass('hidden', ok);
    });*/
    $('#RecuperarContrasena').on('submit', function(event){
     event.preventDefault();
     if($('#RecuperarContrasena').parsley().isValid())
     {
      /* Recojemos los datos del formulario*/
      var vEmail = $('#txtEmailU').val();
      var vCed = $('#txtDoc').val();
      var vData = {"accion":"rem", "txtCed":vCed, "txtEmail":vEmail}
       var vurl = "backend/datos/controller/accessController.php";
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
             // $('#login')[0].reset();
             $('#RecuperarContrasena').parsley().reset();
             $('#submit').removeAttr("disabled")
             // $('#submit').val('Submit');
                bootbox.alert({
                    message: data.message,
                    size: 'small',
                    callback: function (result) {
                        document.location.href = "index.php";
                    }
                });
             }
             else{
             bootbox.alert({
                 message: data.message,
                 size: 'small',
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
















  $(document).ready(function(){

    // bootbox.alert({
    //     message: "This is an alert with a callback!",
    //     size: 'small',
    //     className: 'rubberBand animated',

    //     callback: function () {
    //        document.location.href = "index.php";
    //     }
    // })

  });