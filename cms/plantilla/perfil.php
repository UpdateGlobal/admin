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
                    <li class="active"><strong>Perfil</strong></li>
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
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<label><strong>Nombres:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $nombres; ?>
					</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Direcci&oacute;n:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $direccion; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Tel&eacute;fono:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $telefono; ?>
					</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<label><strong>Empresa: </strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $empresa; ?>
                    </div>
				</div>	
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<label><strong>Fecha Nacimiento:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $fecha_nacimiento; ?>
					</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<label><strong>Sexo:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
						<?php echo $sexo; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <p class="linea"><a class="btn btn-primary" href="perfil-editar.php?cod_cliente=<?php echo $cod_cliente; ?>">Cambiar Datos de Perfil</a></p>
                    </div>
                </div>
				<hr />
				<h3 class="page-header">Datos de la Cuenta</h3>
				<div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label><strong>E-mail:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php echo $email; ?>
                    </div>
				</div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Clave:</strong></label>
					</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <p>**************</p>
					</div>
                </div>
				<div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <p class="linea"><a class="btn btn-primary" href="clave-editar.php?cod_cliente=<?php echo $cod_cliente; ?>">Cambiar Datos de Cuenta</a></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <p style="float:right;"><a class="btn btn-danger" href="perfil-delete.php">Eliminar Cuenta</a></p>
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