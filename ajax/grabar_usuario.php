<?php

require '../conf/confconexion.php';
$id = isset($_POST['IdUsuario']) ? $_POST['IdUsuario'] : null;
$id_p = isset($_POST['id_p']) ? $_POST['id_p'] : null;
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
$NombresApellidos = isset($_POST['Nombres_txt']) ? $_POST['Nombres_txt'] : null;
$cedula = isset($_POST['cedula_txt']) ? $_POST['cedula_txt'] : null;
$Correoa = isset($_POST['Correo_txt']) ? $_POST['Correo_txt'] : null;
$Clavea = isset($_POST['Clave_txt']) ? $_POST['Clave_txt'] : null;
$passs = isset($Clavea) ? password_hash($Clavea, PASSWORD_DEFAULT) : null;
$estado = isset($_POST['estado_txt']) ? $_POST['estado_txt'] : 1;
$tipo = isset($_POST['tipo_txt']) ? $_POST['tipo_txt'] : null;


$fechaRegistro=date('Y-m-d');

//insert
if($id==0){
    $sql="insert into tb_usuario(nombre,usuario,correo,clave,fecha,id_tipo_usuario,estado) values('$NombresApellidos','$cedula','$Correoa','$passs','$fechaRegistro','$tipo','$estado');";
}
if($mensaje=='eliminar'){
        $sql="delete from tb_usuario where id_usuario=$id_p";
    }else{
    if($id>0){
        $sql="update tb_usuario set nombre='$NombresApellidos',usuario='$cedula', correo='$Correoa', id_tipo_usuario='$tipo',estado='$estado' where id_usuario=$id";
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
