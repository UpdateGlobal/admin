<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<?php
$cod_cliente		= $_REQUEST['cod_cliente'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
	$chk 		= $_POST['chk'];
} else {
	$proceso 	= "";
	$chk 		= "";
}
if($proceso == ""){
	$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
	$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaCli = mysqli_fetch_array($ejecutarClientes);
	$cod_cliente		= $filaCli['cod_cliente'];
	$nombres 			= $filaCli['nombres'];
	$direccion			= htmlspecialchars($filaCli['direccion']);
	$telefono			= htmlspecialchars($filaCli['telefono']);
	$empresa 			= htmlspecialchars($filaCli['empresa']);
	$fecha_nacimiento 	= $filaCli['fecha_nacimiento'];
	$sexo				= $filaCli['sexo'];
}

if($proceso=="Actualizar"){	
	$cod_cliente		= $_POST['cod_cliente'];
	$direccion			= mysqli_real_escape_string($enlaces, $_POST['direccion']);
	$telefono			= mysqli_real_escape_string($enlaces, $_POST['telefono']);
	$empresa			= mysqli_real_escape_string($enlaces,$_POST['empresa']);
	$actualizarClientes	= "UPDATE clientes SET cod_cliente='$cod_cliente', direccion='$direccion', telefono='$telefono', empresa='$empresa' WHERE cod_cliente='$cod_cliente'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
	
	if($chk=="s") {	
		$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
		$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
		$filaCli = mysqli_fetch_array($ejecutarClientes);
		$cod_cliente		= $filaCli['cod_cliente'];
		$nombres 			= $filaCli['nombres'];
		$direccion			= htmlspecialchars($filaCli['direccion']);
		$telefono			= htmlspecialchars($filaCli['telefono']);
		$email 				= $filaCli['email'];
		$clave				= $filaCli['clave'];
		$empresa 			= htmlspecialchars($filaCli['empresa']);
		$fecha_nacimiento 	= $filaCli['fecha_nacimiento'];
		$sexo				= $filaCli['sexo'];
	
		$consultarCot = 'SELECT * FROM contacto';
		$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaCot = mysqli_fetch_array($resultadoCot)){
			$xDesemail = $filaCot['form_mail'];
		}
		$emailDestino = $email;
		$encabezado = "Perfil Actualizado - Tienda virtual";
		$mensaje .= "
			<p>Cambio de datos realizado, acceda en: <a href='#'>Enlace</a></p>		
			<h3>Nuevos Datos de Perfil</h3>
			<table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
				<tr>
					<td width='25%'><strong>Nombre : </strong></th>
					<td width='75%'>".$nombres."<br></th>
				</tr>
				<tr>
					<td><strong>Direcci&oacute;n : </strong></th>
					<td>".$direccion."<br></th>
				</tr>
				<tr>
					<td><strong>Tel&eacute;fono : </strong></th>
					<td>".$telefono."<br></th>
				</tr>
				<tr>
					<td><strong>Empresa : </strong></th>
					<td>".$empresa."<br></th>
				</tr>
				<tr>
					<td><strong>Fecha de nacimiento : </strong></th>
					<td>".$fecha_nacimiento."<br></th>
				</tr>
				<tr>
					<td><strong>Sexo : </strong></th>
					<td>".$sexo."<br></th>
				</tr>
			</table>
			<br>
			<h4>Informaci&oacute;n de la Cuenta</h4>
			<table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
				<tr>
					<td width='25%'><strong>Email : </strong></th>
					<td width='75%'>".$email."</th>
				</tr>
				<tr>
					<td><strong>Clave : </strong></th>
					<td>".$clave."</th>
				</tr>
			</table>
			<p>Cualquier duda contacte a soporte: ".$xDesemail."</p>";
		$mailcabecera = 'MIME-Version: 1.0'."\r\n";
		$mailcabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
		$mailcabecera.= "Desde: ".$xDesemail;
		$mailcabecera.= "<".$xDesemail.">\r\n";
		$mailCabecera.= "Responder a: ".$xDesemail;
		$mensajeEmail = $mensaje;
		mail($emailDestino,$encabezado,$mensajeEmail,$mailcabecera);
	}
	header("Location:perfil.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function Validar(){
			if(document.perfil.direccion.value==""){
				alert("Debe escribir su dirección");
				document.perfil.direccion.focus();
				return;	
			}
			if(document.perfil.telefono.value==""){
				alert("Ingrese su telefono");
				document.perfil.telefono.focus();
				return;	
			}
			document.perfil.action = "perfil-editar.php";
			document.perfil.proceso.value="Actualizar";
			document.perfil.submit();
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
                <h1 class="page-header">Perfil</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
					<li class="active"><strong>Perfil Editar</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Editar Datos de Perfil</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="ingreso-cliente">
                    <form name="perfil" method="post" action="">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label><strong>Nombres: </strong></label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<?php echo $nombres; ?>
								<div class="clearfix" style="height:15px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label><strong>Direcci&oacute;n: *</strong></label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="direccion" value="<?php echo $direccion; ?>">
								<div class="clearfix" style="height:10px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label><strong>Tel&eacute;fono: *</strong></label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="tel" name="telefono" value="<?php echo $telefono; ?>">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label><strong>Empresa: </strong></label></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="empresa" value="<?php echo $empresa; ?>">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label><strong>Fecha Nacimiento: </strong></label></div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<?php echo $fecha_nacimiento; ?>
								<div class="clearfix" style="height:15px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label><strong>Sexo: </strong></label></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <?php echo $sexo; ?>
								<div class="clearfix" style="height:20px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<input name="chk" type="checkbox" value="s"> <label>Enviar cambios al correo electr&oacute;nico</label>
								<div class="clearfix" style="height:20px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <p class="linea">
									<a href="perfil.php" class="btn btn-default">&laquo; Volver</a>
                                    <input type="button" value="Cambiar Datos" class="btn btn-primary" onClick="javascript:Validar();">
                                </p>
                            </div>
                            <input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente; ?>">
                            <input type="hidden" name="proceso">
                        </div>
					</form>
                </div>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>