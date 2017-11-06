<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<?php
$varCliente = $_SESSION['IdCliente'];
$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$varCliente'";
$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filaCli = mysqli_fetch_array($ejecutarClientes);
$cod_cliente		= $filaCli['cod_cliente'];
$email				= $filaCli['email'];
?>
<!DOCTYPE html>
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
                <h1 class="page-header">Clave Cambiada</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
					<li class="active"><strong>Clave Cambiada</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Clave Cambiada con &Eacute;xito</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p><strong>Hola <?php echo utf8_decode($xAlias); ?> Tus clave se cambi&oacute; con &eacute;xito</strong></p>
				<p>Un correo con todos sus datos ha sido enviado a <?php echo $email; ?>.<br>
				No olvide inciar sesi&oacute;n con su nueva contrase&ntilde;a</p>
				<p>Atentamente</br>
                Dtpo. Ventas</p>
                <p><a href="perfil.php" class="btn btn-primary">Volver al Perfil</a> | <a href="cerrar-sesion.php" class="btn btn-primary">CERRAR SESION</a></p>
			</div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>