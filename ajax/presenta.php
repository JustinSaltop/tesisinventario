<?php
require_once './conf/confconexion.php';
$sql= mysqli_query($objConexion,"SELECT COUNT(*) cantidad FROM tb_productos;");
$productos=mysqli_fetch_array($sql);

$sqli= mysqli_query($objConexion,"SELECT COUNT(*) cantidad FROM tb_usuario;");
$usuario=mysqli_fetch_array($sqli);

$fecha_actual= date('Y-m-d');
$sqlil= mysqli_query($objConexion,"SELECT ROUND(SUM(total_venta), 3) AS venta FROM ventas WHERE  DATE(fecha_factura)='$fecha_actual';");
$ventas=mysqli_fetch_array($sqlil);

$comp= mysqli_query($objConexion,"SELECT ROUND(SUM(total_compra), 3) AS compras FROM compra WHERE DATE(fecha_factura)='$fecha_actual';");
$compra=mysqli_fetch_array($comp);


$consulta= mysqli_query($objConexion,"SELECT descripcion,stock FROM tb_productos WHERE stock <=10;");


foreach ($consulta as $data){
     $stock []= $data['stock'];
    $nombr[]=$data['descripcion'];
} 