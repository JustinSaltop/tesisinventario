<?php

require '../conf/confconexion.php';
$id = isset($_POST['IdUsuario']) ? $_POST['IdUsuario'] : null;
$id_p = isset($_POST['id_p']) ? $_POST['id_p'] : null;
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
$desci = isset($_POST['descripcion_txt']) ? $_POST['descripcion_txt'] : null;
$categori = isset($_POST['categoria_txt']) ? $_POST['categoria_txt'] : null;
$stock = isset($_POST['stock_txt']) ? $_POST['stock_txt'] : null;
$observacion = isset($_POST['descrip_txt']) ? $_POST['descrip_txt'] : null;
$compra = isset($_POST['compra_txt']) ? $_POST['compra_txt'] : null;
$venta = isset($_POST['venta_txt']) ? $_POST['venta_txt'] : null;
$stock_mini = isset($_POST['stock_mini_txt']) ? $_POST['stock_mini_txt'] : null;
$codido = isset($_POST['codigo_txt']) ? $_POST['codigo_txt'] : null;
$fecha = date('Y-m-d h:i:s');

$imagen1 = isset($_FILES['Imagen']['name']) ? $_FILES['Imagen']['name'] : null;
$ruta = isset($_FILES['Imagen']['tmp_name']) ? $_FILES['Imagen']['tmp_name'] : null;
$imagen = isset($_FILES['Imagen']['size']) ? $_FILES['Imagen']['size'] : null;

if($imagen>1048576){
   echo "<div class='alert alert-danger' rol='alert'>la imagen  es muy grande debe ser menor o igual a 1M </div>"; 
}else{
    if(!empty($_FILES['Imagen']['tmp_name']) 
     && file_exists($_FILES['Imagen']['tmp_name'])) {
        $destino='../img/'.$imagen1;
     
      
        copy($ruta, $destino);
}
//insert
if($id==0){
    $sql="insert into tb_productos(codigo,descripcion,imagen,stock,preciocompra,precioventa,id_categorias,fecha_registro,stock_minimo,observacion) values('$codido','$desci','$destino','$stock','$compra','$venta','$categori','$fecha','$stock_mini','$observacion');";
}
if($mensaje=='eliminar'){
        $sql="delete from tb_productos where id_productos=$id_p";
    }else{
    if($id>0){
        if($imagen1==''){

        
        $sql="update tb_productos set descripcion='$desci', id_categorias='$categori',stock_minimo='$stock_mini',observacion='$observacion', preciocompra='$compra',precioventa='$venta',stock='$stock',codigo='$codido' where id_productos=$id";
    }else{
        $sql="update tb_productos set descripcion='$desci', id_categorias='$categori', stock_minimo='$stock_mini',observacion='$observacion',preciocompra='$compra',precioventa='$venta',stock='$stock',codigo='$codido', imagen='$destino' where id_productos=$id";
    }
}
}
//ejecuto
$result=mysqli_query($objConexion,$sql);

if($result){
    if($mensaje=='eliminar'){
       ?> 
<script>
 toastr.success('SE ELIMINADO CORRECTAMENTE.');
</script>
<?php
//        echo "<div class='alert alert-success' rol='alert'>Registro Eliminado Correctamente</div>";
    }else{
        
       ?>
<script>

 toastr.success('SE REGISTRO EXITOSAMNENTE.')
</script>
<?php
//        echo "<div class='alert alert-success' rol='alert'>Registro Guardado Correctamente</div>";
    }
}
else{
    echo "<div class='alert alert-danger' rol='alert'>Ocurrió un problema al momento de guardar. Favor intentar de nuevo</div>". mysqli_error($objConexion);
}
}