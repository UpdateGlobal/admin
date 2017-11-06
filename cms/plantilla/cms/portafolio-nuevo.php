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
	$cod_categoria		= $_POST['cod_categoria'];
	$nom_portafolio		= mysqli_real_escape_string($enlaces, utf8_decode($_POST['nom_portafolio']));
	$descripcion		= mysqli_real_escape_string($enlaces, utf8_decode($_POST['descripcion']));
	$type				= $_POST['type'];
	$video				= $_POST['video'];
	$imagen				= $_POST['imagen'];
	$orden				= $_POST['orden'];
	$estado				= $_POST['estado'];
	
	$validarPortafolio = "SELECT * FROM portafolio WHERE nom_portafolio='$nom_portafolio'";
	$ejecutarValidar = mysqli_query($enlaces,$validarPortafolio) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$numreg = mysqli_num_rows($ejecutarValidar);
	
	if($numreg==0){
		$insertarPortafolio = "INSERT INTO portafolio (cod_categoria, nom_portafolio, descripcion, type, video, imagen, orden, estado) VALUE ('$cod_categoria', '$nom_portafolio', '$descripcion', '$type', '$video', '$imagen', '$orden', '$estado')";
		$resultadoInsertar = mysqli_query($enlaces,$insertarPortafolio) or die('Consulta fallida: ' . mysqli_error($enlaces));
		$mensaje = "<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<p><strong>Nota:</strong> El trabajo se registr&oacute; con exitosamente. <a href='portafolio.php'>Ir a Portafolio</a></p>
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
    <script src="js-editor/ckeditor.js" type="text/javascript"></script>
	<script>
		function Validar(){
			if(document.fcms.nom_portafolio.value==""){
				alert("Debe escribir un título");
				document.fcms.nom_portafolio.focus();
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
			
			document.fcms.action = "portafolio-nuevo.php";
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
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Portafolio <i class="fa fa-caret-right"></i> Trabajos <i class="fa fa-caret-right"></i> A&ntilde;adir trabajo
			</div>
			<div class="wrp clearfix">
            	<?php $page = "trabajos"; include("includes/menu-portafolio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir trabajo</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<?php echo $mensaje; ?>
                            <form class="fcms" name="fcms" method="post" action="">
                            	<div class="form-int">
                                	<div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<label>T&iacute;tulo: *</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<input name="nom_portafolio" type="text" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label>Categor&iacute;a:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<div class="dropdown">
                                                <select name="cod_categoria" class="dropdown-select">
                                                    <?php 
                                                        if($cod_categoria == ""){
                                                            $consultaCat = "SELECT * FROM portafolio_categorias WHERE estado='Activo'";
                                                            $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                                                            }
                                                        }else{
                                                            $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria='$cod_categoria'";
                                                            $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                                            while($filaCat = mysqli_fetch_array($resultaCat)){
                                                                $xcodCat = $filaCat['cod_categoria'];
                                                                $xnomCat = utf8_encode($filaCat['categoria']);
                                                                echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                                                            }
                                                            $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria!='$cod_categoria'";
                                                            $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
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
											<label>Descripci&oacute;n:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<textarea name="descripcion" cols="55" rows="15" /></textarea>
                                            <script>
												CKEDITOR.replace('descripcion');
											</script>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Tipo:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="custom-input">
                                                <input type="radio" name="type" id="img" value="I" checked="checked"><label for="img">Imagen</label>
                                                <input type="radio" name="type" id="video" value="V"><label for="video">Video</label>
                                            </div>
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
                                        	<label>Imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	<input name="imagen" type="text" id="imagen" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                                        <button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IPR');" /><i class="fa fa-save"></i> Examinar</button>
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
                                            	<a href="portafolio.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-blue" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Trabajo</button>
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