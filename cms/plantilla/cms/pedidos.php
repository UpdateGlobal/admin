<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Nº"; }
			td:nth-of-type(2):before { content: "Orden de Compra"; }
			td:nth-of-type(3):before { content: "Nombre del Cliente"; }
			td:nth-of-type(4):before { content: "Fecha pedido"; }
			td:nth-of-type(5):before { content: "Total"; }
			td:nth-of-type(6):before { content: ""; }
		}
	</style>
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
				<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Pedidos
			</div>
			<div class="wrp clearfix">
            	<?php $page = "pedidos"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Pedidos</strong>
							</div>
						</div>
						<div class="widget-content">
							<?php
								$consultarCot = 'SELECT * FROM contacto';
								$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
								while($filaCot = mysqli_fetch_array($resultadoCot)){
									$xCodigo		= $filaCot['cod_contact'];
									$xCartem		= $filaCot['cart_mail'];
							?>
							<ul class="list-group">
								<li class="list-group-item">
									<p><strong>Correo que recibe los pedidos:</strong></p>
									<p><?php echo $xCartem; ?></p>
								</li>
							</ul>
							<a href="pedidos-correo.php?cod_contact=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Correo</a>
							<?php
								}
								mysqli_free_result($resultadoCot);
							?>
							<hr>
							
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1">
                                	<thead>
                                        <tr>
											<th width="5%" scope="col">Nº</th>
						            	    <th width="25%" scope="col">Orden</th>
						            	    <th width="25%" scope="col">Cliente</th>
						            	    <th width="20%" scope="col">Fecha</th>
						            	    <th width="20%" scope="col">Total</th>
						            	    <th width="5%" scope="col">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <?php
										$pedidos = "SELECT * FROM pedidos as p, clientes as c WHERE p.cod_cliente=c.cod_cliente ORDER BY p.fechapedido DESC";
										$resultadoPedidos = mysqli_query($enlaces, $pedidos);
										while($filaPedidos = mysqli_fetch_array($resultadoPedidos)){
											$xCodOrden 		= $filaPedidos['cod_orden'];
											$xNombres 		= utf8_encode($filaPedidos['nombres']);
											$xFechaPedido 	= $filaPedidos['fechapedido'];
											$xBruto	 		= $filaPedidos['bruto'];
											$xTotal	 		= $filaPedidos['total'];
											$num++;
									?>
                                    <tr>
                                        <td><?php echo $num; ?></td>
    					        	    <td><?php echo $xCodOrden; ?></td>
					            	    <td><?php echo $xNombres; ?></td>
					            	    <td><?php echo $xFechaPedido; ?></td>
					            	    <td><?php echo number_format($xTotal,2); ?></td>
					            	    <td><a class="boton-nuevo" href="pedidos-editar.php?codorden=<?php echo $xCodOrden; ?>"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                    <?php
                                        }
                                        mysqli_free_result($resultadoPedidos);
                                    ?>
                                </table>
                            </form>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>