<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_categoria = "";
$cod_sub_categoria = "";
$cod_producto = $_REQUEST['cod_producto'];
if (isset($_REQUEST['proceso'])){
	$proceso = $_POST['proceso'];
} else {
	$proceso = "";
}
$cod_producto = $_REQUEST['cod_producto'];
if($proceso == ""){
	$consultaPro="SELECT * FROM productos WHERE cod_producto='$cod_producto'";
	$resultadoPro=mysqli_query($enlaces, $consultaPro);
	$filaPro = mysqli_fetch_array($resultadoPro);
	$cod_producto		= $filaPro['cod_producto'];
	$cod_categoria		= $filaPro['cod_categoria'];
	$cod_sub_categoria	= $filaPro['cod_sub_categoria'];
	$nom_producto		= htmlspecialchars($filaPro['nom_producto']);
	$descripcion		= htmlspecialchars($filaPro['descripcion']);
	$oferta				= $filaPro['oferta'];
	$precio_oferta		= substr(utf8_decode($filaPro['precio_oferta']),0,20);
	$precio_normal		= substr(utf8_decode($filaPro['precio_normal']),0,20);
	$novedad			= $filaPro['novedad'];
	$fecha_ing			= $filaPro['fecha_ing'];
	$imagen				= $filaPro['imagen'];
	$ficha_tecnica		= $filaPro['ficha_tecnica'];
	$banner_grande		= $filaPro['banner_grande'];
	$banner_chico		= $filaPro['banner_chico'];
	$video				= $filaPro['video'];
	$orden				= $filaPro['orden'];
	$estado				= $filaPro['estado'];
}
if($proceso == "Filtrar"){
	$cod_categoria		= $_POST['cod_categoria'];
	$cod_sub_categoria	= $_POST['cod_sub_categoria'];
	$nom_producto		= htmlspecialchars($_POST['nom_producto']);
	$descripcion		= htmlspecialchars($_POST['descripcion']);
	$oferta				= $_POST['oferta'];
	$precio_oferta		= substr(utf8_decode($_POST['precio_oferta']),0,20);
	$precio_normal		= substr(utf8_decode($_POST['precio_normal']),0,20);
	$novedad			= $_POST['novedad'];
	$fecha_ing			= $_POST['fecha_ing'];
	$imagen				= $_POST['imagen'];
	$ficha_tecnica		= $_POST['ficha_tecnica'];
	$banner_grande		= $_POST['banner_grande'];
	$banner_chico		= $_POST['banner_chico'];
	$video				= $_POST['video'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
}

if($proceso == "Actualizar"){
	$cod_categoria		= $_POST['cod_categoria'];
	$cod_sub_categoria	= $_POST['cod_sub_categoria'];
	$nom_producto		= mysqli_real_escape_string($enlaces,$_POST['nom_producto']);
	$descripcion		= mysqli_real_escape_string($enlaces,$_POST['descripcion']);
	$oferta				= $_POST['oferta'];
	$precio_oferta		= substr(utf8_decode($_POST['precio_oferta']),0,20);
	$precio_normal		= substr(utf8_decode($_POST['precio_normal']),0,20);
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
	$actualizarProductos = "UPDATE productos SET
		cod_producto='$cod_producto', 
		cod_categoria='$cod_categoria', 
		cod_sub_categoria='$cod_sub_categoria', 
		nom_producto='$nom_producto', 
		descripcion='$descripcion', 
		oferta='$oferta', 
		precio_oferta='$precio_oferta', 
		precio_normal='$precio_normal', 
		novedad='$novedad', 
		fecha_ing='$fecha_ing', 
		imagen='$imagen', 
		ficha_tecnica='$ficha_tecnica', 
		banner_grande='$banner_grande', 
		banner_chico='$banner_chico', 
		video='$video', 
		orden='$orden', 
		estado='$estado' 
		WHERE cod_producto='$cod_producto'";
	
	$resultadoActualizar = mysqli_query($enlaces, $actualizarProductos);
	header("Location:productos.php");
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
			document.fcms.action = "productos-edit.php";
			document.fcms.proceso.value="Actualizar";
			document.fcms.submit();
		}
		function Filtrar(){
			document.fcms.action = "productos-edit.php";
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
    <link href="jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
	<link href="jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
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
            	<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Editar producto
			</div>
			<div class="wrp clearfix">
            	<?php $page = "productos"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar producto</strong>
							</div>
						</div>
						<div class="widget-content">
                            <form name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Categor&iacute;a:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
	                                        <div class="dropdown">
                                            	<select name="cod_categoria" onChange="Filtrar();" class="dropdown-select">
                                                    <option value="0">Sin Categoria</option>
                                                    <?php 
                                                        //Al cargar la pagina debe listar todas las categorias existentes
                                                        if($cod_categoria == ""){
                                                            $consultaCat = "SELECT * FROM productos_categorias WHERE estado='Activo'";
                                                            $resultaCat = mysqli_query($enlaces, $consultaCat);
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                                                            }
                                                        }else{
                                                            // Al recargar la pagina que seleccione el elemento escogido
                                                            $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                                                            $resultaCat = mysqli_query($enlaces, $consultaCat);
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                                                            }
                                                            //Cargar todas las categorias menos la escogida
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
                                                            echo '<option value="0">Seleccionar SubCategoria</option>';
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
                        							<option>Seleccionar Categoria</option>
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
                                        	<input name="nom_producto" type="text" value="<?php echo $nom_producto; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Descripci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="descripcion" /><?php echo $descripcion ?></textarea>
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
                                            	<input <?php if (!(strcmp($oferta,"no"))) {echo "checked=\"checked\"";} ?> name="oferta" id="no" type="radio" value="no" checked><label for="no">No</label>
                                                <input <?php if (!(strcmp($oferta,"si"))) {echo "checked=\"checked\"";} ?> name="oferta" id="si" type="radio" value="si"><label for="si">Si</label>
					                        	
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Precio Oferta:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="precio_oferta" type="text" id="precio_oferta" value="<?php echo $precio_oferta; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Precio Normal:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="precio_normal" type="text" id="precio_normal" value="<?php echo $precio_normal; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Novedad:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<div class="custom-input">
                                            	<input <?php if (!(strcmp($novedad,"no"))) {echo "checked=\"checked\"";} ?> id="n" name="novedad" type="radio" value="no" checked><label for="n">No</label>
                                            	<input <?php if (!(strcmp($novedad,"si"))) {echo "checked=\"checked\"";} ?> id="s" name="novedad" type="radio" value="si"><label for="s">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Fecha de Ingreso:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input name="fecha_ing" type="date" value="<?php echo $fecha_ing; ?>" />
                                        </div>
                                    </div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Imagen *<br><span>(-px x -px)</span>:</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                                            <input name="imagen" id="imagen" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $imagen; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <?php if($xVisitante=="No"){ ?>
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IP');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
									<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Ficha T&eacute;cnica:<br><span>(Formato .pdf)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $ficha_tecnica; ?></p><?php } ?>
                                            <input name="ficha_tecnica" id="ficha_tecnica" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $ficha_tecnica; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<?php if($xVisitante=="No"){ ?>
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('FT');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Banner Grande:<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $banner_grande; ?></p><?php } ?>
                                            <input name="banner_grande" id="banner_grande" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $banner_grande; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<?php if($xVisitante=="No"){ ?>
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('BG');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Banner Chico:<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $banner_chico; ?></p><?php } ?>
	                                        <input name="banner_chico" id="banner_chico" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $banner_chico; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <?php if($xVisitante=="No"){ ?>
                                        	<button class="btn btn-red" type="button" name="boton4" onClick="javascript:Imagen('BC');" /><i class="fa fa-save"></i> Examinar</button>
                                            <?php } ?>
                                        </div>
									</div>
                                    <div class="separador-20"></div>
	               					<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>Video:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php if($xVisitante=="Si"){ ?><p><?php echo $video; ?></p><?php } ?>
                                        	<input name="video" type="<?php if($xVisitante=="Si"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $video; ?>" />
                                        </div>
                                    </div>
                                    <?php if($video!=""){ ?>
                                    <div class="row">
	                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Vista previa del v&iacute;deo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<a class="jackbox" data-group="video" href="<?php echo $video; ?>">
												<i class="fa fa-play-circle" aria-hidden="true"></i> Reproducir
											</a>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <?php }else{ ?>
                                    <?php } ?>
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
                                            	<input <?php if (!(strcmp($estado,"Activo"))) {echo "checked=\"checked\"";} ?> type="radio" name="estado" id="activo" value="Activo" checked="checked"><label for="Activo">Activo</label>
						                        <input <?php if (!(strcmp($estado,"Inactivo"))) {echo "checked=\"checked\"";} ?> type="radio" id="inactivo" name="estado" value="Inactivo"><label for="inactivo">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                					<div class="row">
                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="btn-group">
                                            	<a href="productos.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Editar Productos</button>
											</div>
					                        <input type="hidden" name="proceso">
                                            <input type="hidden" name="cod_producto" value="<?php echo $cod_producto; ?>">
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
        <script type="text/javascript" src="jackbox/js/libs/jquery.address-1.5.min.js"></script>
		<script type="text/javascript" src="jackbox/js/libs/Jacked.js"></script>
		<script type="text/javascript" src="jackbox/js/jackbox-swipe.js"></script>
		<script type="text/javascript" src="jackbox/js/jackbox.js"></script>
		<script type="text/javascript" src="jackbox/js/libs/StackBlur.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
//				jQuery(".jackbox[data-group]").jackBox("init");
				jQuery(".jackbox[data-group]").jackBox("init", {
					deepLinking: false,
					showInfoByDefault: false,       // show item info automatically when content loads, true/false
					preloadGraphics: true,          // preload the jackbox graphics for a faster jackbox
					fullscreenScalesContent: false,  // choose to always scale content up in fullscreen mode, true/false
 
					autoPlayVideo: false,           // video autoplay default, this can also be set per video in the data-attributes, true/false
					flashVideoFirst: false,         // choose which technology has first priority for video, HTML5 or Flash, true/false
     
					useThumbs: false,                // choose to use thumbnails, true/false
					thumbsStartHidden: false,       // choose to initially hide the thumbnail strip, true/false
					useThumbTooltips: false
				});
			});
		</script>
	</div>
</body>
</html>