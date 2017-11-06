<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/verificar-ingreso-cliente.php"; ?>
<?php
	$_SESSION['IdCliente']=$xCodCliente;
	if($_SESSION['IdProducto']==""){
		$link = "productos.php";
	}else{
		$link = "producto-detalle.php?cod_producto=".$_SESSION['IdProducto']."&cod_categoria=".$_SESSION['IdCategoria']."&cod_sub_categoria=".$_SESSION['IdSCategoria'];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
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
                <h1 class="page-header">Zona exclusiva</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Bienvenidos</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Bienvenidos</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<p>Hola <strong><?php echo utf8_decode($xAlias); ?></strong> Bienvenido al sistema de carrito de compras</p>
                <p>A partir de estos momentos Ud. puede hacer uso del sistema de carrito de compras y el sistema de pedidos en l&iacute;nea. Puede a&ntilde;adir productos. Eliminar Productos, Actualizar datos y cantidades y hacer su pedido en l&iacute;nea a su vez tambi&eacute;n realizar compras.</p>
                <p>Atentamente<br />
				Dtpo. Ventas</p>
                <p><a class="btn btn-primary" href="<?php echo $link; ?>">VOLVER AL CAT&Aacute;LOGO</a> | <a class="btn btn-primary" href="cerrar-sesion.php">CERRAR SESI&Oacute;N</a></p>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>