<?php 
include "ajax/actualizar_empresa.php";
$feha= date('Y');
?>
<footer class="main-footer">
    <strong>Copyright &copy;   <?php echo $feha." ".$nombre['nombre'] ?> </strong>
    
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
  <script>
document.addEventListener("DOMContentLoaded", function() {
    // Obtener la URL actual
    var currentURL = window.location.href;
    
    // Verificar si la URL contiene "index.php" (o la URL de la página actual)
    if (currentURL.includes("index.php")) {
        // Agregar la clase "active" al enlace correspondiente
        document.getElementById("dashboard-link").classList.add("active");
    } else if (currentURL.includes("usuario.php")) {
        // Agregar la clase "active" al enlace correspondiente
        document.getElementById("link_2").classList.add("active");
    } else if (currentURL.includes("proveedor.php") || currentURL.includes("clientes.php") ) {
        // Agregar la clase "active" al enlace correspondiente
        document.getElementById("link_3").classList.add("active");
    }else if(currentURL.includes("producto.php") || currentURL.includes("category.php")){
      document.getElementById("link_4").classList.add("active");

    }else if (currentURL.includes("compra.php")){
      document.getElementById("link_5").classList.add("active");
    }else if (currentURL.includes("venta.php")){
      document.getElementById("link_6").classList.add("active");
    }else if(currentURL.includes("ventas_detalle.php")){
      document.getElementById("link_7").classList.add("active");
    }else if(currentURL.includes("datos_inventario.php")){
      document.getElementById("link_9").classList.add("active");
    }
    // Agrega más condicionales para otras páginas si es necesario
});
</script>
