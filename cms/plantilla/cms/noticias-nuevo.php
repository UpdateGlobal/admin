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
	$titulo				= mysqli_real_escape_string($enlaces, $_POST['titulo']);
	$imagen				= $_POST['imagen'];
	$noticia			= mysqli_real_escape_string($enlaces, $_POST['noticia']);
	$fecha				= $_POST['fecha'];
	$estado				= $_POST['estado'];
		
	$insertarNoticia = "INSERT INTO noticias(titulo, imagen, noticia, fecha, estado)VALUE('$titulo', '$imagen', '$noticia', '$fecha', '$estado')";
	$resultadoInsertar = mysqli_query($enlaces,$insertarNoticia);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> El noticia se registr&oacute; con exitosamente. <a href='noticias.php'>Ir a noticias</a></p>
                </div>";
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
			if(document.fcms.titulo.value==""){
				alert("Debe escribir un título");
				document.fcms.titulo.focus();
				return;	
			}
			document.fcms.action = "noticias-nuevo.php";
			document.fcms.proceso.value="Registrar";
			document.fcms.submit();
		}	
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
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
				<h1 class="page-title">Noticias</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Noticias <i class="fa fa-caret-right"></i> Publicar Noticia
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Publicar Noticia</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>T&iacute;tulo: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" id="titulo" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Imagen: <br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="imagen" type="text" id="imagen" />
                                        </div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('NOT');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Noticia:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="noticia" id="noticia"></textarea>
 											<script>
												CKEDITOR.replace('noticia');
											</script>
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
                                            	<a href="noticias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar noticia</button>
											</div>
                                            <?php
												$fecha = date("Y-m-d");
											?>
			            			        <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
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