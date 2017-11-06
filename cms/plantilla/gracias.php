<?php include("cms/modulos/conexion.php"); ?>
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
                <h1 class="page-header">Contactenos</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Contactenos</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<?php
					$consultarCot = 'SELECT * FROM contacto';
					$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
					while($filaCot = mysqli_fetch_array($resultadoCot)){
						$xMap			= $filaCot['map'];
				?>
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $xMap; ?>"></iframe>
				<?php
					}
					mysqli_free_result($resultadoCot);
				?>
            </div>
		</div>
		<div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h3>Detalles de Contacto</h3>
				<?php
					$consultarCot = 'SELECT * FROM contacto';
					$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
					while($filaCot = mysqli_fetch_array($resultadoCot)){
						$xDirection		= $filaCot['direction'];
						$xPhone			= $filaCot['phone'];
						$xMobile		= $filaCot['mobile'];
						$xEmail			= $filaCot['email'];
				?>
                <p><?php echo $xDirection; ?></p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Tel&eacute;fono">T</abbr>: <?php echo $xPhone; ?></p>
				<p><i class="fa fa-mobile"></i> 
                    <abbr title="Celular">M</abbr>: <?php echo $xMobile; ?></p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E</abbr>: <a href="mailto:<?php echo $xEmail; ?>"><?php echo $xEmail; ?></a>
                </p>
				<?php
					}
					mysqli_free_result($resultadoCot);
				?>
				<ul class="list-unstyled list-inline list-social-icons">
					<?php
						$consultarSol = 'SELECT * FROM social ORDER BY orden';
						$resultadoSol = mysqli_query($enlaces,$consultarSol) or die('Consulta fallida: ' . mysqli_error($enlaces));
						while($filaSol = mysqli_fetch_array($resultadoSol)){
							$xType			= $filaSol['type'];
							$xLinks			= $filaSol['links'];
					?>                
                    <li>
                        <a href="<?php echo $xLinks; ?>"><i class="fa <?php echo $xType; ?> fa-2x"></i></a>
                    </li>
					<?php
						}
						mysqli_free_result($resultadoSol);
					?>
				</ul>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h3>Env&iacute;enos un mensaje</h3>
                <div class="well text-center">
					<i class="fa fa-envelope" style="font-size:100px; margin-bottom:10px;" aria-hidden="true"></i>
					<p>Su mensaje se envi&oacute; exitosamente, estaremos contestanto a la brevedad.</p>
					<a class="btn btn-primary" style="font-family:'Arial';" href="index.php">Volver al Index</a> <a class="btn btn btn-info" style="font-family:'Arial';" href="contacto.php">Enviar otro mensaje</a>
				</div>
            </div>
        </div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>
