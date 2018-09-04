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
	$cod_categoria		= $_POST['cod_categoria'];
	$subcategoria		= mysqli_real_escape_string($enlaces,utf8_decode($_POST['subcategoria']));
	$imagen				= $_POST['imagen'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	
	$insertarSubCategoria = "INSERT INTO productos_sub_categorias(cod_categoria, subcategoria, imagen, orden, estado)VALUE('$cod_categoria', '$subcategoria', '$imagen', '$orden', '$estado')";
	$resultadoInsertar = mysqli_query($enlaces, $insertarSubCategoria);
	$mensaje = "<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> La categor&iacute;a se registr&oacute; con exitosamente. <a href='productos-subcategorias.php'>Ir a Sub-Categorias de Productos</a></p>
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
			if(document.fcms.subcategoria.value==""){
				alert("Debe escribir un nombre para la Sub-Categoria");
				document.fcms.subcategoria.focus();
				return;	
			}
			document.fcms.action = "productos-subcategorias-nuevo.php";
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
				<h1 class="page-title">Productos</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Sub-Categor&iacute;as <i class="fa fa-caret-right"></i> A&ntilde;adir Sub-Categor&iacute;a
			</div>
			<div class="wrp clearfix">
            	<?php $page = "subcategorias"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir Sub-Categor&iacute;a</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php echo $mensaje ?>
                            <form name="fcms" method="post" action="">
	                            <div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Categor&iacute;as:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="dropdown">
                                            	<select name="cod_categoria" class="dropdown-select">
                                            	    <?php
                                            	        $consultaCat = "SELECT * FROM productos_categorias ORDER BY categoria ASC";
                                            	        $resultadoCat = mysqli_query($enlaces, $consultaCat);
                                            	        while($filaCat = mysqli_fetch_array($resultadoCat)){
                                            	            $xCodcate = $filaCat['cod_categoria'];
                                            	            $xCategoria = utf8_encode($filaCat['categoria']);
                                            	    ?>
                                            	    <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?></option>
                                            	    <?php
                                            	        }
                                            	    ?>
                                            	</select>
                                            </div>
                                        </div>
                                    </div>
									<div class="separador-20"></div>
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Subcategor&iacute;a: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="subcategoria" type="text" id="subcategoria" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<input name="imagen" type="text" id="imagen" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('ISC');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
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
                                            	<a href="productos-subcategorias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
    	                                        <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Sub-Categoria</button>
	                                        	<input type="hidden" name="proceso">
											</div>
                                        </div>
									</div>
								</div>
							</form>
						</div>
                    </div>
				</div>				
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>