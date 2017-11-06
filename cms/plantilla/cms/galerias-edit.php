<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_galeria = $_REQUEST['cod_galeria'];
if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}
if($proceso == ""){
	$consultaGal="SELECT * FROM galerias WHERE cod_galeria='$cod_galeria'";
	$resultadoGal=mysqli_query($enlaces,$consultaGal);
	$filaGal = mysqli_fetch_array($resultadoGal);
	$cod_galeria		= $filaGal['cod_galeria'];
	$titulo				= htmlspecialchars(utf8_encode($filaGal['titulo']));
	$imagen				= $filaGal['imagen'];
	$orden				= $filaGal['orden'];
	$estado				= $filaGal['estado'];
}
if($proceso == "Actualizar"){
	$cod_galeria		= $_POST['cod_galeria'];
	$titulo				= mysqli_real_escape_string($enlaces, utf8_decode($_POST['titulo']));
	$imagen				= $_POST['imagen'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	
	//Validar si el registro existe
	$actualizarGalerias = "UPDATE galerias SET
		cod_galeria='$cod_galeria', 
		titulo='$titulo', 
		imagen='$imagen', 
		orden='$orden', 
		estado='$estado' 
		WHERE cod_galeria='$cod_galeria'";
	
	$resultadoActualizar = mysqli_query($enlaces,$actualizarGalerias);
	header("Location:galerias.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
	<script>
		function Validar(){
			if(document.fcms.titulo.value==""){
				alert("Debe escribir un título");
				document.fcms.titulo.focus();
				return;	
			}
			if(document.fcms.imagen.value==""){
				alert("Debe subir una imagen principal para el album");
				document.fcms.imagen.focus();
				return;	
			}
			if(document.fcms.orden.value==""){
				alert("Debe asignar un orden");
				document.fcms.orden.focus();
				return;	
			}
			
			document.fcms.action = "galerias-edit.php";
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
				<h1 class="page-title">Galer&iacute;as</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> Albums <i class="fa fa-caret-right"></i> Editar Album
			</div>
			<div class="wrp clearfix">
            	<?php $page = "albums"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Album</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>T&iacute;tulo Album: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" value="<?php echo $titulo; ?>" />
                                        </div>
									</div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                                        <?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                        	<input name="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{?>text<?php } ?>" id="imagen" value="<?php echo $imagen; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<?php if($xVisitante=="No"){ ?>
                                            <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('GAL');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                                        	<input name="orden" type="text" onKeyPress="return soloNumeros(event)" value="<?php echo $orden; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="custom-input">
                                            	<input <?php if (!(strcmp($estado,"Activo"))) {echo "checked=\"checked\"";} ?> type="radio" id="activo" name="estado" value="Activo" checked="checked"><label for="activo">Activo</label>
                        						<input <?php if (!(strcmp($estado,"Inactivo"))) {echo "checked=\"checked\"";} ?> type="radio" id="inactivo" name="estado" value="Inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="btn-group">
                                            	<a href="galerias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Trabajo</button>
											</div>
					                        <input type="hidden" name="proceso">
                                            <input type="hidden" name="cod_galeria" value="<?php echo $cod_galeria; ?>">
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