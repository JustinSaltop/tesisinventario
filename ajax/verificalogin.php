<?php
// conexion SERVIDOR - BD
require_once '../conf/confconexion.php';
if($estadoconexion==0){
   
    echo "<div class='alert alert-danger' role='alert'>No se pudo conectar al servidor, favor comunicar a TICS</div>";
    exit();
}
// recibo usuario y clave
$usuario=$_POST['usuario_p'];
$clave=$_POST['clave_p'];
$pass= md5($clave);
$query="select * from tb_usuario where usuario ='$usuario' and estado=0";
$resuk=mysqli_query($objConexion,$query);
$estado=mysqli_num_rows($resuk);

if($estado==1){
    ?>
<script>

$(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Inactivo',
        subtitle: 'Inactivo',
        body: 'Su Cuenta esta inactiva actualmente ,comunicarse con el admin.'
      })
</script>
    <?php
}else{



    $sql = "SELECT * FROM tb_usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($objConexion, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
    
        // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
        if (password_verify($clave, $fila['clave'])) {
            session_start();
      $_SESSION['idusuario_S']= $fila['id_usuario'];
    $_SESSION['nombreUsuario_S']= $fila['nombre'];
    $_SESSION['idRolUsuario_S']= $fila['id_tipo_usuario'];
    $_SESSION['cedulasuserio_s']= $fila['usuario'];
     $_SESSION['correousuario']= $fila['correo'];
            echo "1"; // Usuario logueado correctamente
        } else {
           ?>
           <script>
        $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Error',
        subtitle: 'Error',
        body: 'Contraseña Incorrecta. Favor Intete de Nuevo.'
      })
  
</script>
           <?php 
        }
    } else {
        ?>
        <script>

$(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Error',
        subtitle: 'Error',
        body: 'Usuario Incorrecta. Favor Intete de Nuevo.'
      })
</script>
        <?php 

       
    }

}
?>


   
    
 
     
   
   
  