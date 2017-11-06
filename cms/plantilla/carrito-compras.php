<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/verificar-ingreso-cliente.php"; ?>
<?php
$varOrden 	= $_SESSION['IdOrden'];
$varCliente = $_SESSION['IdCliente'];
$total = "";

$carrito = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
$resultado = mysqli_query($enlaces,$carrito);
$fila = mysqli_fetch_assoc($resultado);
$totalCarrito=mysqli_num_rows($resultado);
?>
<!doctype html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <script>
		function Procesar(strAccion){
			if(strAccion=="Ordenar"){
				document.ftienda.action="pedidos-en-linea.php";
			}else{
				document.ftienda.action="verifica-carrito.php";
			}
			document.ftienda.method="POST";
			document.ftienda.proceso.value=strAccion;
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
                <h1 class="page-header">Carrito de Compras</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Carrito de Compras</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Carrito de Compras</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php
            		if($totalCarrito>0){
				?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	        	<p class="texto-der"><strong>N&ordm; de Orden :</strong> <?php echo $fila['cod_orden']; ?></p>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	        	        <p><strong>Usuario : </strong><?php echo utf8_decode($xAlias); ?></p>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    	        	    <p class="texto-der"><strong>Email :</strong><?php echo $xEmail; ?></p>
                	</div>
                </div>
                <form id="ftienda" method="post" name="ftienda">
	                <div class="row">
    	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
								<tr>
									<th width="5%" scope="col">&nbsp;</th>
									<th width="40%" scope="col">PRODUCTO</th>
									<th width="5%" scope="col">CANT.</th>
                            		<th width="20%" scope="col">PRECIO</th>
									<th width="30%" scope="col">TOTAL</th>
								</tr>
								<?php
                                    do{
                                        $xCodpro 	= $fila['cod_producto'];
                                        $xNombre 	= utf8_decode($fila['nom_producto']);
                                        $xImagen 	= $fila['imagen'];
                                        $xCantidad 	= $fila['cantidad'];
                                        if($fila['precio_oferta']!= 0){
                                            $pmostrar = $fila['precio_oferta'];
                                        }else{
                                            $pmostrar = $fila['precio_normal'];
                                        }
                                        $subtotal = ($xCantidad*$pmostrar);
                                        $total = ($total+$subtotal);
                                ?>
								<tr>
									<td><input type="checkbox" name="chk<?php echo $xCodpro; ?>"></td>
									<td>
                                        <p class="text-center">
                                            <img class="img-responsive" style="display:inline-block; max-width:150px;" src="cms/images/productos/<?php echo $xImagen; ?>"><br>
                                            <strong><?php echo $xNombre; ?></strong>
                                        </p>
                                    </td>
									<td><input name="txt<?php echo $xCodpro; ?>" type="text" id="txt" value="<?php echo $xCantidad; ?>" size="2"></td>
									<td>$.<?php echo number_format($pmostrar,2); ?> </td>
									<td>$.<?php echo number_format($subtotal,2); ?> </td>
								</tr>
								<?php
								}
									while($fila=mysqli_fetch_array($resultado))
								?>
							</table>
						</div>
					</div>
					<?php 
						$igv = ($total/10);
						$neto = ($total+$igv);
					?>
                    <div class="row">
    	                <div class="col-lg-offset-9 col-lg-3 col-md-offset-9 col-md-3 col-sm-offset-9 col-sm-3 col-xs-12">
                    		<input type="hidden" name="proceso">
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
        		                    <strong>+ IGV(10%) : </strong>
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
	                                $.<?php echo number_format(($total+$igv),2); ?>
                                </div>
							</div>
						</div>
					</div>
                    <div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary" href="productos.php"><i class="fa fa-shopping-cart"></i> Seguir Comprando</a>
                            <a class="btn btn-warning" href="javascript:Procesar('Actualizar')"><i class="fa fa-refresh"></i> Actualizar</a>
                            <a class="btn btn-danger" href="javascript:Procesar('Eliminar')"><i class="fa fa-trash"></i> Borrar</a>
                            <a class="btn btn-success" href="javascript:Procesar('Ordenar')"><i class="fa fa-paper-plane"></i> Ordenar Pedido</a>
                        </div>
					</div>
				</form>

				<?php
					}else{
				?>
				<p>En estos momentos el carrito esta sin productos, por favor seleccione uno o mas productos desde el cat&aacute;logo</p>
				<?php
					}
				?>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>