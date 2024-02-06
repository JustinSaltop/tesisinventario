<?php
require './conf/confconexion.php';
$moest=mysqli_query($objConexion,"select * from tb_configuracion");
$nombre = mysqli_fetch_array($moest);