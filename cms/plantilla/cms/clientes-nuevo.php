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
	$nombres			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['nombres']));
	$direccion			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['direccion']));
	$telefono			= $_POST['telefono'];
	$email				= mysqli_real_escape_string($enlaces, $_POST['email']);
	$clave				= $_POST['clave'];
	$empresa			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['empresa']));
	$fecha				= $_POST['fecha_nacimiento'];
	$sexo				= $_POST['sexo'];
	$estado				= $_POST['estado'];
		
	$validarClientes = "SELECT * FROM clientes WHERE email='$email'";
	$ejecutarValidar = mysqli_query($enlaces,$validarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$numreg = mysqli_num_rows($ejecutarValidar);
	
	if($numreg==0){
		$insertarClientes = "INSERT INTO clientes(nombres, direccion, telefono, email, clave, empresa, fecha_nacimiento, sexo, estado)VALUE('$nombres', '$direccion', '$telefono', '$email', '$clave', '$empresa', '$fecha', '$sexo', '$estado')";
		$resultadoInsertar = mysqli_query($enlaces,$insertarClientes);
		$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> El clientes se registr&oacute; con exitosamente. <a href='clientes.php'>Ir a Clientes</a></p>
                </div>";
	}else{
		$mensaje = "<div class='alert alert-warning' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> Ops, el Cliente ya existe...</p>
                	</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
    <script src="js-editor/ckeditor.js" type="text/javascript"></script>
	<script>
		function Validar(){
			if(document.fcms.nombres.value==""){
				alert("Debe escribir un nombre");
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
			if(document.fcms.clave.value==""){
				alert("Ingrese una clave");
				document.fcms.clave.focus();
				return;	
			}
			document.fcms.action = "clientes-nuevo.php";
			document.fcms.proceso.value="Registrar";
			document.fcms.submit();
		}
		function soloNumeros(e){ 
			var key = window.Event ? e.which : e.keyCode 
			return ((key >= 48 && key <= 57) || (key==8)) 
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
				<h1 class="page-title">Clientes</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-users"></i> Clientes <i class="fa fa-caret-right"></i> Registrar Cliente
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Registrar Cliente</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Nombres: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="nombres" type="text" id="nombres" />
                                        </div>
                                    </div>
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Direcci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="direccion" type="text" id="direccion" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Tel&eacute;fono:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="telefono" type="text" id="telefono" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Email: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="email" type="text" id="email" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Clave: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="clave" type="password" id="clave" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Empresa:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="empresa" type="text" id="empresa" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Fecha de Nacimiento:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="fecha_nacimiento" type="date" id="fecha_nacimiento" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Sexo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="custom-input">
	                                        	<input type="radio" name="sexo" id="masculino" value="Masculino" checked="checked"><label for="masculino">Masculino</label>
                  								<input type="radio" name="sexo" id="femenino" value="Femenino"><label for="femenino">Femenino</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
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
                                            	<a href="clientes.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Cliente</button>
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
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>