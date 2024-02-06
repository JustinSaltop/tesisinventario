<?php

	# Incluyendo librerias necesarias #
    require "./code128.php";
    include("../conf/confconexion.php");
	$id_factura= intval($_GET['id_factura']);
	$sql_count=mysqli_query($objConexion,"select * from ventas where id_factura='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($objConexion,"select * from ventas where id_factura='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_factura'];
	$id_cliente=$rw_factura['id_clientes'];
	$id_vendedor=$rw_factura['id_usuario'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$condiciones=$rw_factura['condiciones'];	
    $codigo_venta=$rw_factura['codigo_venta'];	
    $pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $query = mysqli_query($objConexion,"select * from tb_configuracion");
	$datos =mysqli_fetch_array($query);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,utf8_decode(strtoupper($datos['nombre'])),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,utf8_decode("RUC: 0000000000"),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Direccion:".$datos['direccion']),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Teléfono: ".$datos['telefono']),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Email: ".$datos['correo']),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,utf8_decode("Fecha: ".date("d/m/Y", strtotime($fecha_factura))." ".date("h:s A")),0,'C',false);
    //  $pdf->MultiCell(0,5,utf8_decode("Caja Nro:"),0,'C',false);
    $sql_user=mysqli_query($objConexion,"select * from tb_usuario where id_usuario='$id_vendedor'");
	$rw_user=mysqli_fetch_array($sql_user);
	 $rw_user['nombre'];
    $pdf->MultiCell(0,5,utf8_decode("Vendedor:". $rw_user['nombre']),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,5,utf8_decode(strtoupper("Ticket Nro: ".$numero_factura)),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);
    $query=mysqli_query($objConexion,'select *from tb_configuracion');
	$iva=mysqli_fetch_array($query);
	 $sql_cliente=mysqli_query($objConexion,"select * from tb_clientes where id_clientes='$id_cliente'");
	$rw_cliente=mysqli_fetch_array($sql_cliente);

    $pdf->MultiCell(0,5,utf8_decode("Cliente: ".$rw_cliente['nombres_apellidos']),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Cedula:".$rw_cliente['cedula']),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Teléfono: ".$rw_cliente['telefono']),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Dirección: ".$rw_cliente['direccion']),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    # Tabla de productos #
    $pdf->Cell(15,5,utf8_decode("Nomb."),0,0,'C');
    $pdf->Cell(10,5,utf8_decode("Cant."),0,0,'C');
    $pdf->Cell(19,5,utf8_decode("Precio"),0,0,'C');
    
    $pdf->Cell(28,5,utf8_decode("Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);


    $nums=1;
    $sumador_total=0;
    $sql=mysqli_query($objConexion, "select * from tb_productos, detalle_venta, ventas where tb_productos.id_productos=detalle_venta.id_productos and detalle_venta.numero_factura=ventas.numero_factura and ventas.id_factura='".$id_factura."'");
    
    while ($row=mysqli_fetch_array($sql))
        {
        $id_producto=$row["id_productos"];
        $codigo_producto=$row['codigo'];
        $cantidad=$row['cantidad'];
        $nombre_producto=$row['descripcion'];
        
        $precio_venta=$row['precio_venta'];
        $precio_venta_f=number_format($precio_venta,2);//Formateo variables
        $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
        $precio_total=$precio_venta_r*$cantidad;
        $precio_total_f=number_format($precio_total,2);//Precio total formateado
        $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
        $sumador_total+=$precio_total_r;//Sumador
        
        // $pdf->MultiCell(0,4,utf8_decode($nombre_producto),0,'C',false);
        $pdf->Cell(19,4,utf8_decode($nombre_producto),0,0,'C');
    $pdf->Cell(10,4,utf8_decode($cantidad),0,0,'C');
    $pdf->Cell(19,4,utf8_decode("$".$precio_venta_f." USD"),0,0,'C');
    
    $pdf->Cell(28,4,utf8_decode("$".$precio_total_f." USD"),0,0,'C');
    $pdf->Ln(4);
            
        
            
            $nums++;
            }
    /*----------  Detalles de la tabla  ----------*/
  
    // $pdf->MultiCell(0,4,utf8_decode("Garantía de fábrica: 2 Meses"),0,'C',false);
    $pdf->Ln(7);
    /*----------  Fin Detalles de la tabla  ----------*/



    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);
        $subtotal=number_format($sumador_total,2,'.','');
		$total_iva=($subtotal *  $iva['iva'])/100;
		$total_iva=number_format($total_iva,2,'.','');
		$total_factura=$subtotal+$total_iva;

    # Impuestos & totales #
    $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $pdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,utf8_decode("+ $".number_format($subtotal,2)." USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $pdf->Cell(22,5,utf8_decode("IVA ".($iva['iva']."%")),0,0,'C');
    $pdf->Cell(32,5,utf8_decode("+ $".number_format($total_iva,2)." USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $pdf->Cell(22,5,utf8_decode("TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,utf8_decode("$".number_format($total_factura,2)."USD"),0,0,'C');

    $pdf->Ln(5);
    
    // $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $pdf->Cell(22,5,utf8_decode("TOTAL PAGADO"),0,0,'C');
    // $pdf->Cell(32,5,utf8_decode("$100.00 USD"),0,0,'C');

    // $pdf->Ln(5);

    // $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $pdf->Cell(22,5,utf8_decode("CAMBIO"),0,0,'C');
    // $pdf->Cell(32,5,utf8_decode("$30.00 USD"),0,0,'C');

    // $pdf->Ln(5);

    // $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $pdf->Cell(22,5,utf8_decode("USTED AHORRA"),0,0,'C');
    // $pdf->Cell(32,5,utf8_decode("$0.00 USD"),0,0,'C');

    $pdf->Ln(10);

    $pdf->MultiCell(0,5,utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,utf8_decode("Gracias por su compra"),'',0,'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(), $codigo_venta,70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,utf8_decode($codigo_venta),0,'C',false);
    
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_".$numero_factura.".pdf",true);