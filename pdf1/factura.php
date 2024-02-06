<?php

	# Incluyendo librerias necesarias #
	require "./code128.php";
	include("../conf/confconexion.php");
	$sql_count=mysqli_query($objConexion,"select * from tmp_compra ");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la factura')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$id_proveedor=intval($_GET['id_proveedor']);
	$id_usuario=intval($_GET['id_usuario']);
	$iva=mysqli_real_escape_string($objConexion,(strip_tags($_REQUEST['iva'], ENT_QUOTES)));

	//Fin de variables por GET
	$sql=mysqli_query($objConexion, "select LAST_INSERT_ID(numero_factura) as last from compra order by id_compra desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero_factura=$rw['last']+1;	

	$codigo_venta="CODCOP".$numero_factura;
	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$query = mysqli_query($objConexion,"select * from tb_configuracion");
	$datos =mysqli_fetch_array($query);
	$logo =$datos['logo'];
	$pdf->Image('../img/'.$logo,147,20,55,30,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(70,10,utf8_decode(strtoupper($datos['nombre'])),1,0,'L');

	$pdf->Ln(9);
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(70,9,utf8_decode("RUC: 0000000000"),'L',0,'L');
   $pdf->Cell(0.1, 9, '', 'R');
	$pdf->Ln(5);

	$pdf->Cell(70,9,utf8_decode("Direccion:".$datos['direccion']),'L',0,'L');
     $pdf->Cell(0.1, 9, '', 'R');
	$pdf->Ln(5);

	$pdf->Cell(70,9,utf8_decode("Teléfono:".$datos['telefono']),'L',0,'L');

	$pdf->Ln(5);

	$pdf->Cell(70,9,utf8_decode("Email:".$datos['correo']),'L',0,'L');
        $pdf->Cell(0.1, 9, '', 'R');
       $pdf->Ln(9);
	$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 70, $pdf->GetY());

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,utf8_decode("Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,utf8_decode(date("d/m/Y", strtotime(date('d-m-Y')))." ".date("h:s A")),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,utf8_decode(strtoupper("Orden Nro.")),1,0,'C');

	$pdf->Ln(7);
	$sql_user=mysqli_query($objConexion,"select * from tb_usuario where id_usuario='$id_usuario'");
	$rw_user=mysqli_fetch_array($sql_user);
	 $rw_user['nombre'];
	 $pdf->SetFont('Arial','',10);
	 $pdf->Cell(18,7,utf8_decode("Usuario :"),0,0,'L');
	 $pdf->SetTextColor(97,97,97);
	 $pdf->Cell(128,7,utf8_decode($rw_user['nombre']),0,0,'L');
	 $pdf->SetFont('Arial','B',10);
	 $pdf->SetTextColor(97,97,97);
	 $pdf->Cell(35,7,utf8_decode(strtoupper($numero_factura)),1,0,'C');
 
	$pdf->Ln(10);
	
	
	 $sql_cliente=mysqli_query($objConexion,"select * from tb_proveedor where id_proveedor='$id_proveedor'");
	$rw_cliente=mysqli_fetch_array($sql_cliente);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(20,7,utf8_decode("Prove:"),1,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode($rw_cliente['nombre']),1,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(20,7,utf8_decode("Doc: "),1,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(40,7,utf8_decode("Ruc:".$rw_cliente['ruc']),1,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(10,7,utf8_decode("Tel:"),1,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(30,7,utf8_decode($rw_cliente['telefono']),1,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(20,7,utf8_decode("Dir:"),1,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode($rw_cliente['direccion']),1,0);
	$pdf->SetTextColor(39,39,51);

	// $pdf->Cell(30,7,utf8_decode("Forma de pago: "),0,0,'L');
	// $pdf->SetTextColor(97,97,97);
	// $pdf->Cell(40,7,utf8_decode($estdo),0,0,'L');
	// $pdf->SetTextColor(39,39,51);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',9);
	$pdf->SetFillColor(0,0,0);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(90,8,utf8_decode("Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,utf8_decode("Cant."),1,0,'C',true);
	$pdf->Cell(35,8,utf8_decode("Precio"),1,0,'C',true);
	// $pdf->Cell(19,8,utf8_decode("Desc."),1,0,'C',true);
	$pdf->Cell(41,8,utf8_decode("Subtotal"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(49,39,51);

	session_start();
	$session_id=session_id();
	$nums=1;
	$sumador_total=0;
	$sql=mysqli_query($objConexion, "select * from tb_productos, tmp_compra where tb_productos.id_productos=tmp_compra.id_productos and tmp_compra.id_session='$session_id'");
	while ($row=mysqli_fetch_array($sql))
		{
		$id_tmp=$row["id_tmp"];
		$id_producto=$row["id_productos"];
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
	
	
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Cell(90,7,utf8_decode($nombre_producto),1,0,'C');
	$pdf->Cell(15,7,utf8_decode($cantidad),1,0,'C');
	$pdf->Cell(35,7,utf8_decode("$".$precio_venta_f." USD"),1,0,'C');
	// $pdf->Cell(19,7,utf8_decode("$0.00 USD"),'L',0,'C');
	$pdf->Cell(41,7,utf8_decode("$".$precio_total_f." USD"),1,0,'C');

	$pdf->Ln(7);
	/*----------  Fin Detalles de la tabla  ----------*/
	
	
	
		//Insert en la tabla detalle_cotizacion
		$insert_detail=mysqli_query($objConexion, "INSERT INTO detalle_compra(numero_factura,id_productos,cantidad,precio_compra) VALUES ('$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
		
		$nums++;
		}

		$subtotal=number_format($sumador_total,2,'.','');
		$total_iva=($subtotal *  $iva)/100;
		$total_iva=number_format($total_iva,2,'.','');
		$total_factura=$subtotal+$total_iva;

	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(90,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(35,7,utf8_decode("SUBTOTAL"),1,0,'C');
	$pdf->Cell(41,7,utf8_decode("+ $".number_format($subtotal,2)." USD"),1,0,'C');

	$pdf->Ln(7);

	$pdf->Cell(90,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(35,7,utf8_decode("IVA". ($iva."%")),1,0,'C');
	$pdf->Cell(41,7,utf8_decode("+ $".number_format($total_iva,2)." USD"),1,0,'C');

	$pdf->Ln(7);

	$pdf->Cell(90,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');


	$pdf->Cell(35,7,utf8_decode("TOTAL A PAGAR"),1,0,'C');
	$pdf->Cell(41,7,utf8_decode("$".number_format($total_factura,2)."USD"),1,0,'C');

	// $pdf->Ln(7);

	// $pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(32,7,utf8_decode("TOTAL PAGADO"),'',0,'C');
	// $pdf->Cell(34,7,utf8_decode("$100.00 USD"),'',0,'C');

	// $pdf->Ln(7);

	// $pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(32,7,utf8_decode("CAMBIO"),'',0,'C');
	// $pdf->Cell(34,7,utf8_decode("$30.00 USD"),'',0,'C');

	// $pdf->Ln(7);

	// $pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	// $pdf->Cell(32,7,utf8_decode("USTED AHORRA"),'',0,'C');
	// $pdf->Cell(34,7,utf8_decode("$0.00 USD"),'',0,'C');

	$pdf->Ln(12);

	// $pdf->SetFont('Arial','',9);

	// $pdf->SetTextColor(39,39,51);
	// $pdf->MultiCell(0,9,utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);

	$pdf->Ln(9);
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($objConexion,"INSERT INTO compra (numero_factura,fecha_factura,id_proveedor,id_usuario,iva,total_compra,estado_factura,codigo_venta)VALUES ('$numero_factura','$date','$id_proveedor','$id_usuario','$iva','$total_factura','1','$codigo_venta')");
$delete=mysqli_query($objConexion,"DELETE FROM tmp_compra WHERE tmp_compra.id_session='$session_id'");

	# Codigo de barras #
	// $pdf->SetFillColor(39,39,51);
	// $pdf->SetDrawColor(23,83,201);
	// $pdf->Code128(72,$pdf->GetY(),$codigo_venta,70,20);
	// $pdf->SetXY(12,$pdf->GetY()+21);
	// $pdf->SetFont('Arial','',12);
	// $pdf->MultiCell(0,5,utf8_decode($codigo_venta),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_".$numero_factura.".pdf",true);