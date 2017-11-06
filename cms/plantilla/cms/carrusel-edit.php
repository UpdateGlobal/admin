<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_carrusel	= $_REQUEST['cod_carrusel'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaCarrusel = "SELECT * FROM carrusel WHERE cod_carrusel='$cod_carrusel'";
	$ejecutarCarrusel = mysqli_query($enlaces,$consultaCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaCar = mysqli_fetch_array($ejecutarCarrusel);
	$cod_carrusel = $filaCar['cod_carrusel'];
	$imagen = $filaCar['imagen'];
	$orden	 = $filaCar['orden'];
	$estado = $filaCar['estado'];
}
if($proceso=="Actualizar"){	
	$cod_carrusel		= $_POST['cod_carrusel'];
	$imagen				= $_POST['imagen'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	$actualizarCarrusel	= "UPDATE carrusel SET cod_carrusel='$cod_carrusel', imagen='$imagen', orden='$orden', estado='$estado' WHERE cod_carrusel='$cod_carrusel'";
	$resultadoActualizar = mysqli_query($enlaces,$actualizarCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
	
	header("Location:carrusel.php");
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
			document.fcms.action = "carrusel-edit.php";
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
        <?php include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">Página de Inicio</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Carrusel <i class="fa fa-caret-right"></i> Editar Carrusel
			</div>
			<div class="wrp clearfix">
            	<?php $page="carrusel"; include("includes/menu-inicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Carrusel</strong>
							</div>
						</div>
						<div class="widget-content">
                            <form class="fcms" name="fcms" method="post" action="">
								<div class="form-int">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Imagen: *</label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                        	<input name="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" value="<?php echo $imagen; ?>" />
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        	<?php if($xVisitante=="No"){ ?><button class="btn btn-red" type="button" name="boton2" value="Examinar" onClick="javascript:Imagen('CAR');" /><i class="fa fa-save"></i> Examinar</button><?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
										</div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                         	<input name="orden" type="text" id="orden" value="<?php echo $orden; ?>" onKeyPress="return soloNumeros(event)" /></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="custom-input">
                                            	<input <?php if (!(strcmp($estado,"Activo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" value="Activo" id="activo" checked="checked"><label for="activo">Activo</label>
                                                <input <?php if (!(strcmp($estado,"Inactivo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" value="Inactivo" id="inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="carrusel.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Imagen</button>
											</div>
							                <input type="hidden" name="proceso">
                                            <input type="hidden" name="cod_carrusel" value="<?php echo $cod_carrusel; ?>">
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
	</div>
	<?php include("includes/footer.php") ?>
</body>
</html>