<?php

require '../conf/confconexion.php';
$id=$_POST['IdUsuario'];

$Clavea=$_POST['Clave_txt'];

$passwor= password_hash($Clavea, PASSWORD_DEFAULT);

if($id>0){
$sql="update tb_usuario set  clave='$passwor' where id_usuario=$id";
}
//ejecuto
$result=mysqli_query($objConexion,$sql);

if($result){
    ?>
<script>
Swal.fire(
      'Clave!',
      'cambiada existosamente .',
      'success'
    )
</script>  
<?php
//        echo "<div class='alert alert-success' rol='alert'>Clave Cambiada  Correctamente</div>";
    }

else{
    echo "<div class='alert alert-danger' rol='alert'>Ocurrió un problema al momento de guardar. Favor intentar de nuevo</div>". mysqli_error();
}
