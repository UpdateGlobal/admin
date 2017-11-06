<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_usuario = $_REQUEST['cod_usuario'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
	$chk 		= $_POST['chk'];
} else {
	$proceso 	= "";
	$chk 		= "";
}
if($proceso == ""){
	$consultaUsuario = "SELECT * FROM usuarios WHERE cod_usuario='$cod_usuario'";
	$ejecutarUsuario = mysqli_query($enlaces,$consultaUsuario) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaUsuario = mysqli_fetch_array($ejecutarUsuario);
	$cod_usuario 	= $filaUsuario['cod_usuario'];
	$nombres 		= mysqli_real_escape_string($enlaces, utf8_encode($filaUsuario['nombres']));
	$email 			= mysqli_real_escape_string($enlaces, $filaUsuario['email']);
	$usuario		= mysqli_real_escape_string($enlaces, $filaUsuario['usuario']);
	$clave			= mysqli_real_escape_string($enlaces, $filaUsuario['clave']);
	$visitante		= $filaUsuario['visitante'];
	$estado			= $filaUsuario['estado'];
}
if($proceso == "Actualizar"){
	$cod_usuario	= $_POST['cod_usuario'];
	$nombres		= mysqli_real_escape_string($enlaces, utf8_decode($_POST['nombres']));
	$email			= mysqli_real_escape_string($enlaces, $_POST['email']);
	$usuario		= mysqli_real_escape_string($enlaces, $_POST['usuario']);
	$clave			= mysqli_real_escape_string($enlaces, $_POST['clave']);
	$visitante		= $_POST['visitante'];
	$estado			= $_POST['estado'];
	
	$consultarMet = 'SELECT * FROM metatags';
	$resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
	while($filaMet = mysqli_fetch_array($resultadoMet)){
		$xUrl			= mysqli_real_escape_string($enlaces, $filaMet['url']);
	}
	if($chk=="s") {	
		/*---- Mensaje para el correo electronico ----*/
		$emailDestino = $email;
		$encabezado = "Datos de Usuario Actualizado";
		$mensaje = "
			<h3>Informaci&oacute;n del Usuario para el administrador actualizada</h3>
			<table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
				<tr>
					<td width='25%'><strong>Website : </strong></th>
					<td width='75%'>".$xUrl."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Nombre : </strong></th>
					<td width='75%'>".$nombres."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Usuario : </strong></th>
					<td width='75%'>".$usuario."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Email : </strong></th>
					<td width='75%'>".$email."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Clave : </strong></th>
					<td width='75%'>".$clave."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Visitante : </strong></th>
					<td width='75%'>".$visitante."</th>
				</tr>
				<tr>
					<td width='25%'><strong>Estado : </strong></th>
					<td width='75%'>".$estado."</th>
				</tr>
			</table>
			<p>Para ingresar al administrador haga <a href='".$xUrl."/cms'>click aqu&iacute;</a>";
			
		$destino = $email;
		$mailCabecera = 'MIME-Version: 1.0'."\r\n";
		$mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
		$mailCabecera.= "FROM: ".$email;
		$mailCabecera.= "<".$email.">\r\n";
		$mailCabecera.= "Reply-To: ".$email;
		$mensajeEmail = $mensaje;
		mail($emailDestino,$encabezado,$mensajeEmail,$mailCabecera);
	}
	$actualizarUsuarios = "UPDATE usuarios SET cod_usuario='$cod_usuario', nombres='$nombres', email='$email', usuario='$usuario', clave='$clave', visitante='$visitante', estado='$estado' WHERE cod_usuario='$cod_usuario'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location: usuarios.php");
}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
	<script>
		function Validar(){
			if(document.fcms.nombres.value==""){
				alert("Debes ingresar su nombre");
				document.fcms.nombres.focus();
				return;	
			}
			if(document.fcms.email.value==""){
				alert("Debes ingresar un email");
				document.fcms.email.focus();
				return;	
			}
			if (document.fcms.email.value.indexOf('@') == -1){
				alert ("La \"dirección de email\" no es correcta");
				document.fcms.email.focus();
				return;
			}
			if(document.fcms.usuario.value==""){
				alert("Debes ingresar un nombre de usuario");
				document.fcms.usuario.focus();
				return;	
			}
			if(document.fcms.clave.value==""){
				alert("Debes ingresar una clave");
				document.fcms.clave.focus();
				return;	
			}
			document.fcms.action = "usuario-edit.php";
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
        <?php include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">Usuarios</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Usuarios <i class="fa fa-caret-right"></i> Editar usuarios
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar usuario</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
	                        <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                            <label>Nombre: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                            <input type="text" name="nombres" value="<?php echo $nombres; ?>" />
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                        	<p><?php echo $email; ?></p>
                                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Usuario:</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                        	<p><?php echo $usuario; ?></p>
                                            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>" />
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Clave: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                        	<input type="password" name="clave" size="20" value="<?php echo $clave; ?>" >
                                        </div>
                                    </div>
                                    <?php if($xVisitante=="No"){ ?>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<div class="custom-input">
												<input <?php if (!(strcmp($estado,"Activo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" id="activo" value="Activo"><label for="activo">Activo</label>
												<input <?php if (!(strcmp($estado,"Inactivo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" id="inactivo" value="Inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <?php }else{ ?>
                                    	<input type="hidden" name="estado" value="<?php echo $estado; ?>" >
                                    <?php } ?>
                                    <?php if($xVisitante=="No"){ ?>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>&iquest;Visitante?:</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<div class="custom-input">
												<input <?php if (!(strcmp($visitante,"No"))) {echo "checked=\"checked\"";} ?> type="radio" name="visitante" id="no" value="No"><label for="no">No</label>
												<input <?php if (!(strcmp($visitante,"Si"))) {echo "checked=\"checked\"";} ?> type="radio" name="visitante" id="si" value="Si"><label for="si">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <?php }else{ ?>
                                    	<input type="hidden" name="visitante" value="<?php echo $visitante; ?>" >
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="custom-input">
			                                    <input name="chk" type="checkbox" id="chkbx-1" value="s"> <label for="chkbx-1" style="padding-left:20px;"> Enviar cambios al correo electr&oacute;nico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="usuarios.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Actualizar Usuario</button>
											</div>
							                <input type="hidden" name="proceso">
							                <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
                                        </div>
                                    </div>
								</div>
							</form>
                            <label><span>Los campos con ( <strong>*</strong> ) son obligatorios.</span></label>
                            <label><span>Los campos de <strong>Usuario</strong> e <strong>Email</strong> no se pueden cambiar.</span></label>
						</div>
                    </div>
				</div>
			</div> <!-- /wrp -->
		</div> <!-- /content -->
	</div> <!-- /wrapper -->
    <?php include("includes/footer.php") ?>
</body>
</html>