<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
$cod_categoria = "";
$cod_sub_categoria = "";
if (isset($_REQUEST['proceso'])){
	$proceso = $_POST['proceso'];
} else {
	$proceso = "";
}
if($proceso == "Filtrar"){
	$cod_categoria		= $_POST['cod_categoria'];
	$cod_sub_categoria	= $_POST['cod_sub_categoria'];
}

if($proceso == "Registrar"){
	$cod_categoria		= $_POST['cod_categoria'];
	$cod_sub_categoria	= $_POST['cod_sub_categoria'];
	$nom_producto		= mysqli_real_escape_string($enlaces,$_POST['nom_producto']);
	$descripcion		= mysqli_real_escape_string($enlaces,$_POST['descripcion']);
	$oferta				= $_POST['oferta'];
	$precio_oferta		= substr(utf8_decode($_POST['precio_oferta']));
	$precio_normal		= substr(utf8_decode($_POST['precio_normal']));
	$novedad			= $_POST['novedad'];
	$fecha_ing			= $_POST['fecha_ing'];
	$imagen				= $_POST['imagen'];
	$ficha_tecnica		= $_POST['ficha_tecnica'];
	$banner_grande		= $_POST['banner_grande'];
	$banner_chico		= $_POST['banner_chico'];
	$video				= $_POST['video'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	
	//Validar si el registro existe
	$validarProductos = "SELECT * FROM productos WHERE nom_producto='$nom_producto'";
	$ejecutarValidar = mysqli_query($enlaces, $validarProductos);
	$numreg = mysqli_num_rows($ejecutarValidar);
	
	$insertarProductos = "INSERT INTO productos (cod_categoria, cod_sub_categoria, nom_producto, descripcion, oferta, precio_oferta, precio_normal, novedad, fecha_ing, imagen, ficha_tecnica, banner_grande, banner_chico, video, orden, estado) VALUE ('$cod_categoria', '$cod_sub_categoria', '$nom_producto', '$descripcion', '$oferta', '$precio_oferta', '$precio_normal', '$novedad', '$fecha_ing', '$imagen', '$ficha_tecnica', '$banner_grande', '$banner_chico', '$video', '$orden', '$estado')";
	$resultadoInsertar = mysqli_query($enlaces, $insertarProductos);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> Producto se registr&oacute; exitosamente. <a href='productos.php'>Ir a Productos</a></p>
	            </div>";
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
			if(document.fcms.nom_producto.value==""){
				alert("Debe escribir un título");
				document.fcms.nom_producto.focus();
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
			document.fcms.action = "productos-nuevo.php";
			document.fcms.proceso.value="Registrar";
			document.fcms.submit();
		}
		function Filtrar(){
			document.fcms.action = "productos-nuevo.php";
			document.fcms.proceso.value="Filtrar";
			document.fcms.submit();
		}
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
		}
		function soloNumeros(e){
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
            	<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> A&ntilde;adir producto
			</div>
			<div class="wrp clearfix">
            	<?php $page = "productos"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir producto</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<?php echo $mensaje; ?>
                            <form name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Categor&iacute;a:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
	                                        <div class="dropdown">
                                                <select name="cod_categoria" class="dropdown-select" onChange="Filtrar();">
                                                    <option value="0">Sin categoria</option>
                                                    <?php 
                                                        if($cod_categoria == ""){
                                                            $consultaCat = "SELECT * FROM productos_categorias WHERE estado='Activo'";
                                                            $resultaCat = mysqli_query($enlaces, $consultaCat);
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                                                            }
                                                        }else{
                                                            $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                                                            $resultaCat = mysqli_query($enlaces, $consultaCat);
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                                                            }
                                                            $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
                                                            $resultaCat = mysqli_query($enlaces, $consultaCat);
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
											</div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Sub-categor&iacute;a:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="dropdown">
                        						<select name="cod_sub_categoria" class="dropdown-select">
													<?php 
                                                        if($cod_categoria==""){
                                                            echo '<option value="0">Sin sub-categoria</option>';
                                                        }else{
                                                            if(($cod_sub_categoria=="")or($cod_sub_categoria=="0")){
                                                                $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='Activo' AND cod_categoria='$cod_categoria'";
                                                                $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                                                                while($fsb=mysqli_fetch_array($resulSubCat)){
                                                                    $xcodSubCat = $fsb['cod_sub_categoria'];
                                                                    $xnomSubCat = utf8_encode($fsb['subcategoria']);
                                                                    echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                                                                }
                                                            }else{
                                                                $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='Activo' AND cod_categoria='$cod_categoria' AND cod_sub_categoria='$cod_sub_categoria'";
                                                                $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                                                                while($fsb=mysqli_fetch_array($resulSubCat)){
                                                                    $xcodSubCat = $fsb['cod_sub_categoria'];
                                                                    $xnomSubCat = utf8_encode($fsb['subcategoria']);
                                                                    echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                                                                }
                                                                
                                                                $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='Activo' AND cod_categoria='$cod_categoria' AND cod_sub_categoria!='$cod_sub_categoria'";
                                                                $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                                                                while($fsb=mysqli_fetch_array($resulSubCat)){
                                                                    $xcodSubCat = $fsb['cod_sub_categoria'];
                                                                    $xnomSubCat = utf8_encode($fsb['subcategoria']);
                                                                    echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                                                                }									
                                                            }
                                                        }
                                                    ?>
                                                    <option value="0">Sin categoria</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Nombre de producto: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="nom_producto" type="text" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Descripci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="descripcion" /></textarea>
                                            <script>
												CKEDITOR.replace('descripcion');
											</script>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Oferta:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="custom-input">
                                                <input type="radio" name="oferta" id="no" value="no" checked="checked"><label for="no">No</label>
                                                <input type="radio" name="oferta" id="si" value="si"><label for="si">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Precio Oferta:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="precio_oferta" type="text" id="precio_oferta" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Precio Normal:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="precio_normal" type="text" id="precio_normal" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Novedad:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<div class="custom-input">
				                        		<input name="novedad" type="radio" id="n" value="no" checked><label for="n">No</label>
	            				            	<input name="novedad" type="radio" id="s" value="si"><label for="s">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Fecha de Ingreso:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="fecha_ing" type="date" />
                                        </div>
                                    </div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Imagen *<br><span>(-px x -px)</span>:</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="imagen" id="imagen" type="text" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IP');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Ficha T&eacute;cnica:<br><span>(Formato .pdf)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="ficha_tecnica" id="ficha_tecnica" type="text" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('FT');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Banner Grande:<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="banner_grande" id="banner_grande" type="text" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('BG');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Banner Chico:<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                                        <input name="banner_chico" type="text" size="30" />
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton4" onClick="javascript:Imagen('BC');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
									</div>
                                    <div class="separador-20"></div>
	               					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Video:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="video" type="text" />
                                        </div>
                                    </div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Orden: *</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                        	<input name="orden" type="text" onKeyPress="return soloNumeros(event)" />
                                        </div>
                                    </div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Estado:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="custom-input">
                                                <input type="radio" name="estado" id="activo" value="activo" checked="checked"><label for="activo">Activo</label>
                                                <input type="radio" name="estado" id="inactivo" value="inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                					<div class="row">
                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="btn-group">
                                            	<a href="productos.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Productos</button>
											</div>
					                        <input type="hidden" name="proceso">
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