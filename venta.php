<?php
include "ajax/actualizar_empresa.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ventas | <?php echo $nombre['nombre'] ?></title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <script src="js/VentanaCentrada.js"></script>
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
            <h1>Registro ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">ventas</li>
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
              <div class="card-header bg-primary">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
                 <h4><i class="fas fa-shopping-cart"></i> Nueva venta</h4> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="" method="post" id="datos_factura">  
                                 <div class="row">
                                    
                                    <div class="col-lg-3">
                    <div class="form-group"> 
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita">Cliente</label>
                        
                        <select class="cliente form-control" name="cliente" id="id_cliente" required>
						<option value="">Selecciona el Cliente</option>
					</select>
                        </div>
                    </div>
              
                   
                  
                  
                          
                            <br>

                          
                         
                    
                        
                        <div class="col-lg-2">
                    <div class="form-group"> 
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita">fecha Venta</label>
                        
                          <input type="datetime" name="fecha" id="fecha" class="form-control" readonly value="<?php echo date('Y-m-d h:i:s') ?>">
                        </div>


                        </div>
                        <div class="col-lg-2">
                    <div class="form-group"> 
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita">Impuesto</label>
                        
                            <input   id="iva"name="iva" class="form-control"    value="0"  placeholder="iva"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="form-group"> 
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita">vendedor</label>
                        
                           <select name="vendedor" class="form-control"  id="id_vendedor">
                               <option value="<?php echo $idUsuario ?>"><?php echo $nombre ?></option>
                           </select>
                        </div>


                        </div>
                        <div class="col-lg-2">
                    <div class="form-group"> 
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita"> pago</label>
                        
                           <select name="pagos" class="custom-select"  id="condiciones">
                               <option value="1">Contado</option>
                               <option value="2">pendiente</option>
                           </select>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <label for=""></label>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success" id="datos_factura"><i class="fa fa-print"></i> Guardar venta</button>
                    </div>    
                </div>
                    </div>
                  
         
                    </form>
                    <br>
                    <div class="card-header bg-info">
                    <h4 class=""><i class="fas fa-tag"></i> Detalles de venta</h4>
                    </div>
                    <br>
                    <div class="row">
                 
                <div class="col-2">
            <div class="form-group">
                <label for="">codigo</label>
                <input type="text " id="codigo" class="form-control" placeholder="codigo" disabled>
            </div>
                </div>
                <div class="col-3">
            <div class="form-group">
                <label for="">nombre</label>
                <select class="producto form-control" name="producto" id="id_producto" required>
						<option value="">Selecciona el producto</option>
					</select>
            </div>
                </div>
                <div class="col-2">
            <div class="form-group">
                <label for="">Cantidad</label>
                <input type="text " class="form-control" id="cantidad" placeholder="0">
            </div>
                </div>
            
                <div class="col-1">
            <div class="form-group">
                <label for="">stock</label>
                <input type="text " id="stock" disabled class="form-control" id="cantidad" placeholder="stock">
            </div>
                </div>
                <div class="col-2">
            <div class="form-group">
                <label for="">Precio</label>
                <input type="text " class="form-control" id="precio" placeholder="precio" disabled>
            </div>
                </div>
               
                <div class="col-2">
         
           <br>

             <button class="btn btn-primary" onclick="agregar();">Agregar producto</button>
            
                </div>
                    </div>
            

                    <br>
                    <div class="col-12">
                            <div id="respuesta"> </div>
                            </div>
                            </div>
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

<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/VentanaCentrada.js"></script>
<!-- Page specific script -->
<script>





$(document).ready(function() {
    $( ".cliente" ).select2({        
    ajax: {
        url: "ajax/clientes_json.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
})
});


$(document).ready(function() {
    $( ".producto" ).select2({        
    ajax: {
        url: "ajax/productos_json.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on('change', function (e){
		var stock = $('.producto').select2('data')[0].stock;
		var codigo = $('.producto').select2('data')[0].codigo;
		var precioventa = $('.producto').select2('data')[0].precioventa;
		$('#stock').val(stock);
		$('#codigo').val(codigo);
		$('#precio').val(precioventa);
      
})
});

	function mostrar_items(){
		var parametros={"action":"ajax"};
		$.ajax({
			url:'ajax/items.php',
			data: parametros,
			 beforeSend: function(objeto){
			 $('.items').html('Cargando...');
		  },
			success:function(data){
				$(".items").html(data).fadeIn('slow');
		}
		})
	}
	



function agregar ()
		{
            var id=$('#id_producto').val();
			var precio_venta=$('#precio').val();
			var cantidad=$('#cantidad').val();
            var stock =$('#stock').val();
            var iva =$('#iva').val();
			//Inicia validacio
			//Fin validacion
			if(stock<=0){
                Swal.fire({
  icon: 'error',
  title: 'Stock en 0 por favor avastecer',
  text: 'Stock en 0',
  footer: ''
})
            }else{

          

			$.ajax({
        type: "POST",
        url: "ajax/agregar_venta.php",
        data: {
           id:id,
           precio_venta:precio_venta,
           cantidad:cantidad,
           iva:iva

        },
		 beforeSend: function(objeto){
			$("#respuesta").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#respuesta").html(datos);
		}
			});
		}
    }
		
	function eliminar (id)
		{
			
	$.ajax({
        type: "GET",
        url: "ajax/agregar_venta.php",
        data: {id:id
        },
		 beforeSend: function(objeto){
			$("#respuesta").html("Mensaje: Cargando...");
		  },
        success: function(data){
		$("#respuesta").html(data);
		}
			});

		}
    

        $("#datos_factura").submit(function(){
            var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  var iva = $("#iva").val();
          var abono = $("#descuento_input").val();
		
		
          VentanaCentrada('./pdf1/factura_venta.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones+'&iva='+iva,'Factura','','1024','768','true');
	 	});

</script>
</body>
</html>