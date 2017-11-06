<?php include("modulos/conexion.php"); ?>
<?php include("modulos/verificar.php"); ?>
<?php
$cod_contact	= $_REQUEST['cod_contact'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso==""){
	$consultaContact = "SELECT * FROM contacto WHERE cod_contact='$cod_contact'";
	$ejecutarContact = mysqli_query($enlaces,$consultaContact) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaCot = mysqli_fetch_array($ejecutarContact);
	$xCodigo 		= $filaCot['cod_contact'];
	$xDirection 	= htmlspecialchars(utf8_encode($filaCot['direction']));
	$xPhone 		= htmlspecialchars(utf8_encode($filaCot['phone']));
	$xMobile 		= htmlspecialchars(utf8_encode($filaCot['mobile']));
	$xEmail 		= htmlspecialchars(utf8_encode($filaCot['email']));
	$xMap 			= htmlspecialchars($filaCot['map']);
	$xFormem 		= htmlspecialchars(utf8_encode($filaCot['form_mail']));
}

if($proceso == "Actualizar"){
	$cod_contact	= $_POST['cod_contact'];
	$direction		= mysqli_real_escape_string($enlaces, utf8_decode($_POST['direction']));
	$phone			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['phone']));
	$mobile			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['mobile']));
	$email			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['email']));
	$map			= mysqli_real_escape_string($enlaces, $_POST['map']);
	$formem			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['form_mail']));

	$ActualizarContact = "UPDATE contacto SET cod_contact='$cod_contact', direction='$direction', phone='$phone', mobile='$mobile', email='$email', map='$map', form_mail='$formem' WHERE cod_contact='$cod_contact'";
	$resultadoActualizar = mysqli_query($enlaces,$ActualizarContact);
	header("Location:contacto.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <script>
		function Validar(){
			if(document.fcms.form_mail.value==""){
				alert("¡El correo para los mensajes del formulario es obligatorio!");
				document.fcms.form_mail.focus();
				return;	
			}
			if (document.fcms.form_mail.value.indexOf('@') == -1){
				alert ("La \"dirección de email\" no es correcta");
				document.fcms.form_mail.focus();
				return;
			}
			document.fcms.action = "contacto-edit.php";
			document.fcms.proceso.value="Actualizar";
			document.fcms.submit();
		}
	</script>
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
        <?php $menu = "contacto"; include("includes/header.php"); ?>
		<div id="content" class="clearfix">
			<div class="header">
				<h1 class="page-title">Contacto</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Contacto <i class="fa fa-caret-right"></i> Editar datos de contacto
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Datos de contacto</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Direcci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" name="direction" value="<?php echo $xDirection; ?>" />
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                            <label>Email: </label>
                                        </div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <p><input type="email" name="email" value="<?php echo $xEmail; ?>" /></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Tel&eacute;fono: </label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" name="phone" value="<?php echo $xPhone; ?>" />
                                        </div>
                                    	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                            <label>Celular: </label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" name="mobile" value="<?php echo $xMobile; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Mapa de Contacto: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $xMap; ?></p><?php } ?>
                                            <input type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="map" value="<?php echo $xMap; ?>" />
		                                    <?php if($xMap!=""){ ?>
												<iframe src="<?php echo $xMap; ?>" width="100%" frameborder="1" height="250"></iframe>
            	                            <?php }else{ ?><?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Correo que recibe los mensajes del Formulario: *</label>
                                        </div>
                                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $xFormem; ?></p><?php } ?>
                                            <input type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="form_mail" value="<?php echo $xFormem; ?>" />
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="btn-group">
                                            	<a href="contacto.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Actualizar Datos de Contacto</button>
											</div>
											<input type="hidden" name="proceso">
                							<input type="hidden" name="cod_contact" value="<?php echo $xCodigo; ?>">
                                        </div>
									</div>
                                </div>
    	                    </form>
							<label><span>Los campos con ( <strong>*</strong> ) son obligatorios.</span></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>