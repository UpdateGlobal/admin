<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == "Registrar"){
	$nombres	= mysqli_real_escape_string($enlaces, utf8_decode($_POST['nombres']));
	$email		= mysqli_real_escape_string($enlaces, $_POST['email']);
	$usuario	= mysqli_real_escape_string($enlaces, $_POST['usuario']);
	$clave		= mysqli_real_escape_string($enlaces, $_POST['clave']);
	$visitante	= $_POST['visitante'];
	$estado		= $_POST['estado'];
		
	$validarUsuarios = "SELECT * FROM usuarios WHERE email='$email' OR usuario='$usuario'";
	$ejecutarValidar = mysqli_query($enlaces,$validarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$numreg = mysqli_num_rows($ejecutarValidar);
	
	$consultarMet = 'SELECT * FROM metatags';
	$resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
	while($filaMet = mysqli_fetch_array($resultadoMet)){
		$xUrl			= mysqli_real_escape_string($enlaces, $filaMet['url']);
	}
	if($numreg==0){
	
		/*---- Mensaje para el correo electronico ----*/
		$emailDestino = $email;
		$encabezado = "Nuevo Usuario Registrado";
		$mensaje = "
			<h3>Informaci&oacute;n del Usuario para el administrador</h3>
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
		
		$insertarUsuarios = "INSERT INTO usuarios (nombres, email, usuario, clave, visitante, estado)VALUE('$nombres', '$email', '$usuario', '$clave', '$visitante', '$estado')";
		$resultadoInsertar = mysqli_query($enlaces,$insertarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
		$mensaje = "<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> Usuario se registr&oacute; con exitosamente. Un email con sus datos de usuario ha sido enviado al email registrado (de no verlo revise su carpeta de spam). <a href='usuarios.php'>Ir a Usuarios</a></p>
                	</div>";
	}else{
		$mensaje = "<div class='alert alert-warning' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> Ops, el usuario o el email ya existe...</p>
                	</div>";
	}
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
			
			document.fcms.action = "usuario-nuevo.php";
			document.fcms.proceso.value="Registrar";
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
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Usuarios <i class="fa fa-caret-right"></i> Nuevo usuario
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Registrando nuevo usuario</strong>
							</div>
						</div>
						<div class="widget-content">
	                        <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                            <label>Nombre: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                            <input type="text" name="nombres" />
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                            <label>Email: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                            <input type="email" name="email" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Usuario: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                            <input type="text" name="usuario" />
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Clave: *</label>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-10 col-xs-12">
                                        	<input type="password" name="clave" />
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>&iquest;Visitante?:</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<div class="custom-input">
												<input type="radio" name="visitante" id="no" value="No" checked><label for="no">No</label>
												<input type="radio" name="visitante" id="si" value="Si"><label for="si">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        	<div class="custom-input">
	                                        	<input type="radio" name="estado" id="activo" value="Activo" checked="checked"><label for="activo">Activo</label>
                  								<input type="radio" name="estado" id="inactivo" value="Inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="usuarios.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Usuario</button>
											</div>
							                <input type="hidden" name="proceso">
                                        </div>
                                    </div>
								</div>
							</form>
                            <label><span>Los campos con ( <strong>*</strong> ) son obligatorios.</span></label>
						</div>
                    </div>
				</div>
			</div> <!-- /wrp -->
		</div> <!-- /content -->
		<?php include("includes/footer.php") ?>
	</div> <!-- /wrapper -->
</body>
</html>