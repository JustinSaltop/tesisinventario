<?php
//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../conf/confconexion.php");//Contiene funcion que conecta a la base de datos

$id=$_POST['id_p'];

if($id>0){
    $titulo="Cambiar Clave";
     
        }else{
            echo "No se encontró registro con el código: ".$id;
            exit();
        
    
}
?>
<script>
$(document).ready(function(){
    // capturar el valor del id que se recibe
    $('#IdUsuario').val(<?php echo $id; ?>);
     $('#guardar_usuario').bind("submit", function (){
        //alert(123);
       $.ajax({
           type: $(this).attr("method"),
           url:'ajax/editar_clave.php',
           data:$(this).serialize(),
           success: function (data){
               $("#resultados_usuario").html(data);
               listar('ajax/listar_usuario.php');
           }
       }); 
       return false;
    });
});


</script>
<html>
<div class="modal fade" id="MyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:<?php echo$color ?>;">
                
            <h5 class="modal-title" id="myModalLabel" ><i class='fas fa-edit'></i> <?php echo $titulo; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
           <div class="modal-body">
                <form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
                   
                   
                 
                     <div class="form-group">
                        <label for="Edad" class="col-control-label font-weight-bold Negrita">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" id="txtPassword" name="Clave_txt" class="form-control" value="<?php echo $clave; ?>" placeholder="ingrese la Contraseña"
                                   required="">
                              
                            </div>
                        <!-- <input id="EdadId" type="password" name="Clave_txt" class="form-control" value="<?php echo $clave; ?>" required placeholder="ingrese una nueva clave"/> -->
                      
                    </div>
                
                    
                    
                 
                   
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardar_datos"><i class="fas fa-save"></i> Cambiar clave</button>
            </div>
                     <div id="resultados_usuario"></div>
                     <input id="IdUsuario" name="IdUsuario" type="hidden">
                </form>
            </div>
            
        </div>
    </div>
</div>
</html>

