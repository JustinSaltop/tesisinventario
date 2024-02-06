<?php

require '../conf/confconexion.php';

$id_p=$_POST['id_p'];
$mensaje=$_POST['mensaje'];


if($mensaje=='eliminar'){
        $sql="delete from compra where numero_factura=$id_p";
        $sql1="delete from detalle_compra where numero_factura=$id_p";
    }

//ejecuto
$result=mysqli_query($objConexion,$sql);
$result1=mysqli_query($objConexion,$sql1);
if($result && $result1){
    if($mensaje=='eliminar'){
       ?> 
<script>
 toastr.success('SE ELIMINADO CORRECTAMENTE.');
</script>
<?php
//        echo "<div class='alert alert-success' rol='alert'>Registro Eliminado Correctamente</div>";
   
}
else{
    echo "<div class='alert alert-danger' rol='alert'>Ocurrió un problema al momento de guardar. Favor intentar de nuevo</div>". mysqli_error();
}
}