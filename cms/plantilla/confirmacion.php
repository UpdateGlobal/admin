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
                <h1 class="page-header">Confirmaci&oacute;n</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Confirmaci&oacute;n</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Envio de Pedido Finalizado con &Eacute;xito</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p><strong>Hola <?php echo utf8_decode($xAlias); ?> Tus pedidos se enviaron con exito</strong></p>
				<p>En breves momentos un representante de nuestra empresa se pondra en contacto con ud.</p>
				<p>Atentamente </br>
                Dtpo. Ventas</p>
                <p><a href="productos.php" class="btn btn-primary">OTRO PEDIDO</a> | <a href="cerrar-sesion.php" class="btn btn-primary">CERRAR SESION</a></p>
			</div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>