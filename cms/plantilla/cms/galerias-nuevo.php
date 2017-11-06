<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
$cod_categoria = "";
if (isset($_POST['proceso'])) {
	$proceso	= $_POST['proceso'];
} else {
	$proceso	= "";
}

if($proceso == "Registrar"){
	$cod_galeria		= $_POST['cod_galeria'];
	$titulo				= mysqli_real_escape_string($enlaces, utf8_decode($_POST['titulo']));
	$imagen				= $_POST['imagen'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	
	$validarGalerias = "SELECT * FROM galerias WHERE titulo='$titulo'";
	$ejecutarValidar = mysqli_query($enlaces,$validarGalerias) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$numreg = mysqli_num_rows($ejecutarValidar);
	
	if($numreg==0){
		$insertarGalerias = "INSERT INTO galerias (cod_galeria, titulo, imagen, orden, estado) VALUE ('$cod_galeria', '$titulo', '$imagen', '$orden', '$estado')";
		$resultadoInsertar = mysqli_query($enlaces,$insertarGalerias) or die('Consulta fallida: ' . mysqli_error($enlaces));
		$mensaje = "<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> El trabajo se registr&oacute; con exitosamente. <a href='galerias.php'>Ir a Albums</a></p>
					</div>";
	}else{
		$mensaje = "<div class='alert alert-warning' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> Ops, el usuario ya existe...</p>
                	</div>";
	}
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
			
			document.fcms.action = "galerias-nuevo.php";
			document.fcms.proceso.value="Registrar";
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
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-calendar"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> Albums <i class="fa fa-caret-right"></i> A&ntilde;adir Album
			</div>
			<div class="wrp clearfix">
            	<?php $page = "albums"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir Album</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<?php echo $mensaje; ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>T&iacute;tutlo Album: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="titulo" type="text" id="titulo" />
                                        </div>
                                    </div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Imagen Principal: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<input name="imagen" type="text" id="imagen" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('GAL');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                                        	<input name="orden" type="text" onKeyPress="return soloNumeros(event)" />
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
                                            	<a href="galerias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Album</button>
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