<?php
require_once '../conf/confconexion.php';//conexion a la base de datos
if($estadoconexion==0){
    echo "<div class='alert alert-danger' role='alert'>No se pudo conectar al servidor, favor comunicar a TICS</div>";
    exit();
}
$fechaAactual=date('Y-m-d');
session_start();
   $cedulaUsuar= $_SESSION['cedulasuserio_s'];
      $idrolUsuario=$_SESSION['idRolUsuario_S'];
    // $sql = "SELECT * FROM tb_estudiantes where cedula=$cedulaUsuar;"; 
    // $result = mysqli_query($objConexion, $sql);
    // if($idrolUsuario==2){
    // while ($rowx = mysqli_fetch_array($result)) {
    //     $id_asitencia=$rowx['id_estudiantes'];
    // }
    // }


   $sql = "SELECT * FROM tb_categorias ORDER BY id_categorias desc;";
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
        <div class="">
         <!--<div class="col-lg-12">-->
                    <div class="col-12">  
        
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
               <th>Descripcion</th>
                <th>Estado</th>
                
                  
                      
                 
                       <th>Opciones</th>
                
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        
        
        <tfoot>
            <tr>
               <th>ID</th>
               <th>Descripcion</th>
                <th>Estado</th>
               
                  
                      
                 
                       <th>Opciones</th>
            </tr>
        </tfoot>
        
         <tbody>
					<?php  while ($fila = mysqli_fetch_array($result)) { 
                                            
                       
                                            if($fila['estado'] == '1'){
                                                $estado = "ACTIVO";
                                                   $class = ' badge badge-success';
                                           }elseif ($fila['estado'] == '0') {
       
   
                                                   $estado = "INACTIVO";
                                                     $class = " badge badge-warning";    
                                                   }
                                                    
                                            
                                            ?>
                                         
						<tr>
                                                    <td><?php echo $fila['id_categorias']; ?></td>
                                                  
                                                        
                                              
                                                     
                                                                
                                                                 
                                                                    
                                                         <td><?php echo $fila['descripcion']; ?></td>
                                                      
                                                     
                                                        
                                                       
							<td><span class="label label-<?php echo $class; ?>"><?php echo $estado?></span></td>
                                                        <td>
                                     
                                                            <?php 
                                                             
                                                            if($idrolUsuario==1){
                                                                
                                                         
                                                            ?>
                                                             <button  class='btn btn-info' title='Editar Asistencia' onclick="editarCategoria(<?php echo $fila['id_categorias']?>)"><i class="fas  fa-edit"></i> </button>
                                                            <button  class='btn btn-danger' title='Eliminar Asistencia' onclick="eliminarCategoria(<?php echo $fila['id_categorias']?>)"><i class="fas fa fa-solid fa-trash"></i></button>
                                                       
                                                        
                                             <?php
                                                        
                                                    }
                                                        ?>

<?php 
                                                        if($idrolUsuario==2){
                                             
                                             
                                             ?>
                                              <button  class='btn btn-info' title='Editar Asistencia' onclick="editarCategoria(<?php echo $fila['id_categorias']?>)"><i class="fas  fa-edit"></i> </button>
                                              <?php 
                                                        }
                                              ?>
                                                        </td>
							<!--<td> </td>-->
						</tr>
					 <?php 
                                           
                                                            }
                                         ?> 
				</tbody>
        
    </table>
                
         </div>
        </div>
        <!--</div>-->        
    </body>
</html>



