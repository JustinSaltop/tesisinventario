
<?php
include "ajax/actualizar_empresa.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Compras producto | <?php echo $nombre['nombre'] ?></title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="img/comercio_logo.png" alt="AdminLTELogo" height="100" width="150">
</div>
  <!-- Navbar -->
  <?php 
  include "header.php";
   ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php 

include "menu.php"
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Compras Producto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
          
              <!-- /.card-header -->
          
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
              <form action="" method="post" id="consulta">
              <div class="row">

             <div class="col-4">
               <div class="form-group">
                 <label for="">Fecha Inicio</label>
                 <input type="date" class="form-control" id="inicio" name="inicio">
               </div>
             </div>
             <div class="col-4">
               <div class="form-group">
                 <label for="">Fecha Fin</label>
                 <input type="date" class="form-control" id="fin" name="fin">
               </div>
             </div>
             <div class="col-4">
               <div class="form-group">
               <hr>
              <button type="submit" id="consulta" class="btn btn-success">consultar</button>
               </div>
             </div>
             </div>
             </form>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              <div id="resultados"></div> 
                 <div id='presentarTabla'></div> 
                <div id="loading"></div>
              </div>
              <!-- /.card-body -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div id="show"></div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php";
 ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="js/VentanaCentrada.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>

$(document).ready(function(){
  $('#loading').html('cargando....'); // muestra el GIF de carga
  $.ajax({
    url:'ajax/listar_compra.php',
    beforeSend: function() {
      $('#loading').html('carganado..'); // muestra el GIF de carga antes de la petición AJAX
    },
    success: function(data) {
      $('#loading').hide(); // oculta el GIF de carga después de que la petición AJAX se completa
      // maneja la respuesta de AJAX
 $('#presentarTabla').html(data);
    }
  });
});
function listar(url){
    $.ajax({
      type: 'POST',
      url:url,
      success:function(data){
          $('#presentarTabla').html(data);
      },
   });
}

$(document).ready(function(){
    // capturar el valor del id que se recibe
     $('#consulta').bind("submit", function (){
       // alert(123);
       $.ajax({
           type: 'Post',
           url:'ajax/listar_compra.php',
           data:$(this).serialize(),
           success: function (data){
           
            $('#presentarTabla').html(data);
                
              
           }
       }); 
       return false;
    });
});

function eliminar(id){
  Swal.fire({
  title: '¿Está seguro de eliminar el registro?',
  text: "   ",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
        $.ajax({
            type:'POST',
            url:'ajax/eliminar_compra.php',
            data:{
                id_p:id,
                mensaje:'eliminar'
            },
            success: function(data){
                $('#resultados').html(data);
                listar('ajax/listar_compra.php');
            }
        });
    }
})
}
function imprimir_factura(id_factura){
			// VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');

            VentanaCentrada('./pdf1/ver_factura.php?id_compra='+id_factura,'Factura','','1024','768','true');
		}

</script>
</body>
</html>