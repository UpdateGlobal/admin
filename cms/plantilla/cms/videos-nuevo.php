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
	$descripcion		= mysqli_real_escape_string($enlaces, $_POST['descripcion']);
	$imagen				= $_POST['imagen'];
	$video				= mysqli_real_escape_string($enlaces, $_POST['video']);
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
		
	$insertarVideo = "INSERT INTO videos(titulo, descripcion, imagen, video, orden, estado)VALUE('$titulo', '$descripcion', '$imagen', '$video', '$orden', '$estado')";
	$resultadoInsertar = mysqli_query($enlaces,$insertarVideo);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> El video se registr&oacute; con exitosamente. <a href='videos.php'>Ir a videos</a></p>
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
			if(document.fcms.imagen.value==""){
				alert("Debe subir una imagen para la miniatura del vídeo");
				document.fcms.imagen.focus();
				return;	
			}
			if(document.fcms.video.value==""){
				alert("Debe escribir un enlace para el vídeo");
				document.fcms.video.focus();
				return;
			}
			if(document.fcms.orden.value==""){
				alert("Debe asignar un orden");
				document.fcms.video.focus();
				return;
			}
			document.fcms.action = "videos-nuevo.php";
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
				<h1 class="page-title">Galer&iacute;as</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> V&iacute;deos <i class="fa fa-caret-right"></i> Publicar V&iacute;deo
			</div>
			<div class="wrp clearfix">
            	<?php $page = "videos"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Publicar V&iacute;deo</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label> *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" id="titulo" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="descripcion" id="descripcion"></textarea>
 											<script>
												CKEDITOR.replace('descripcion');
											</script>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                            <input name="imagen" type="text" id="imagen" />
                                        </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IV');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label><strong>Video (enlace): *</strong></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="video" type="text" id="video" />
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
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
                                            	<a href="videos.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar video</button>
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