<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<?php
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
$resultado = 1;
if($proceso=="Registrar"){
	$nombres			= $_POST['nombres'];
	$direccion			= $_POST['direccion'];
	$telefono			= $_POST['telefono'];
	$email				= $_POST['email'];
	$clave				= $_POST['clave'];
	$empresa			= $_POST['empresa'];
	$fecha_nacimiento	= $_POST['fecha_nacimiento'];
	$sexo				= $_POST['sexo'];
	$estado				= $_POST['estado'];

	/*-- Validar cliente para que no se repita ---*/
	$verificar = "SELECT * FROM clientes WHERE email='$email'";
	$ejecutar = mysqli_query($enlaces, $verificar);
	$numcli = mysqli_num_rows($ejecutar);
	if($numcli==0){
	
		/*---- Mensaje para el correo electronico ----*/
		$emailDestino = $email;
		$encabezado = "Bienvenido - Tienda Virtual";
		$encabezada = "Nuevo Usuario Registrado";
		$mensaje = "
			<p>Acceda en: <a href='http://raulmartiarena.com/practicas/ingreso.php'>Enlace</a></p>
		
			<h3>Informaci&oacute;n de la Cuenta</h3>
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
			<br>
			<h3>Datos de Perfil</h3>
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
			</table>";
			
			/*----- Codigo enviar pedidos al correo ---*/

		$consultarCot = 'SELECT * FROM contacto';
		$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaCot = mysqli_fetch_array($resultadoCot)){
			$xFormemail		= $filaCot['form_mail'];
		}
		$destino = $xFormemail;
		$mailCabecera = 'MIME-Version: 1.0'."\r\n";
		$mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
		$mailCabecera.= "FROM: ".$xFormemail;
		$mailCabecera.= "<".$xFormemail.">\r\n";
		$mailCabecera.= "Reply-To: ".$xFormemail;
		$mensajeEmail = $mensaje;
		mail($emailDestino,$encabezado,$mensajeEmail,$mailCabecera);
		
		mail($destino,$encabezada,$mensajeEmail,$mailCabecera);
		
		$insertar="INSERT INTO clientes(nombres, direccion, telefono, email, clave, empresa, fecha_nacimiento, sexo, estado) VALUE('$nombres', '$direccion', '$telefono', '$email', '$clave', '$empresa', '$fecha_nacimiento', '$sexo', '$estado')";
		$resultado = mysqli_query($enlaces, $insertar);
		$resultado = 0;
	}else{
		$advertencia = "¡ Cliente registrado ya existe !";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function Validar(){
			document.ftienda.action="registrar.php";
			if(document.ftienda.nombres.value==""){
				alert("Debes llenar tu nombre");
				document.ftienda.nombres.focus();
				return;
			}
			if(document.ftienda.direccion.value==""){
				alert("Debes llenar tu direccion");
				document.ftienda.direccion.focus();
				return;
			}
			if(document.ftienda.telefono.value==""){
				alert("Debes llenar tu teléfono");
				document.ftienda.telefono.focus();
				return;
			}
			if(document.ftienda.email.value==""){
				alert("Debes llenar tu email");
				document.ftienda.email.focus();
				return;
			}
			if(document.ftienda.clave.value==""){
				alert("Debes llenar su clave");
				document.ftienda.clave.focus();
				return;
			}
			document.ftienda.proceso.value="Registrar";
			document.ftienda.submit();
		}	
		function soloNumeros(e) 
		{ 
			var key = window.Event ? e.which : e.keyCode 
			return ((key >= 48 && key <= 57) || (key==8)) 
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
                <h1 class="page-header">Registrarse como cliente nuevo</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Reg&iacute;strese</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Formulario de Registro</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="ingreso-cliente">
					<?php 
						if($resultado==1){
					?>
                    <form name="ftienda" method="post" action="">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label>Nombres: *</label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="nombres">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label>Direcci&oacute;n: *</label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="direccion">
								<div class="clearfix" style="height:10px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label>Tel&eacute;fono: *</label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="telefono" onKeyPress="return soloNumeros(event)">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label>E-mail: *</label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="email" name="email">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<label>Clave: *</label>
							</div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="password" name="clave">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label>Empresa: </label></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            	<input class="form-control" type="text" name="empresa">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label>Fecha Nacimiento: </label></div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            	<input class="form-control" type="date" name="fecha_nacimiento">
								<div class="clearfix" style="height:10px;"></div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><label>Sexo</label></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="radio" name="sexo" value="Masculino" checked> Masculino
                                <input type="radio" name="sexo" value="Femenino"> Femenino
								<div class="clearfix" style="height:10px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <p class="linea">
                                    <input type="button" value="Registrarse" class="btn btn-primary" onClick="javascript:Validar();">
                                </p>
                            </div>
                            <input type="hidden" name="estado" value="Activo">
                            <input type="hidden" name="proceso">
                        </div>
					</form>
                    <?php 
						}else{
					?>
                    	<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<p>Gracias por registrarse como cliente a partir de estos momentos Ud. puede hacer uso del sistema de carrito de compras y el sistema de pedidos en l&iacute;nea. Puede a&ntilde;adir productos. Eliminar Productos, Actualizar datos y cantidades y hacer su pedido en l&iacute;nea a su vez tambi&eacute;n realizar compras.</p>
	                            <p>Atentamente<br>Dtpo. Ventas</p>
								<p><a href="ingreso.php" class="btn btn-default">INGRESAR</a></p>
							</div>
						</div>
                    <?php 
					}
					?>
                </div>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>