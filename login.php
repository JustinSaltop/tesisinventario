
<?php
if(session_id()==''){
    session_start();
}
//limpiamos el array de la variable de ssesion. 
$_SESSION = array();
// permite destruir la sesión activa
session_destroy();
include "ajax/actualizar_empresa.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | <?php echo $nombre['nombre'] ?> </title>
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->

  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
  body {
  margin: 0;
  font-family: Arial, sans-serif;
  height: 100vh;
  overflow: hidden;
}

#myVideo {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  z-index: 1;
}

</style>
<body class="hold-transition login-page">
<video autoplay muted loop id="myVideo">
    <source src="img/fondo2.mp4" type="video/mp4">
    Tu navegador no soporta el tag de video.
  </video>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->
      <div class="">
        <img src="img/comercio_logo.png" alt="" srcset="" class="img-fluid">
      </div>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicie sesion por favor</p>

      <form action="" id="envia_login" method="post">
          <div id="mensaje"></div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario_p" placeholder="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" 
          name="clave_p" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <button type="submit"  id="envia_login"class="btn btn-primary btn-block">Iniciar sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function(){
    // capturar el valor del id que se recibe
     $('#envia_login').bind("submit", function (){
       // alert(123);
       $.ajax({
           type: 'Post',
           url:'ajax/verificalogin.php',
           data:$(this).serialize(),
           success: function (data){
                 if(data==1){
                  
                    window.location='index.php';
                 
             
                }else{
                    $('#mensaje').html(data);
                }
              
           }
       }); 
       return false;
    });
});
</script>
</body>
</html>