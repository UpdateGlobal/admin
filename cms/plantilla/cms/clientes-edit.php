<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_cliente	= $_REQUEST['cod_cliente'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
	$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaCli = mysqli_fetch_array($ejecutarClientes);
	$cod_cliente		= $filaCli['cod_cliente'];
	$nombres 			= htmlspecialchars(utf8_encode($filaCli['nombres']));
	$direccion			= htmlspecialchars(utf8_encode($filaCli['direccion']));
	$telefono			= $filaCli['telefono'];
	$email				= $filaCli['email'];
	$clave 				= $filaCli['clave'];
	$empresa 			= htmlspecialchars(utf8_encode($filaCli['empresa']));
	$fecha_nacimiento 	= $filaCli['fecha_nacimiento'];
	$sexo				= $filaCli['sexo'];
	$estado				= $filaCli['estado'];
}

if($proceso=="Actualizar"){	
	$cod_cliente		= $_POST['cod_cliente'];
	$nombres			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['nombres']));
	$direccion			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['direccion']));
	$telefono			= $_POST['telefono'];
	$email				= $_POST['email'];
	$clave				= $_POST['clave'];
	$empresa			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['empresa']));
	$fecha_nacimiento	= $_POST['fecha_nacimiento'];
	$sexo				= $_POST['sexo'];
	$estado				= $_POST['estado'];
	$actualizarClientes	= "UPDATE clientes SET cod_cliente='$cod_cliente', nombres='$nombres', direccion='$direccion', telefono='$telefono', email='$email', clave='$clave', empresa='$empresa', fecha_nacimiento='$fecha_nacimiento', sexo='$sexo', estado='$estado' WHERE cod_cliente='$cod_cliente'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location:clientes.php");
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
			document.fcms.action = "clientes-edit.php";
			document.fcms.proceso.value="Actualizar";
			document.fcms.submit();
		}	
		function soloNumeros(e) 
		{ 
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
				<h1 class="page-title">Página de Inicio</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> clientes <i class="fa fa-caret-right"></i> Editar cliente
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar cliente</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Nombres: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="nombres" type="text" id="nombres" value="<?php echo $nombres; ?>" />
                                        </div>
                                    </div>
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Direcci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="direccion" type="text" id="direccion" value="<?php echo $direccion; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Tel&eacute;fono:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="telefono" type="text" id="telefono" value="<?php echo $telefono; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Email: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<p><?php echo $email; ?></p>
                                        	<input name="email" type="hidden" id="email" value="<?php echo $email; ?>" />
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Clave: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="clave" type="password" id="clave" value="<?php echo $clave; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Empresa:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="empresa" type="text" id="empresa" value="<?php echo $empresa; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Fecha de Nacimiento:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="fecha_nacimiento" type="date" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Sexo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="custom-input">
												<input <?php if (!(strcmp($sexo,"Masculino"))) {echo "checked=\"checked\"";} ?> type="radio" name="sexo" id="masculino" value="Masculino" checked="checked"><label for="masculino">Masculino</label>
												<input <?php if (!(strcmp($sexo,"Femenino"))) {echo "checked=\"checked\"";} ?> type="radio" name="sexo" id="femenino" value="Femenino"><label for="femenino">Femenino</label>
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
												<input <?php if (!(strcmp($estado,"Activo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" id="activo" value="Activo" checked="checked"><label for="activo">Activo</label>
												<input <?php if (!(strcmp($estado,"Inactivo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" id="inactivo" value="Inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="clientes.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar cliente</button>
											</div>
							                <input type="hidden" name="proceso">
							                <input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente; ?>">
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