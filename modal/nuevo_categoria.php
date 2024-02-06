<?php
//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../conf/confconexion.php");//Contiene funcion que conecta a la base de datos
session_start();
  $cedulaUsuar= $_SESSION['cedulasuserio_s'];
      $idrolUsuario=$_SESSION['idRolUsuario_S'];

$id=$_POST['id_p'];
if($id==0){
    $titulo="Registrar categoria";
    
    $Descripcion="";
    
    $seleccionaI="";
    $seleccionaA="";
}
if($id>0){
    
    $titulo="Editar categoria";
    $sql="select * from tb_categorias where id_categorias=$id";
    $result= mysqli_query($objConexion, $sql);
    if($result!=null){
        if(mysqli_num_rows($result)>0){
            $usuarioA= mysqli_fetch_array($result);
         
            $Descripcion=$usuarioA['descripcion'];
           
             
           
                 $Estado=$usuarioA['estado'];
                 if($Estado=='1'){
                     $seleccionaA="selected";
                    $seleccionaI="";
                 }
                   elseif($Estado=='0'){
                     $seleccionaI="selected";
                     $seleccionaA="";
                 }else{
                       $seleccionaF="selected";
                 }
          
         
        }else{
            echo "No se encontró registro con el código: ".$id;
            exit();
        }
    }else{
        echo "Ocurrió un problema al momento de ejecutar la consulta".mysqli_error_list($objConexion);
        exit();
    }
}
?>

<script>
$(document).ready(function(){
    // capturar el valor del id que se recibe
    $('#Idcategorias').val(<?php echo $id; ?>);
     $('#guardar_estudiante').bind("submit", function (){
        //alert(123);
       $.ajax({
           type: $(this).attr("method"),
           url:'ajax/grabar_categoria.php',
           data:$(this).serialize(),
           success: function (data){
               $("#resultados_usuario").html(data);
              listar('ajax/listar_categoria.php');
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
            <div class="modal-header"  style="background:<?php echo$color ?>;">
                <strong><h5 class="modal-title" id="myModalLabel" ><i class='fas fa-edit'></i> <?php echo $titulo; ?></h5></strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
           <div class="modal-body">
                <form  class="form-horizontal" method="post" id="guardar_estudiante" name="guardar_estudiante">
                   
                      <div class="col-lg-12">
                    <div class="form-group">
                    <label for="estado" class="col-control-label font-weight-bold Negrita">Descripcion:</label>
                    <input type="text" name="descripcion_txt" class="form-control" id="" value="<?php echo $Descripcion ?>" placeholder="ingrese la deacripcion " required>
                         </div>
                     
                      
                   
                  
                    
                     <div class="col-lg-12">
                     <div class="form-group">
                        <label for="estado" class="col-control-label font-weight-bold Negrita">Estado:</label>
                       
                         <select class="custom-select" id="estado" name="Estado_txt" required>
                           
                             <option value="1" <?php echo $seleccionaA; ?>>Activo</option>
                             <option value="0" <?php echo $seleccionaI; ?>>Inactivo</option>
                          
                          </select>
                        </div>
                    </div>
                    </div>
                    <?php 
//                    if($idrolUsuario==1){
//                        $etiqye='';
//                    } else {
//                        $etiqye='disabled';
//                    }
                    ?>
                   
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardar_estudiante"><i class="fas fa-save"></i> guardar Categoria</button>
            </div>
                     <div id="resultados_usuario"></div>
                     <input id="Idcategorias" name="Idcategorias" type="hidden">
                </form>
            </div>
            
        </div>
    </div>
</div>
</html>


