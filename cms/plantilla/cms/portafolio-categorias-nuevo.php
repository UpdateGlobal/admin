<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
	$proceso = $_POST['proceso'];
} else {
	$proceso = "";
}
if($proceso == "Registrar"){
	$categoria			= htmlspecialchars(utf8_decode($_POST['categoria']));
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	$insertarCategoria = "INSERT INTO portafolio_categorias(categoria, orden, estado)VALUE('$categoria', '$orden', '$estado')";
	$resultadoInsertar = mysqli_query($enlaces,$insertarCategoria);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> La categor&iacute;a se registr&oacute; con exitosamente. <a href='portafolio-categorias.php'>Ir a categorias</a></p>
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
			if(document.fcms.categoria.value==""){
				alert("Debes ingresar un nombre a la categoria");
				document.fcms.categoria.focus();
				return;	
			}
			if(document.fcms.orden.value==""){
				alert("Debe asignar un orden");
				document.fcms.orden.focus();
				return;
			}
			document.fcms.action = "portafolio-categorias-nuevo.php";
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
				<h1 class="page-title">Portafolio</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Portafolio <i class="fa fa-caret-right"></i> Categor&iacute;as <i class="fa fa-caret-right"></i> A&ntilde;adir Categor&iacute;a
			</div>
			<div class="wrp clearfix">
            	<?php $page = "portafolio"; include("includes/menu-portafolio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir Categor&iacute;a</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form class="fcms" name="fcms" method="post" action="">
	                            <div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Categor&iacute;a: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="categoria" type="text" id="categoria" />
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
                                            	<a href="portafolio-categorias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
    	                                        <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Categoria</button>
	                                        	<input type="hidden" name="proceso">
											</div>
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