<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_video		= $_REQUEST['cod_video'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaVideos = "SELECT * FROM videos WHERE cod_video='$cod_video'";
	$ejecutarVideos = mysqli_query($enlaces,$consultaVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaVid 		= mysqli_fetch_array($ejecutarVideos);
	$cod_video 		= $filaVid['cod_video'];
	$titulo			= htmlspecialchars($filaVid['titulo']);
	$descripcion	= htmlspecialchars($filaVid['descripcion']);
	$imagen 		= $filaVid['imagen'];
	$video			= $filaVid['video'];
	$orden			= $filaVid['orden'];
	$estado 		= $filaVid['estado'];
}

if($proceso=="Actualizar"){	
	$cod_video			= $_POST['cod_video'];
	$titulo				= mysqli_real_escape_string($enlaces, $_POST['titulo']);
	$descripcion		= mysqli_real_escape_string($enlaces, $_POST['descripcion']);
	$imagen				= $_POST['imagen'];
	$video				= $_POST['video'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	$actualizarVideos	= "UPDATE videos SET cod_video='$cod_video', titulo='$titulo', descripcion='$descripcion', imagen='$imagen', video='$video', orden='$orden', estado='$estado' WHERE cod_video='$cod_video'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location:videos.php");
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
			document.fcms.action = "videos-edit.php";
			document.fcms.proceso.value="Actualizar";
			document.fcms.submit();
		}	
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
		}
		function soloNumeros(e) 
		{ 
			var key = window.Event ? e.which : e.keyCode 
			return ((key >= 48 && key <= 57) || (key==8)) 
		}
	</script>
	<link href="jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
	<link href="jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
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
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> V&iacute;deos <i class="fa fa-caret-right"></i> Editar V&iacute;deo
			</div>
			<div class="wrp clearfix">
            	<?php $page = "videos"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar V&iacute;deo</strong>
							</div>
						</div> <!-- /widget-header -->
                        
						<div class="widget-content">
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>T&iacute;tulo: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" id="titulo" value="<?php echo $titulo; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){?><p><?php echo $imagen; ?></p><?php } ?>
                                            <input name="imagen" type="<?php if($xVisitante=="Si"){?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" size="30" value="<?php echo $imagen; ?>" />
                                        </div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<?php if($xVisitante=="No"){?>
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IV');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-15"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Descripci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
 											<script>
												CKEDITOR.replace('descripcion');
											</script>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label><strong>Video (enlace): *</strong></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php if($xVisitante=="Si"){?><p><?php echo $video; ?></p><?php } ?>
                                            <input name="video" type="<?php if($xVisitante=="Si"){?>hidden<?php }else{ ?>text<?php } ?>" id="video" value="<?php echo $video; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
	                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Vista previa del v&iacute;deo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<a class="jackbox" data-group="video" href="<?php echo $video; ?>">
												<i class="fa fa-play-circle" aria-hidden="true"></i> Reproducir
											</a>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                            <input name="orden" type="text" id="orden" value="<?php echo $orden; ?>" onKeyPress="return soloNumeros(event)" />
                                        </div>
                                    </div>
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
                                            	<a href="videos.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar video</button>
											</div>
							                <input type="hidden" name="proceso">
							                <input type="hidden" name="cod_video" value="<?php echo $cod_video; ?>">
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
		<script type="text/javascript" src="jackbox/js/libs/jquery.address-1.5.min.js"></script>
		<script type="text/javascript" src="jackbox/js/libs/Jacked.js"></script>
		<script type="text/javascript" src="jackbox/js/jackbox-swipe.js"></script>
		<script type="text/javascript" src="jackbox/js/jackbox.js"></script>
		<script type="text/javascript" src="jackbox/js/libs/StackBlur.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
//				jQuery(".jackbox[data-group]").jackBox("init");
				jQuery(".jackbox[data-group]").jackBox("init", {
					deepLinking: false,
					showInfoByDefault: false,       // show item info automatically when content loads, true/false
					preloadGraphics: true,          // preload the jackbox graphics for a faster jackbox
					fullscreenScalesContent: false,  // choose to always scale content up in fullscreen mode, true/false
 
					autoPlayVideo: false,           // video autoplay default, this can also be set per video in the data-attributes, true/false
					flashVideoFirst: false,         // choose which technology has first priority for video, HTML5 or Flash, true/false
     
					useThumbs: false,                // choose to use thumbnails, true/false
					thumbsStartHidden: false,       // choose to initially hide the thumbnail strip, true/false
					useThumbTooltips: false
				});
			});
		</script>
	</div> <!-- /wrapper -->
</body>
</html>