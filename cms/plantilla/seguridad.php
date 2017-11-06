<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<!doctype html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <meta http-equiv="refresh" content="7;URL=ingreso.php">
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
                    <li><a href="ingreso.php">Ingreso</a></li>
                    <li class="active"><strong>Seguridad</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Usuario no Autorizado</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p><strong>&iexcl; Ops Lo Sentimos !</strong></p>
                <p>Lo sentimos, ud. no es cliente registrado de nuestro sistema. Si deseas ser cliente puedes registrarte haciendo <a href="registrar.php" class="clicaqui">CLIC AQU&Iacute;</a> O vuelva a interlo ingresando email y clave correcta.</p>
                <p>Atentamente<br></p>
				<p>Dtpo. Ventas</p>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>