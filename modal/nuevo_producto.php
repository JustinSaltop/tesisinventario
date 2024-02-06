<?php
//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../conf/confconexion.php");//Contiene funcion que conecta a la base de datos

$id=$_POST['id_p'];
if($id==0){
    $titulo="Nuevo productos";
    $descripcion="";
    $codigo="";
     $compra="";
      $venta="";
       $stock="";
       $stock_mini="";
       $obsevacion="";
        $categorias="";
      
      $imagens="";
   
}
if($id>0){
   
    $titulo="Editar producto";
    $sql="select * from tb_productos where id_productos=$id";
    $result= mysqli_query($objConexion, $sql);
    if($result!=null){
        if(mysqli_num_rows($result)>0){
            $usuarioA= mysqli_fetch_array($result);
            $descripcion=$usuarioA['descripcion'];
             $codigo=$usuarioA['codigo'];
              $compra=$usuarioA['preciocompra'];
               $venta=$usuarioA['precioventa'];
                $stock=$usuarioA['stock'];
                $stock_mini=$usuarioA['stock_minimo'];
                $obsevacion=$usuarioA['observacion'];
                 $categorias=$usuarioA['id_categorias'];
               
               $imagens=$usuarioA['imagen'];
            
     
          
             
           
             
          
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
    $('#IdUsuario').val(<?php echo $id; ?>);
     $('#guardar_estudiante').bind("submit", function (){
          var data = $(this).serialize(); 
        //alert(123);
       $.ajax({
           type: 'Post',
           url:'ajax/grabar_producto.php',
           data:  new FormData(this),
            contentType: false,
                  cache: false,
            processData:false,
           success: function (data){
               $("#resultados_usuario").html(data);
               listar('ajax/listar_producto.php');
           }
       }); 
       return false;
    });
});

 inputImage = document.getElementById('input-image');

inputImage.addEventListener('change', function() {
  const file = this.files[0];
  const fileExtension = file.name.split('.').pop().toLowerCase();
  const allowedExtensions = ['png', 'jpg', 'jpeg'];
  const minWidth = 200;
  const maxWidth = 600;

  if (!allowedExtensions.includes(fileExtension)) {
  
    Swal.fire({
  icon: 'error',
  title: 'Imagen',
  text: 'Solo se permite imagen PNG ,JPG,JPEG',
  footer: ''
})
    this.value = null; // Limpia el input de archivo
  } else {
    const fileReader = new FileReader();

    fileReader.onload = function() {
      const img = new Image();
      img.onload = function() {
        if (this.width < minWidth || this.width > maxWidth) {
          
Swal.fire({
  icon: 'error',
  title: 'Imagen',
  text: 'La imagen seleccionada no cumple con los requisitos de tamaño. min 200px max 600px',
  footer: ''
})
          inputImage.value = null; // Limpia el input de archivo
        }
      };
      img.src = fileReader.result;
    };
    fileReader.readAsDataURL(file);
  }
});



</script>
<html>
<div class="modal fade bd-example-modal-lg" id="MyModal" tabindex="" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="background:<?php echo$color ?>;">
                
                <h5 class="modal-title" id="myModalLabel" ><i class='fas fa-edit'></i> <?php echo $titulo; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
           <div class="modal-body">
                <form class="form-horizontal" method="post" id="guardar_estudiante" name="guardar_estudiante" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Nombres_Apellidos" class="col-control-label font-weight-bold Negrita">Nombre</label>
                       
                        <input id="Nombres" name="descripcion_txt" class="form-control" value="<?php echo $descripcion; ?>" required placeholder="ingresa la descripcion "/>
                        </div>
                    </div>
                     <div class="col-lg-6">
                     <div class="form-group">
                        <label for="Jornada" class="col-control-label font-weight-bold Negrita">Tipo</label>
                     
                         <select class="custom-select" id="jornadas" name="categoria_txt" required>
                               <option value="">Selecionar......................</option>
                            <?php
                                $sql_jornadas="select * from tb_categorias;";
                                $result_jornadas= mysqli_query($objConexion, $sql_jornadas);
                                while($jornadasA=mysqli_fetch_array($result_jornadas)){
                                    $DescripcionJornadas=$jornadasA['descripcion'];
                                    $idJornadas=$jornadasA['id_categorias'];
                                    $seleccionaJornadas='';
                                    if($idJornadas==$categorias){
                                        $seleccionaJornadas='selected';
                                    }
                                    ?>
                                    <option value="<?php echo $idJornadas; ?>" <?php echo $seleccionaJornadas; ?>><?php echo $DescripcionJornadas; ?></option>
                                    <?php
                                }////fin del while
                            ?>
                          </select>
                        </div>
                    </div>
                    </div> 
                    <div class="row">
                   <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">stock</label>
                       
                        <input id="fecha" type="number" name="stock_txt" class="form-control" value="<?php echo $stock; ?>" required placeholder="ingresa la cantidad" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">stock minimo</label>
                       
                        <input id="fecha" type="number" name="stock_mini_txt" class="form-control" value="<?php echo $stock_mini; ?>" required placeholder="ingresa la cantidad" />
                        </div>
                    </div>
                     <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">Costo</label>
                       
                        <input id="fecha" type="text" name="compra_txt" class="form-control" value="<?php echo $compra; ?>" required placeholder="precio de compra"/>
                        </div>
                    </div>
                        </div>
                    <div class="row">
                     <div class="col-lg-6">
                    <div class="form-group">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">precio venta</label>
                       
                        <input id="fecha" type="text" name="venta_txt" class="form-control" value="<?php echo $venta; ?>" required placeholder="precio de venta " />
                        </div>
                    </div>
                     <div class="col-lg-6">
                    <div class="form-group">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">Codigo</label>
                       
                        <input id="fecha" type="text" name="codigo_txt" class="form-control" value="<?php echo $codigo; ?>" required placeholder="codigo " />
                        </div>
                    </div>
                        </div>
                  
     <?php
                        if($id>0){
                        if($imagens==""){
                            
                            ?>
                             <div class="text-center col-lg-4">
                            
                            <img  style="width: 200px; height: 150px;" src="./img/producto.png" alt="">
                          <br>
                        <!-- <p> Foto de paciente</p> -->
                        </div>
                            <?php
                        }else{

                            ?>
                            <div class="text-center col-lg-4">
                            
                            <img  style="width: 200px; height: 150px;" src="<?php echo substr( $imagens,3) ?>" alt="">
                          <br>
                        <!-- <p> Foto de paciente</p> -->
                        </div>
                            <?php 
                        }
                    
                        ?>
                        
                        <?php 
                             }?>
                             <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">Imagen(PNG,JPG,JPEG)</label>
                       
                        <input id="input-image" type="file" name="Imagen" class="form-control"   />
                        </div>

                        <div class="form-group col-lg-6">
                        <label for="fecha" class="col-control-label font-weight-bold Negrita">Observacion</label>
                       
                       <textarea name="descrip_txt" id="" cols="" rows="" class="form-control" placeholder="ingrese una descripcion"><?php echo $obsevacion ?></textarea>
                        </div>
                        </div>
                   
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardar_estudiante"><i class="fas fa-save"></i> Guardar Producto</button>
            </div>
                     <div id="resultados_usuario"></div>
                     <input id="IdUsuario" name="IdUsuario" type="hidden">
                </form>
            </div>
            
        </div>
    </div>
</div>
</html>


