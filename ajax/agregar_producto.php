<?php
require_once '../conf/confconexion.php';//conexion a la base de datos
if($estadoconexion==0){
    echo "<div class='alert alert-danger' role='alert'>No se pudo conectar al servidor, favor comunicar a TICS</div>";
    exit();
}
$sql = "SELECT * FROM tb_productos;";
$result = mysqli_query($objConexion, $sql);
session_start();
 $idrolUsuario=$_SESSION['idRolUsuario_S'];
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
        // Para cambiar el lenguaje a español
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
        },
        "lengthMenu": [5, 10, 25] // Mostrar opciones para mostrar 5, 10 o 25 registros
    });
});

    </script>
    <body>
         <?php 
          
         ?>
     
    
        <table id="tablaListar" class="table table-striped table-bordered" style="width:100%">       
        

        <thead>
            <tr>
               
           
            <th>Codigo</th>
            <th>Cantidad</th>
                <th>Descripcion</th>
                 <th>Imagen</th>
                  <th>Stock</th>
                 
                    <th>precio venta</th>
                    
                
                   
                       <th>agregar</th>
                
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        
        
        <tfoot>
            <tr>
              
                 
           
            <th>Codigo</th>
            <th>Cantidad</th>
                <th>Descripcion</th>
                 <th>Imagen</th>
                  <th>Stock</th>
                 
                    <th>precio venta</th>
                    
                
                   
                       <th>agregar</th>
                
                
            </tr>
        </tfoot>
        
         <tbody>
					<?php while($fila = $result->fetch_assoc()) { 
                                            
                                                                 
                                        if($fila['stock']>=20){
                                            
                                               $class = ' badge badge-success';
                                       }elseif ($fila['stock']<=10) {
   

                                              
                                                 $class = " badge badge-danger";    
                                               }   else{
                                                $class = " badge badge-warning"; 
                                               }    
                                            
                                            
                                            ?>
                                                       
						<tr>
							
							
                            <td><?php echo $fila['codigo']; ?></td>
                                                        
                                                        <td><input type="number" name="cantidad" id="cantidad_<?php echo $fila['id_productos']?>" class="form-control" value="1"></td>
                                                        <td><?php echo $fila['descripcion']; ?></td>
                                                        <?php 
                                                        if($fila['imagen']==""){
                                                            
                                                            ?>
                                                             <td> <img  style="width: 100px; height: 80px;" src="./img/producto.png" alt=""></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                     <td> <img  style="width: 100px; height: 80px;" src="<?php echo substr( $fila['imagen'],3) ?>" alt=""></td>
                                                            <?php
                                                        }
                                                        ?>
                                                      
                                                        <td><span class="label label-<?php echo $class; ?>"><?php echo $fila['stock']; ?>
                                                     </span> <input type="hidden" name="stock" id="stock_<?php echo $fila['id_productos']?>" value="<?php echo $fila['stock']; ?>"></td>
                                                       
                                                      
                                                        <td><input type="text" class="form-control" name="venta" id="venta_<?php echo $fila['id_productos']?>" value="<?php echo $fila['precioventa']; ?>"> </td>
                                                     
                                                  
                                                     
                                                        
                                                        <td> <button  class='btn btn-info' title='Editar Curso' onclick="agregar(<?php echo $fila['id_productos']?>)"><i class="fa fa-cart-plus"></i></button>
                                                           
                                                           
                                                       
                                                                    
                                                        </td>
							<!--<td> </td>-->
						</tr>
					<?php } ?>
				</tbody>
        
    </table>
   
      <?php ?>   
    </body>
</html>
