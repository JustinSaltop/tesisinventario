<?php
// connect to database
require '../conf/confconexion.php';
$search = strip_tags(trim($_GET['q'])); 
// Do Prepared Query
$query = mysqli_query($objConexion, "SELECT * FROM tb_proveedor WHERE nombre LIKE '%$search%' LIMIT 40");
// Do a quick fetchall on the results
$list = array();
while ($list=mysqli_fetch_array($query)){
	$data[] = array('id' => $list['id_proveedor'], 'text' => $list['nombre']);
}
// return the result in json
echo json_encode($data);
?>