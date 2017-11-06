<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/verificar-ingreso-cliente.php"; ?>
<?php
$varOrden 	= $_SESSION['IdOrden'];
$varCliente = $_SESSION['IdCliente'];
$total = "";
$carrito = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
$resultado = mysqli_query($enlaces, $carrito);
$fila = mysqli_fetch_assoc($resultado);
$totalCarrito=mysqli_num_rows($resultado);

/*-- Consulta para mostra datos del cliente ---*/
$clientes = "SELECT * FROM clientes WHERE cod_cliente='$xCodCliente'";
$resultCli = mysqli_query($enlaces, $clientes);
$filaCli = mysqli_fetch_array($resultCli);
?>
<!doctype html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <script>
		function Enviar(){
			document.ftienda.action="envia-pedido.php";
			document.ftienda.metod="POST";
			document.ftienda.submit();
		}
	</script>
</head>
<body>
	<div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pedidos en L&iacute;nea</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Pedidos en L&iacute;nea</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Pedidos en L&iacute;nea</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php
                	if($totalCarrito>0){
				?>
				<p class="texto-der"><strong>N&deg; de Orden : </strong><?php echo $fila['cod_orden']; ?></p>
				<form id="ftienda" method="post" name="ftienda">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
						<tr>
							<th width="50%" scope="col">PRODUCTO</th>
							<th width="10%" scope="col">CANT.</th>
							<th width="10%" scope="col">PRECIO</th>
							<th width="30%" scope="col">TOTAL</th>
						</tr>
						<?php
							do{
								$xCodigo 	= $fila['cod_producto'];
								$xNombre 	= utf8_decode($fila['nom_producto']);
								$xImagen 	= $fila['imagen'];
								$xCantidad 	= $fila['cantidad'];
								
								if($fila['precio_oferta']!= 0){
									$pmostrar = $fila['precio_oferta'];
								}else{
									$pmostrar = $fila['precio_normal'];
								}
								$subtotal = ($xCantidad*$pmostrar);
								$total = number_format(($total+$subtotal),2);
						?>
                        <tr>
							<td>
								<p class="text-center">
                                	<img src="cms/images/productos/<?php echo $xImagen; ?>"><br>
									<strong><?php echo $xNombre; ?></strong>
								</p>
							</td>
							<td><?php echo $xCantidad; ?></td>
							<td>$.<?php echo number_format($pmostrar,2); ?> </td>
							<td>$.<?php echo number_format($subtotal,2); ?> </td>
						</tr>
						<?php
							}while($fila=mysqli_fetch_array($resultado))
						?>
					</table>
						<?php 
							$igv = number_format(($total/10),2);
							$neto = number_format(($total+$igv),2);
						?>
                    <div class="row">
    	                <div class="col-lg-offset-9 col-lg-3 col-md-offset-9 col-md-3 col-sm-offset-9 col-sm-3 col-xs-12">
							<div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                            <strong>Monto Bruto : </strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    $.<?php echo number_format($total,2); ?>
								</div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        		                    <strong>+ IGV (10%) : </strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    $.<?php echo number_format($igv,2); ?>
								</div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<strong>Neto a Pagar : </strong>
								</div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                                $.<?php echo number_format($neto,2); ?>
                                </div>
							</div>
						</div>
					</div>
                    <div class="row">
    	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        	<h3>Datos del Cliente</h3>
                        	<div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Nombres :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['nombres'] ?>
                                </div>
							</div>
                        	<div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Direcci&oacute;n :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['direccion'] ?>
                                </div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Tel&eacute;fono :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['telefono'] ?>
                                </div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Email :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['email'] ?>
                                </div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Empresa :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['empresa'] ?>
                                </div>
							</div>
                            <div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Fecha Nacimiento :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['fecha_nacimiento'] ?>
                                </div>
							</div>
							<div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Sexo :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php echo $filaCli['sexo'] ?>
                                </div>
							</div>
							<div class="row">
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<strong>Comentarios :</strong>
                                </div>
    	                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<textarea name="comentarios" cols="60" rows="10"></textarea>
                                </div>
							</div>
            			</div>
                	</div>
				</form>
                <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    	                    <a class="btn btn-primary" href="cerrar-sesion.php"><i class="fa fa-power-off"></i> Cerrar Sesion</a>
        	                <a class="btn btn-info" href="javascript:print();"><i class="fa fa-print"></i> Imprimir</a>
            	            <a class="btn btn-success" href="javascript:Enviar();"><i class="fa fa-paper-plane"></i> Ordenar Pedido</a>
						<?php
							}else{
						?>
						<p>En estos momentos el carrito esta sin productos, por favor seleccione uno o mas productos desde el catàlogo para hacer su pedido en linea</p>
						<?php
							}
						?>
    	       			<!--Formulario paypal-->
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="raulmartiarena89-facilitator@gmail.com">            
						<?php 
							$consulCarrito = "SELECT * FROM productos, carrito WHERE carrito.cod_orden='$varOrden' AND carrito.cod_cliente='$varCliente' AND productos.cod_producto=carrito.cod_producto";
							$resultCarrito = mysqli_query($enlaces,$consulCarrito);	
							$i = 1;
							while($fila_carr=mysqli_fetch_array($resultCarrito)){
								$xCodigo 	= $fila_carr['cod_producto']; 	
								$xNombre	= utf8_encode($fila_carr['nom_producto']);
								$xCantidad	= $fila_carr['cantidad'];
								$pn 		= $fila_carr['precio_normal'];
								$po 		= $fila_carr['precio_oferta'];
								if ($po != 0) {
									$pmostrar = $po;
								} else {
									$pmostrar = $pn;				
								}
						?>
						<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $xNombre; ?>">
						<input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $xCodigo; ?>">
						<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $pmostrar; ?>">
						<input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $xCantidad; ?>">
						<?php
							$i++;
							}; 
            			?>
            			<input type="hidden" name="currency_code" value="USD">
            			<input type="hidden" name="lc" value="US">
	            		<input type="hidden" name="rm" value="2">
    	        		<input type="hidden" name="shipping_1" value="30.0">
        	    		<input type="hidden" name="return" value="http://raulmartiarena.com/practicas/gracias-cliente.php?view=thankyou">
            			<input type="hidden" name="cancel_return" value="http://raulmartiarena.com/practicas/cancelacion.php">
            			<input type="hidden" name="notify_url" value="http://raulmartiarena.com/practicas/paypal.php">
	            		<input class="btn btn-danger" type="submit" name="pay now" value="Comprar Ahora" />
    	        		<?php
							/*session_start();
							session_destroy();*/
							/*Borrando registros de la tabla carrito
							$xCliente = $_SESSION['IdCliente'];
							$xOrden = $_SESSION['IdOrden'];
							$borrar="DELETE FROM carrito WHERE cod_orden='$xOrden' AND cod_cliente='$xCliente'";
							$resultado = mysqli_query($enlaces,$borrar);*/
						?>
                        
					</form>
					</div>
				</div>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>