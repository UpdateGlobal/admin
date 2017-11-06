<?php include("modulos/conexion.php"); ?>
<?php include("modulos/verificar.php"); ?>
<?php
$cod_contenido	= $_REQUEST['cod_contenido'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso==""){
	$consultaCon = "SELECT * FROM contenidos WHERE cod_contenido='$cod_contenido'";
	$ejecutarCon = mysqli_query($enlaces,$consultaCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaCon = mysqli_fetch_array($ejecutarCon);
	$cod_contenido		= $filaCon['cod_contenido'];
	$titulo_contenido	= htmlspecialchars(utf8_encode($filaCon['titulo_contenido']));
	$img_contenido		= $filaCon['img_contenido'];
	$contenido			= htmlspecialchars(utf8_encode($filaCon['contenido']));
	$estado				= $filaCon['estado'];
}

if($proceso == "Actualizar"){
	$cod_contenido		= $_POST['cod_contenido'];
	$titulo_contenido	= mysqli_real_escape_string($enlaces, utf8_decode($_POST['titulo_contenido']));
	$img_contenido		= $_POST['img_contenido'];
	$contenido			= mysqli_real_escape_string($enlaces, utf8_decode($_POST['contenido']));
	$estado				= $_POST['estado'];

	$ActualizarCon = "UPDATE contenidos SET cod_contenido='$cod_contenido', titulo_contenido='$titulo_contenido', img_contenido='$img_contenido', contenido='$contenido', estado='$estado' WHERE cod_contenido='$cod_contenido'";
	$resultadoActualizar = mysqli_query($enlaces,$ActualizarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
	header("Location:nosotros.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
    <script src="js-editor/ckeditor.js" type="text/javascript"></script>
    <script>
		function Validar(){
			if(document.fcms.titulo_contenido.value==""){
				alert("Debe escribir un título");
				document.fcms.titulo_contenido.focus();
				return;	
			}
			
			document.fcms.action = "nosotros-edit.php";
			document.fcms.proceso.value="Actualizar";
			document.fcms.submit();
		}
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
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
        <?php include("includes/header.php"); ?>
		<div id="content" class="clearfix">
			<div class="header">
				<h1 class="page-title">P&aacute;gina de Nosotros</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Nosotros <i class="fa fa-caret-right"></i> Editar Contenidos
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar <?php if ($cod_contenido ==1){?>Descripci&oacute;n<?php } ?><?php if ($cod_contenido ==2){?>Misi&oacute;n<?php } ?><?php if ($cod_contenido ==3){?>Visi&oacute;n<?php } ?><?php if ($cod_contenido ==4){?>Objetivos<?php } ?></strong>
							</div>
						</div>
						<div class="widget-content">
                        	<form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>T&iacute;tulo: *</label>
                                        </div>		
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="titulo_contenido" value="<?php echo $titulo_contenido; ?>" />
                                        </div>
                                   	</div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Descripci&oacute;n:</label>
                                        </div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="contenido" id="contenido"><?php echo $contenido; ?></textarea>
 											<script>
												CKEDITOR.replace('contenido');
											</script>
                                        </div>
                                    </div>
                                    <div style="height:20px;"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Imagen:<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $img_contenido; ?></p><?php } ?>
                                            <input name="img_contenido" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" value="<?php echo $img_contenido; ?>" />
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                                        <?php if($xVisitante=="No"){ ?>
                                            <button class="btn btn-red" type="button" name="boton4" onClick="javascript:Imagen('NOS');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
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
                                            	<a href="nosotros.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Metatags</button>
                                                <input type="hidden" name="proceso">
	            			    				<input type="hidden" name="cod_contenido" value="<?php echo $cod_contenido; ?>">
											</div>
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