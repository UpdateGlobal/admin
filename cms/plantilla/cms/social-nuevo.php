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
	$type				= $_POST['type'];
	$links				= mysqli_real_escape_string($enlaces, $_POST['links']);
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	$insertarBanner		= "INSERT INTO social (type, links, orden, estado)VALUE('$type', '$links', '$orden', '$estado')";
	$resultadoInsertar	= mysqli_query($enlaces,$insertarBanner);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> El enlace se registr&oacute; con exitosamente. <a href='social.php'>Ir a Redes Sociales</a></p>
				</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
	<script>
		function Validar(){
			if(document.fcms.links.value==""){
				alert("Debe colocar el enlace de su cuenta");
				document.fcms.links.focus();
				return;	
			}
			if(document.fcms.orden.value==""){
				alert("Debes especificar un número de orden");
				document.fcms.orden.focus();
				return;	
			}
			document.fcms.action = "social-nuevo.php";
			document.fcms.proceso.value="Registrar";
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
				<h1 class="page-title">Redes Sociales</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Redes Sociales <i class="fa fa-caret-right"></i> A&ntilde;adir Red Social
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir Red Social</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Bot&oacute;n de Red Social:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="dropdown">
                                                <select name="type" id="type" class="dropdown-select">
													<option value="fa-facebook-square">Facebook</option>
                                                    <option value="fa-twitter-square">Twitter</option>
                                                    <option value="fa-google-plus-official">Google+</option>
                                                    <option value="fa-linkedin">Linkedin</option>
                                                    <option value="fa-behance">Behance</option>
                                                    <option value="fa-blogger">Blogger</option>
                                                    <option value="fa-youtube-play">Youtube</option>
                                                    <option value="fa-vimeo">Vimeo</option>
                                                    <option value="fa-wordpress">Wordpress</option>
                                                    <option value="fa-tumblr-square">Tumblr</option>
                                                    <option value="fa-pinterest">Pinterest</option>
                                                    <option value="fa-instagram">Instagram</option>
                                                    <option value="fa-flickr">Flickr</option>
                                                    <option value="fa-github">Github</option>
                                                </select>
											</div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Enlace: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="links" type="text" id="links" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                                            <input name="orden" type="text" id="orden" onKeyPress="return soloNumeros(event)" />
                                        </div>
                                    </div>
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
                                            	<a href="social.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Red Social</button>
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