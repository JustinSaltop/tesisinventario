<?php
//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../conf/confconexion.php");//Contiene funcion que conecta a la base de datos
session_start();
$idrolUsuario=$_SESSION['idRolUsuario_S'];
$id=$_POST['id_p'];
if($id==0){
    $titulo="Agregar producto";
    $color='#63baf1';
}
?>
<script>


$(document).ready(function(){
  $('#loading').show(); // muestra el GIF de carga
  $.ajax({
    url:'ajax/agregar_producto.php',
    beforeSend: function() {
      $('#loading').show(); // muestra el GIF de carga antes de la petición AJAX
    },
    success: function(data) {
      $('#loading').hide(); // oculta el GIF de carga después de que la petición AJAX se completa
      // maneja la respuesta de AJAX
 $('#outer_div').html(data);
    }
  });
});


</script>

<html>
<div class="modal fade  bd-example-modal-lg" id="MyModal" tabindex="" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:<?php echo$color ?>;">
                <h5 class="modal-title" id="myModalLabel" style="color:#fff"><i class='fas fa-edit'></i> <?php echo $titulo; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
           <div class="modal-body">
         <div class="table-responsive">
             <div id="loading" class="text-center">
  <img src="img/loading.gif" alt="Cargando...">
</div>
         <div class="outer_div" id="outer_div" ></div>
         </div>
            </div>
            
        </div>
    </div>
</div>
</html>
<!-- <script src="./js/letras.js"></script> -->