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
             if($idrolUsuario==1 ||$idrolUsuario==2){
         ?>
     
     <div class="col-12">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">       
        

        <thead>
            <tr>
               
            <th>ID</th>
            <th>Codigo</th>
                <th>Nombre</th>
              
                  <th>Stock</th>
                   <th>Stock minimo</th>
                   <th>Costo</th>
                
                    <th>precio venta</th>
                     <th>Categoria</th>
                     <th>Imagen</th>
                      <th>fecha</th>
                   
                       <th>Opciones</th>
                
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        
        
        <tfoot>
            <tr>
              
            <th>ID</th>
            <th>Codigo</th>
                <th>Nombre</th>
               
                  <th>Stock</th>
                   <th>Stock minimo</th>
                   <th>Costo</th>
                    <th>precio venta</th>
                     <th>Categoria</th>
                     <th>Imagen</th>
                      <th>fecha</th>
                   
                       <th>Opciones</th>
                
            </tr>
        </tfoot>
        
         <tbody>
					<?php while($fila = mysqli_fetch_array($result)) { 
                                            
                                                                 
                                        if($fila['stock']>=20){
                                            
                                               $class = ' badge badge-success';
                                       }elseif ($fila['stock']<=10) {
   

                                              
                                                 $class = " badge badge-danger";    
                                               }   else{
                                                $class = " badge badge-warning"; 
                                               }    
                                            
                                            
                                            ?>
                                                       
						<tr>
							
							<td><?php echo $fila['id_productos']; ?></td>
                            <td><?php echo $fila['codigo']; ?></td>
                                                        <td><?php echo $fila['descripcion']; ?></td>
                                                    
                                                        
                                                      
                                                        <td><span class="label label-<?php echo $class; ?>"><?php echo $fila['stock']; ?></span></td>
                                                       <td><?php echo $fila['stock_minimo']?></td>
                                                        <td><?php echo $fila['preciocompra']; ?></td>

                                                        <td><?php echo $fila['precioventa']; ?></td>
                                                     
                                                        <?php 
                                                        $idjornada=$fila['id_categorias'];
                                                        $sql_jornada="select * from tb_categorias where id_categorias=$idjornada";
                                                        $resulta= mysqli_query($objConexion, $sql_jornada);
                                                        $jornadd= mysqli_fetch_array($resulta);
                                                        $nombrejornada=$jornadd['descripcion'];
                                                        ?>
                                                        <td><?php echo   $nombrejornada; ?></td>
                                                        <?php 
                                                        if($fila['imagen']==""){
                                                            
                                                            ?>
                                                             <td> <img  style="width: 100px; height: 80px;" src="./img/producto.png" alt=""></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                     <td> <img  style="width: 100px; height: 80px;" src="<?php echo substr( $fila['imagen'],3) ?>" class="img-circule" alt=""></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        <td><?php echo $fila['fecha_registro']; ?></td>
                                                        
                                                        <td> <button  class='btn btn-info' title='Editar Curso' onclick="editarPro(<?php echo $fila['id_productos']?>)"><i class="fas fa-edit"></i></button>
                                                           
                                                        <?php if($idrolUsuario==1){

                                                        ?>
                                                            <button  class='btn btn-danger' title='Eliminar curso' onclick="eliminarPro(<?php echo $fila['id_productos']?>)"><i class="fas fa fa-solid fa-trash"></i></button>
                                                       <?php  
                                                        }
                                                       ?>
                                                                    
                                                        </td>
							<!--<td> </td>-->
						</tr>
					<?php } ?>
				</tbody>
        
    </table>
    </div>
      <?php }?>   
    </body>
</html>




