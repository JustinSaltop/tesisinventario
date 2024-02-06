<?php
require_once '../conf/confconexion.php';//conexion a la base de datos
if($estadoconexion==0){
    echo "<div class='alert alert-danger' role='alert'>No se pudo conectar al servidor, favor comunicar a TICS</div>";
    exit();
}
session_start();

$inicio = isset($_POST['inicio']) ? $_POST['inicio'] : null;
$fin = isset($_POST['fin']) ? $_POST['fin'] : null;

$idrolUsuario=$_SESSION['idRolUsuario_S'];
$sql = "SELECT * FROM compra 
WHERE DATE(fecha_factura) BETWEEN '$inicio' AND '$fin';";
$result = mysqli_query($objConexion, $sql);
?>
<html>
    <head>
        
      
  
    </head>
    
    <script>
$(function () {
    // Configuración de idioma español
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });

    // Inicialización de las tablas
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
    </script>
    <body>
        <?php 
      
            
         
        
        ?>
       
        <div class="col-12">
        
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr >
                <th>ID</th>
                <th>Fecha Compra</th>
             
                <th>Proveedor</th>
                <th>Comprador</th>
                 <th>Estado</th>
                 <th>Iva</th>
                <th>Total compra</th>
                <th>Opciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        
        
        <tfoot>
            <tr>
            <th>ID</th>
                <th>Fecha Compra</th>
             
                <th>Proveedor</th>
                <th>Comprador</th>
                 <th>Estado</th>
                 <th>Iva</th>
                <th>Total compra</th>
                <th>Opciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </tfoot>
        
         <tbody>
					<?php while($fila = mysqli_fetch_array($result)) { 
                                            
                                            if($fila['estado_factura'] == '1'){
                                                 $estado = "Valido";
                                                    $class = ' badge badge-success';
                                            }elseif ($fila['estado_factura'] == '0') {
        
    
                                                    $estado = "No valido";
                                                      $class = " badge badge-warning";    
                                                    }
                                                     
                     
                                            
                                            
                                            ?>
                                                       
						<tr>
							<td><?php echo $fila['id_compra']; ?></td>
							<td><?php echo $fila['fecha_factura']; ?></td>
                            <?php 
                            $id_proveedor=$fila['id_proveedor'];
                            $sqlCanton="select * from tb_proveedor where id_proveedor=$id_proveedor;";
                            $resultCanton= mysqli_query($objConexion, $sqlCanton);
                                $CantonArray= mysqli_fetch_array($resultCanton);
                                $Nombre=$CantonArray['nombre'];
                            ?>
                                <td><?php echo $Nombre; ?></td>
                              <?php 
                              $id_vendedor=$fila['id_usuario'];
                              $sqlCanto="select * from tb_usuario where id_usuario=$id_vendedor;";
                              $resultCanto= mysqli_query($objConexion, $sqlCanto);
                                  $CantoArray= mysqli_fetch_array($resultCanto);
                                  $Nombrevendor=$CantoArray['nombre'];
                              ?>

							<td><?php echo $Nombrevendor ?></td>
                            <td><span class="label label-<?php echo $class; ?>"><?php echo $estado?></span></td>
                                                       <td> <?php echo $fila['iva']; ?></td>
                                                        <td><?php echo $fila['total_compra']; ?></td>
                                                       
						
							<td> 
                            <?php 
                            if($idrolUsuario==1){

                            
                            ?>    
                            
                            <button  class='btn btn-danger ' title='eliminar' onclick="eliminar(<?php echo $fila['numero_factura']?>);"><i class="fas fa fa-solid fa-trash"></i></button>
                            <?php 
                    }
                            ?>
                            <button class='btn btn-info ' title='imprimir' onclick="imprimir_factura(<?php echo $fila['id_compra']?>);"><i class="fas  fa-print"></i></button>
                            <!-- <button class='btn btn-success ' title='ticket  ' onclick="ticket(<?php echo $fila['id_compra']?>);"><i class="fas  fa-file-pdf"></i></button>                      -->
                                                           
                                                        </td>
							<!--<td> </td>-->
                      
						</tr>
					<?php } ?>
				</tbody>
        
    </table>
    </div>
         

      
      
    </body>
</html>





