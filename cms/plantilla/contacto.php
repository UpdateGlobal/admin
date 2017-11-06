<?php include("cms/modulos/conexion.php"); ?>
<?php include "modulos/session-core.php"; ?>
<?php
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}

if($proceso=="Registrar"){
	$nombre			= $_POST['nombre'];
	$email			= $_POST['email'];
	$telefono		= $_POST['telefono'];
	$comentario		= $_POST['comentario'];
	$fecha_ingreso	= $_POST['fecha_ingreso'];
	
	$contacto = "INSERT INTO formulario(nombre, email, telefono, comentario, fecha_ingreso)VALUES('$nombres', '$email', '$telefono', '$comentario', '$fecha_ingreso')";
	$result=mysqli_query($enlaces, $contacto);
	
	/*--- enviar datos al email ----*/

	$consultarCot = 'SELECT * FROM contacto';
	$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaCot = mysqli_fetch_array($resultadoCot)){
			$xDesemail		= $filaCot['form_mail'];
		}
	$emailDestino = $xDesemail;
	$encabezado = "Contacto desde su Web";
	$mensaje .= "Informacion del Contacto\n";
	$mensaje .= "------------------------\n";
	$mensaje .= "Nombres		:".$nombre."\n";
	$mensaje .= "Email			:".$email."\n";
	$mensaje .= "Telefono		:".$telefono."\n";
	$mensaje .= "Fecha			:".$fecha_ingreso."\n";
	$mensaje .= "Mensaje		:".$comentario."\n";
	
	$mailcabecera = "Desde: ".$email." <". $nombres. "> \n";
	$mailcabecera .= "Responder a: ".$email."\n\n";
	mail($emailDestino,$encabezado, $mensaje, $mailcabecera);
	header("Location:gracias.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function Validar(){
			document.contacto.action="contacto.php";
			if(document.contacto.nombre.value==""){
				alert("Debe ingresar su nombres");
				document.contacto.nombre.focus();
				return;	
			}
			if(document.contacto.email.value==""){
				alert("Debe ingresar su email");
				document.contacto.email.focus();
				return;	
			}
			if(document.contacto.telefono.value==""){
				alert("Debe ingresar su telefono");
				document.contacto.telefono.focus();
				return;	
			}
			if(document.contacto.comentario.value==""){
				alert("Debe ingresar su mensaje");
				document.contacto.comentario.focus();
				return;	
			}
			document.contacto.proceso.value="Registrar";
			document.contacto.submit();
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
                <h1 class="page-header">Cont&aacute;ctenos</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Cont&aacute;ctenos</li>
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
                <?php if($xMap!=""){ ?>
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $xMap; ?>"></iframe>
                <?php }else{?><?php } ?>
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
                    <abbr title="Phone">T</abbr>: <?php echo $xPhone; ?></p>
				<p><i class="fa fa-mobile"></i> 
                    <abbr title="Phone">M</abbr>: <?php echo $xMobile; ?></p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E</abbr>: <a href="mailto:<?php echo $xEmail; ?>"><?php echo $xEmail; ?></a>
                </p>
				<?php
					}
					mysqli_free_result($resultadoCot);
				?>
				<ul class="list-unstyled list-inline list-social-icons">
					<?php
						$consultarSol = 'SELECT * FROM social WHERE estado="Activo" ORDER BY orden';
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
				<form name="contacto" id="contacto" method="post" action="">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nombre: *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                    </div>
					<div class="control-group form-group">
                        <div class="controls">
                            <label>Direcci&oacute;n:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion">
                        </div>
                    </div>
					<div class="control-group form-group">
                        <div class="controls">
                            <label>Email: *</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Tel&eacute;fono: *</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mensaje: *</label>
                            <textarea rows="10" cols="100" class="form-control" name="comentario" id="comentario" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
					<input type="button" value="Enviar Mensaje" class="btn btn-primary" onClick="javasript:Validar();">
					<input type="hidden" name="proceso">
					<?php
					$fecha = date("Y-m-d");
					?>
                    <input type="hidden" name="fecha_ingreso" value="<?php echo $fecha ?>">
                </form>
            </div>
        </div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
    <!-- <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script> -->
</body>
</html>