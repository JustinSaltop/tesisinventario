<?php

require_once 'conexion.php';
$objConexion= mysqli_connect(SERVIDOR, USUARIO, CLAVE,BASEDATOS, PUERTO);

if($objConexion){
    $estadoconexion=1;
}else{
//    echo ("fallo la conexion"). mysqli_error();
    $estadoconexion=0;
}
