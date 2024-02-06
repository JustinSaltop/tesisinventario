<?php

require '../conf/confconexion.php';
$id = isset($_POST['Idcategorias']) ? $_POST['Idcategorias'] : null;
$id_hora = isset($_POST['hora_txt']) ? $_POST['hora_txt'] : null;
$id_p = isset($_POST['id_p']) ? $_POST['id_p'] : null;
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
$descrip = isset($_POST['descripcion_txt']) ? $_POST['descripcion_txt'] : null;
$estado = isset($_POST['Estado_txt']) ? $_POST['Estado_txt'] : 1;

  


//insert
if($id==0){
  $sql="insert into tb_categorias(descripcion,estado) values('$descrip','$estado');";
}
if($mensaje=='eliminar'){
      $sql="delete from tb_categorias where id_categorias=$id_p";
  }else{
  if($id>0){
      $sql="update tb_categorias set descripcion='$descrip',estado='$estado' where id_categorias=$id";
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
