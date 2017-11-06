<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/verificar-ingreso-cliente.php"; ?>
<?php
$varCliente = $_SESSION['IdCliente'];
$cambio		= $_REQUEST['cambio'];
$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$varCliente'";
$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filaCli = mysqli_fetch_array($ejecutarClientes);
$cod_cliente		= $filaCli['cod_cliente'];
$nombres 			= $filaCli['nombres'];
$direccion			= $filaCli['direccion'];
$telefono			= $filaCli['telefono'];
$email				= $filaCli['email'];
$clave 				= $filaCli['clave'];
$empresa 			= $filaCli['empresa'];
$fecha_nacimiento 	= $filaCli['fecha_nacimiento'];
$sexo				= $filaCli['sexo'];
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
                <h1 class="page-header">Perfil</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
					<li><a href="perfil.php">Perfil</a></li>
                    <li class="active"><strong>Eliminar</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Datos de Perfil</h2>
				<?php echo $cambio; ?>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p><?php echo utf8_decode($xAlias); ?> ¿Está seguro que quiere eliminar su cuenta?</p>
						<p><strong>Nota:</strong> Esta acción no se puede deshacer).</p>
						<p><a href="perfil.php" class="btn btn-default">&laquo; Volver</a> | <a href="perfil-eliminar.php?cod_cliente=<?php echo $cod_cliente; ?>" class="btn btn-danger">ELIMINAR PERFIL</a></p>
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