<?php
require_once '../conf/confconexion.php';//conexion a la base de datos
if($estadoconexion==0){
    echo "<div class='alert alert-danger' role='alert'>No se pudo conectar al servidor, favor comunicar a TICS</div>";
    exit();
}

session_start();
$inicio=$_POST['inicio'];
$fin= $_POST['fin'];
$idrolUsuario=$_SESSION['idRolUsuario_S'];
$sql = "SELECT * FROM ventas 
WHERE DATE(fecha_factura) BETWEEN '$inicio' AND '$fin';";
$result = mysqli_query($objConexion, $sql);
?>
<html>
    <head>
        
        <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
        <script type="text/javascript" src="datatables/datatables.min.js"></script>   
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
  
  
    </head>
    
    <script>
   $(document).ready(function() {    
    $('#tablaListar').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            }
    });     
});
    </script>
    <body>
        <?php 
      
            
         
        
        ?>
       
        <div class="col-12">
        
        <table id="tablaListar" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr >
                <th>N#Factura</th>
                <th>Fecha Factura</th>
             
                <th>Cliente</th>
                <th>Vendedor</th>
                 <th>Estado</th>
                <th>Total ventas</th>
                <th>Opciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        
        
        <tfoot>
            <tr>
            <th>N#Factura</th>
                <th>Fecha Factura</th>
                 
                <th>Cliente</th>
                <th>Vendedor</th>
                 <th>Estado</th>
                <th>Total ventas</th>
                <th>Opciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </tfoot>
        
         <tbody>
					<?php while($fila = mysqli_fetch_array($result)) { 
                                            
                                            if($fila['condiciones'] == '1'){
                                                 $estado = "Pagado";
                                                    $class = ' badge badge-success';
                                            }elseif ($fila['condiciones'] == '2') {
        
    
                                                    $estado = "Pendiente";
                                                      $class = " badge badge-warning";    
                                                    }
                                                     
                     
                                            
                                            
                                            ?>
                                                       
						<tr>
							<td><?php echo $fila['id_factura']; ?></td>
							<td><?php echo $fila['fecha_factura']; ?></td>
                            <?php 
                            $id_cliente=$fila['id_clientes'];
                            $sqlCanton="select * from tb_clientes where id_clientes=$id_cliente;";
                            $resultCanton= mysqli_query($objConexion, $sqlCanton);
                                $CantonArray= mysqli_fetch_array($resultCanton);
                                $Nombre=$CantonArray['nombres_apellidos'];
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
                                                        <!-- <td><?php echo $fila['condiciones']; ?></td> -->
                                                        <td><?php echo $fila['total_venta']; ?></td>
                                                       
						
							<td>  <button  class='btn btn-danger ' title='eliminar' onclick="eliminar(<?php echo $fila['numero_factura']?>);"><i class="fas fa fa-solid fa-trash"></i></button>
                            <button class='btn btn-info ' title='imprimir' onclick="imprimir_factura(<?php echo $fila['id_factura']?>);"><i class="fas  fa-print"></i></button>
                            <button class='btn btn-success ' title='ticket' onclick="ticket(<?php echo $fila['id_factura']?>);"><i class="fas  fa-file-pdf"></i></button>                 
                                                           
                                                        </td>
							<!--<td> </td>-->
                      
						</tr>
					<?php } ?>
				</tbody>
        
    </table>
    </div>
         

      
      
    </body>
</html>





