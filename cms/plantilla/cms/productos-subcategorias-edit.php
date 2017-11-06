<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];
if (isset($_REQUEST['proceso'])) {
	$proceso = $_POST['proceso'];
} else {
	$proceso = "";
}
if($proceso == ""){
	$consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE cod_sub_categoria='$cod_sub_categoria'";
	$resultadoSubCat = mysqli_query($enlaces, $consultaSubCat);
	$filaSC = mysqli_fetch_array($resultadoSubCat);
	$cod_sub_categoria		= $filaSC['cod_sub_categoria'];
	$cod_categoria			= $filaSC['cod_categoria'];
	$subcategoria			= htmlspecialchars(utf8_encode($filaSC['subcategoria']));
	$imagen					= $filaSC['imagen'];
	$orden					= $filaSC['orden'];
	$estado					= $filaSC['estado'];
}
if($proceso == "Actualizar"){
	$cod_sub_categoria		= $_POST['cod_sub_categoria'];
	$cod_categoria			= $_POST['cod_categoria'];
	$subcategoria			= mysqli_real_escape_string($enlaces,utf8_decode($_POST['subcategoria']));
	$imagen					= $_POST['imagen'];
	$orden					= $_POST['orden'];
	$estado					= $_POST['estado'];
	
	$actualizarSubCategoria = "UPDATE productos_sub_categorias SET cod_sub_categoria='$cod_sub_categoria', cod_categoria='$cod_categoria', subcategoria='$subcategoria', imagen='$imagen', orden='$orden', estado='$estado' WHERE cod_sub_categoria='$cod_sub_categoria'";
	$resultadoActualizar = mysqli_query($enlaces, $actualizarSubCategoria);
	
	header("Location: productos-subcategorias.php");
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
			if(document.fcms.imagen.value==""){
				alert("Debe subir una imagen");
				document.fcms.imagen.focus();
				return;	
			}
			if(document.fcms.orden.value==""){
				alert("Debe asignar un orden");
				document.fcms.orden.focus();
				return;	
			}
			document.fcms.action = "productos-subcategorias-edit.php";
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
				<h1 class="page-title">Productos</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Sub-Categor&iacute;as <i class="fa fa-caret-right"></i> Editar Sub-Categor&iacute;as
			</div>
			<div class="wrp clearfix">
            	<?php $page = "subcategorias"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Sub-Categor&iacute;a</strong>
							</div>
						</div>
						<div class="widget-content">
                            <form name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Categor&iacute;a: *</label>
                                        </div>
                                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="dropdown">
                                                <select name="cod_categoria" class="dropdown-select">
                                                    <?php
                                                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                                                        $resultadoCat = mysqli_query($enlaces, $consultaCat);
                                                        while($filaCat = mysqli_fetch_array($resultadoCat)){
                                                            $xCodcate = $filaCat['cod_categoria'];
                                                            $xCategoria = utf8_encode($filaCat['categoria']);
                                                    ?>
                                                    <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?> (Actual)</option>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                    <?php
                                                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
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
                                        	<input name="subcategoria" type="text" id="subcategoria" value="<?php echo $subcategoria; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                        	<input name="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" value="<?php echo $imagen; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <?php if($xVisitante=="No"){ ?>
                                            <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('ISC');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="orden" type="text" id="orden" value="<?php echo $orden; ?>" onKeyPress="return soloNumeros(event)" />
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
                                            	<a href="productos-subcategorias.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-green" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Categoria</button>
                                                <input type="hidden" name="proceso">
					                            <input type="hidden" name="cod_sub_categoria" value="<?php echo $cod_sub_categoria; ?>">
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