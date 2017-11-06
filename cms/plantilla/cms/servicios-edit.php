<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_servicio		= $_REQUEST['cod_servicio'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaServicios = "SELECT * FROM servicios WHERE cod_servicio='$cod_servicio'";
	$ejecutarServicios = mysqli_query($enlaces,$consultaServicios) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaSer = mysqli_fetch_array($ejecutarServicios);
	$cod_servicio = $filaSer['cod_servicio'];
	$imagen 		= $filaSer['imagen'];
	$titulo			= htmlspecialchars($filaSer['titulo']);
	$descripcion	= htmlspecialchars($filaSer['descripcion']);
	$orden 			= $filaSer['orden'];
	$estado 		= $filaSer['estado'];
}
if($proceso=="Actualizar"){	
	$cod_servicio			= $_POST['cod_servicio'];
	$imagen					= $_POST['imagen'];
	$titulo					= mysqli_real_escape_string($enlaces, $_POST['titulo']);
	$descripcion			= mysqli_real_escape_string($enlaces, $_POST['descripcion']);
	$orden					= $_POST['orden'];
	$estado					= $_POST['estado'];
	$actualizarServicios	= "UPDATE servicios SET cod_servicio='$cod_servicio', imagen='$imagen', titulo='$titulo', descripcion='$descripcion', orden='$orden', estado='$estado' WHERE cod_servicio='$cod_servicio'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarServicios) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location:servicios.php");
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
				alert("Debe subir una imagen");
				document.fcms.titulo.focus();
				return;
			}
			if(document.fcms.orden.value==""){
				alert("Debe asignar un orden");
				document.fcms.orden.focus();
				return;	
			}
			document.fcms.action = "servicios-edit.php";
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
				<h1 class="page-title">Servicios</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-bars"></i> Servicios <i class="fa fa-caret-right"></i> Editar Servicio
			</div>
			<div class="wrp clearfix">
	            <?php $page = "servicios"; include("includes/menu-servicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Servicio</strong>
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
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                            <input name="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" size="30" value="<?php echo $imagen; ?>" />
                                        </div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<?php if($xVisitante=="No"){ ?><button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('SER');" /><i class="fa fa-save"></i> Examinar</button><?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
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
                                            	<a href="servicios.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar servicio</button>
											</div>
							                <input type="hidden" name="proceso">
							                <input type="hidden" name="cod_servicio" value="<?php echo $cod_servicio; ?>">
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