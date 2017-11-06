<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_banner		= $_REQUEST['cod_banner'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaBanner = "SELECT * FROM banners WHERE cod_banner='$cod_banner'";
	$ejecutarBanner = mysqli_query($enlaces,$consultaBanner) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaBan = mysqli_fetch_array($ejecutarBanner);
	$cod_banner = $filaBan['cod_banner'];
	$imagen = $filaBan['imagen'];
	$titulo	= htmlspecialchars($filaBan['titulo']);
	$texto	= htmlspecialchars($filaBan['texto']);
	$orden	= $filaBan['orden'];
	$estado = $filaBan['estado'];
}
if($proceso=="Actualizar"){	
	$cod_banner			= $_POST['cod_banner'];
	$imagen				= $_POST['imagen'];
	$titulo				= mysqli_real_escape_string($enlaces, $_POST['titulo']);
	$texto				= mysqli_real_escape_string($enlaces, $_POST['texto']);
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	$actualizarBanner	= "UPDATE banners SET cod_banner='$cod_banner', imagen='$imagen', titulo='$titulo', texto='$texto', orden='$orden', estado='$estado' WHERE cod_banner='$cod_banner'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarBanner) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location:banners.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
	<script>
		function Validar(){
			if(document.fcms.imagen.value==""){
				alert("Debe subir una imagen");
				return;	
			}
			if(document.fcms.orden.value==""){
				alert("Debes especificar un número de orden");
				document.fcms.orden.focus();
				return;	
			}
			
			document.fcms.action = "banner-edit.php";
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
    <script src="js/visitante-alert.js"></script>
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
        <?php $menu = "inicio"; $page = "banners"; include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">Página de Inicio</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Banners <i class="fa fa-caret-right"></i> Editar Banner
			</div>
			<div class="wrp clearfix">
            	<?php $page = "banners"; include("includes/menu-inicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Banner</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Imagen: *<br><span>(1800px x 500px)</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                            <input name="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" size="30" value="<?php echo $imagen; ?>" />
                                        </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                                        <?php if($xVisitante=="No"){ ?><button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('BAN');" /><i class="fa fa-save"></i> Examinar</button><?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>T&iacute;tulo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" id="titulo" value="<?php echo $titulo; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <label>Texto:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="texto" id="texto"><?php echo $texto; ?></textarea>
 											<script>
												CKEDITOR.replace('texto');
											</script>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
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
                                            	<a href="banners.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Banner</button>
											</div>
							                <input type="hidden" name="proceso">
							                <input type="hidden" name="cod_banner" value="<?php echo $cod_banner; ?>">
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