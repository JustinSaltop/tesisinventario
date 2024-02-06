<?php

require '../conf/confconexion.php';
$id = isset($_POST['IdUsuario']) ? $_POST['IdUsuario'] : null;
$id_p = isset($_POST['id_p']) ? $_POST['id_p'] : null;
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
$NombresApellidos = isset($_POST['nombre_txt']) ? $_POST['nombre_txt'] : null;
$ruc = isset($_POST['Ruc_txt']) ? $_POST['Ruc_txt'] : null;
$Telefono = isset($_POST['Telefono_txt']) ? $_POST['Telefono_txt'] : null;
$Correo = isset($_POST['Correo_txt']) ? $_POST['Correo_txt'] : null;
$descripcion = isset($_POST['descripcion_txt']) ? $_POST['descripcion_txt'] : null;
$Direccion = isset($_POST['Direccion_txt']) ? $_POST['Direccion_txt'] : null;
$Fecha_registro = date('Y-m-d');
$Estado = isset($_POST['Estado_txt']) ? $_POST['Estado_txt'] : null;


if($id==0){
$sqles="SELECT * FROM tb_proveedor where ruc ='$ruc' limit 1";
$res=mysqli_query($objConexion,$sqles);
if(mysqli_num_rows($res)>0){
    echo "<div class='alert alert-danger' rol='alert'>El provvedor ya esta registrado</div>";
    return;
}else{


//insert
if($id==0){
   
    
    $sql="insert into tb_proveedor(nombre,ruc,descripcion,telefono,correo,direccion,fecha_registro,estado) values('$NombresApellidos','$ruc','$descripcion','$Telefono','$Correo','$Direccion','$Fecha_registro','$Estado');";
}
}
}
if($mensaje=='eliminar'){
        $sql="delete from tb_proveedor where id_proveedor=$id_p";
    }else{
    if($id>0){
        $sql="update tb_proveedor set nombre='$NombresApellidos', ruc='$ruc',descripcion='$descripcion',correo='$Correo',telefono='$Telefono',direccion='$Direccion',fecha_registro='$Fecha_registro',estado='$Estado' where id_proveedor=$id";
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
