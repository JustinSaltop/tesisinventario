<?php

require '../conf/confconexion.php';

$id_p=$_POST['id_p'];
$mensaje=$_POST['mensaje'];


if($mensaje=='eliminar'){
        $sql="delete from ventas where numero_factura=$id_p";
        $sql1="delete from detalle_venta where numero_factura=$id_p";
    }

//ejecuto
$result=mysqli_query($objConexion,$sql);
$result1=mysqli_query($objConexion,$sql1);
if($result && $result1){
    if($mensaje=='eliminar'){
       ?> 
<script>
Swal.fire(
      'Eliminado!',
      'eliminado existosamente .',
      'success'
    )
</script>
<?php
//        echo "<div class='alert alert-success' rol='alert'>Registro Eliminado Correctamente</div>";
   
}
else{
    echo "<div class='alert alert-danger' rol='alert'>Ocurrió un problema al momento de guardar. Favor intentar de nuevo</div>". mysqli_error();
}
}