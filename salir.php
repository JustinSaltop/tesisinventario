
<?php
//validación de que la sesión esté activa
if(session_id()==''){
    session_start();
}
//limpiamos el array de la variable de ssesion. 
$_SESSION = array();
// permite destruir la sesión activa
session_destroy();
//localización href. Presentamos uuna nueva página
header('Location: login.php');

