<?php
require '../conf/confconexion.php';
session_start();
  $session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
if (isset($_POST['iva'])){$iva=$_POST['iva'];}


	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
$insert_tmp=mysqli_query($objConexion, "INSERT INTO tmp_compra(id_productos,cantidad_tmp,precio_tmp,id_session) VALUES ('$id','$cantidad','$precio_venta','$session_id')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($objConexion, "DELETE FROM tmp_compra WHERE id_tmp='".$id_tmp."'");
}

?>
<table class="table table-striped table-bordered">
<tr>
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
  
	$sumador_total=0;
	$sql=mysqli_query($objConexion, "select * from tb_productos, tmp_compra where tb_productos.id_productos=tmp_compra.id_productos and tmp_compra.id_session='$session_id'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['descripcion'];
	
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" class="btn btn-danger" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="fas fa-trash"></i></a></td>
		</tr>		
		<?php
	}
	$iva=0;
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * $iva)/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;

?>
<tr>
	<td class='text-right' colspan=4>SUBTOTAL $</td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>
<tr>
	<td class='text-right' colspan=4>IVA (<?php echo $iva?>)% $</td>
	<td class='text-right'><?php echo number_format($total_iva,2);?></td>
	<td></td>
</tr>
<tr>
	<td class='text-right' colspan=4>TOTAL $</td>
	<td class='text-right'><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>

</table>
