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
	$xCodigo = $filaCot['cod_contact'];
	$xCartem = $filaCot['cart_mail'];
}

if($proceso == "Actualizar"){
	$cod_contact	= $_POST['cod_contact'];
	$cartem			= $_POST['cart_mail'];

	$ActualizarContact = "UPDATE contacto SET cod_contact='$cod_contact', cart_mail='$cartem' WHERE cod_contact='$cod_contact'";
	$resultadoActualizar = mysqli_query($enlaces,$ActualizarContact);
	header("Location:pedidos.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <script>
		function Validar(){
			if(document.fcms.cart_mail.value==""){
				alert("¡El correo para los pedidos es obligatorio!");
				document.fcms.cart_mail.focus();
				return;
			}
			if (document.fcms.cart_mail.value.indexOf('@') == -1){
				alert ("La \"dirección de email\" no es correcta");
				document.fcms.cart_mail.focus();
				return;
			}
			document.fcms.action = "pedidos-correo.php";
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
        <?php include("includes/header.php"); ?>
		<div id="content" class="clearfix">
			<div class="header">
				<h1 class="page-title">Productos</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-barcode"></i> Productos <i class="fa fa-caret-right"></i> Pedidos <i class="fa fa-caret-right"></i> Editar Correo para Pedidos
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Correo para Pedidos</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Correo que recibe los pedidos: *</label>
                                        </div>
                                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="cart_mail" value="<?php echo $xCartem; ?>" />
                                        </div>
                                    </div>                                    
                                    <div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="btn-group">
                                            	<a href="pedidos.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Actualizar Correo de Pedidos</button>
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