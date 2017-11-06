<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$codorden = $_REQUEST['codorden'];
$clientes = "SELECT * FROM pedidos as p, clientes as c WHERE p.cod_orden='$codorden' AND p.cod_cliente=c.cod_cliente";
$resultadoC = mysqli_query($enlaces, $clientes);
$filacli = mysqli_fetch_array($resultadoC);
$codigoorden 	= $filacli['cod_orden'];
$nombres 		= $filacli['nombres'];
$direccion 		= $filacli['direccion'];
$telefono 		= $filacli['telefono'];
$email 			= $filacli['email'];
$bruto	 		= $filacli['bruto'];
$igv	 		= $filacli['igv'];
$total	 		= $filacli['total'];
$observaciones	= utf8_encode($filacli['observaciones']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
	<script src="js/visitante-alert.js"></script>
</head>
<body>
	<div id="loading">
		<div>
			<div></div>
		    <div></div>
		    <div></div>
		</div>
	</div>
	<div id="wrapper">
        <?php include("includes/header.php") ?>
		<div id="content" class="clearfix">
			<div class="header">
            	<h1 class="page-title">Productos</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-barcode"></i> Productos <i class="fa fa-caret-right"></i> Pedidos <i class="fa fa-caret-right"></i> Editar Pedidos
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Pedidos</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
							<form name="fcms" method="post" action="">
								<div class="grid12">
									<p><strong>Nº de Orden de Compra : </strong><?php echo $codigoorden; ?></p>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde-tablas">
										<tr>
											<th width="5%" scope="col">Nº</th>
											<th width="45%" scope="col">Producto</th>
											<th width="10%" scope="col">Cantidad</th>
											<th width="20%" scope="col">Precio</th>
											<th width="20%" scope="col">Total</th>
										</tr>
										<?php
											$detalles = "SELECT * FROM pedidodetalle as d, productos as p WHERE d.cod_orden='$codorden' AND d.cod_producto=p.cod_producto";
											$resultade = mysqli_query($enlaces,$detalles);
											while($filaDetalle = mysqli_fetch_array($resultade)){
												$xCodOrden 		= $filaDetalle['cod_orden'];
												$xNomPro 		= $filaDetalle['nom_producto'];
												$xCantidad	 	= $filaDetalle['cantidad'];
												$xPrecio 		= $filaDetalle['precio'];
												$xTotal			= ($xCantidad*$xPrecio);
												$xGeneral		= ($xGeneral+$xTotal);
												$num++;
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $xNomPro; ?></td>
											<td><?php echo $xCantidad; ?></td>
											<td>$. <?php echo number_format($xPrecio,2); ?></td>
											<td>$. <?php echo number_format($xTotal,2); ?></td>
										</tr>
										<?php
											}
										?>
									</table>
									<div class="grid3" style="float:right;">
										<p><strong>Monto Bruto : </strong>$. <?php echo number_format($bruto,2); ?></p>
										<p><strong>+ IGV (10%) : </strong>$. <?php echo number_format($igv,2); ?></p>
										<p><strong>Neto a Pagar : </strong>$. <?php echo number_format($total,2); ?></p>
									</div>
									<hr>
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="2" bgcolor="#99979c"><strong style="color:#fff;">DATOS DEL CLIENTE</strong></td>
										</tr>
										<tr>
											<td width="30%"><strong>Nombres :</strong></td>
											<td width="70%"><?php echo utf8_encode($nombres); ?></td>
										</tr>
										<tr>
											<td><strong>Direcci&oacute;n :</strong></td>
											<td><?php echo utf8_encode($direccion); ?></td>
										</tr>
										<tr>
											<td><strong>Tel&eacute;fono :</strong></td>
											<td><?php echo $telefono; ?></td>
										</tr>
										<tr>
											<td><strong>Email :</strong></td>
											<td><?php echo $email; ?></td>
										</tr>
										<tr>
											<td><strong>Observaciones :</strong></td>
											<td><?php echo $observaciones; ?></td>
										</tr>
									</table>
									<div class="separador-20"></div>
									<label><span><strong>Nota:</strong> Cancele el pedido para borrarlo, <u>una vez se haya realizado el pago</u>.</span></label><br>
									<div class="separador-20"></div>
									<div class="btn-group">
                                        <a href="pedidos.php" class="btn btn-pink"><i class="fa fa-times"></i> Volver a Pedidos</a>
                                        <a href="<?php if($xVisitante=="No"){ ?>pedidos-delete.php?cod_orden=<?php echo $xCodOrden; ?><?php }else{ ?>javascript:visitante();<?php } ?>" class="btn btn-red"><i class="fa fa-trash"></i> Cancelar Pedido</a>
									</div>
									<div class="separador-20"></div>
								</div>
							</form>
						</div>
                    </div>
				</div>
			</div> <!-- /wrp -->
		</div> <!-- /content -->
	</div> <!-- /wrapper -->
    <?php include("includes/footer.php") ?>
</body>
</html>