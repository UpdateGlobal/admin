<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
$cod_galeria	= $_REQUEST['cod_galeria'];

if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}

$consultaFotos = "SELECT * FROM galerias_fotos WHERE cod_galeria='$cod_galeria'";
$resultadoFotos = mysqli_query($enlaces,$consultaFotos);

$consultaNombre = "SELECT * FROM galerias WHERE cod_galeria='$cod_galeria'";
$resultadoNombre = mysqli_query($enlaces,$consultaNombre);

if($proceso == "Registrar"){
	$cod_galeria		= $_POST['cod_galeria'];
	$imagen				= $_POST['imagen'];
	$insertarGaleria = "INSERT INTO galerias_fotos(cod_galeria, imagen)VALUE('$cod_galeria', '$imagen')";
	$resultadoInsertar = mysqli_query($enlaces,$insertarGaleria);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> Se a&ntilde;adi&oacute; la imagen exitosamente. <a href='galerias-albums.php'>Ir a Galerias</a></p>
                </div>";
	header("Location: galerias-albums-nuevo.php?cod_galeria=$cod_galeria");
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
				document.fcms.imagen.focus();
				return;	
			}
			
            document.fcms.action = "galerias-albums-nuevo.php";
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
				<i class="fa fa-object-group"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> Fotos <i class="fa fa-caret-right"></i> A&ntilde;adir Fotos
			</div>
			<div class="wrp clearfix">
            	<?php $page = "galerias"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>A&ntilde;adir Fotos</strong>
							</div>
						</div>
						<div class="widget-content">
                            <span class="label label-primary"></span>
                            <div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> A&ntilde;ada fotos al album que seleccion&oacute;.</p>
			                </div>
	                        <div class="form-int">
                            	<form class="fcms" name="fcms" method="post" action="">
	                            	<div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Galer&iacute;a:</label>
                                        </div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php
												while($filaNom = mysqli_fetch_array($resultadoNombre)){
													$titulo = utf8_encode($filaNom['titulo']);
		                                    ?>
                                            <strong><?php echo $titulo; ?></strong>
                                            <?php
                                            }
											?>
                                        </div>
									</div>
									<div class="separador-20"></div>
									<div class="row">
    	                            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Añadir imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="imagen" type="text" id="imagen" />
                                        </div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IGGAL');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="galerias-albums.php" class="btn btn-pink"><i class="fa fa-reply"></i> Volver</a>
                                                <button class="btn btn-turquoise" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-plus-circle"></i> A&ntilde;adir Foto</button>
											</div>
							                <input type="hidden" name="proceso">
					                        <input type="hidden" name="cod_galeria" value="<?php echo $cod_galeria; ?>">
					                        <input type="hidden" name="titulo" value="<?php echo $titulo; ?>">
                                        </div>
                                    </div>
								</form>
                                <label><span>Los campos con ( <strong>*</strong> ) son obligatorios.</span></label>
							</div>
                            <div class="separador-20"></div>
                            <p>Im&aacute;genes dentro de esta galer&iacute;a, <strong>haga clic en las im&aacute;genes para borrar/quitar.</strong></p>
							<div id="listagaleria">
								<ul>
									<?php
                                        while($filaFoto = mysqli_fetch_array($resultadoFotos)){
                                            $xCodigoFot = $filaFoto['cod_foto'];
                                            $xCodgaleria = $filaFoto['cod_galeria'];
                                            $xFoto = $filaFoto['imagen'];
                                    ?>
                                    <li class="thumbnail"><a href="galerias-albums-delete.php?cod_foto=<?php echo $xCodigoFot; ?>&cod_galeria=<?php echo $xCodgaleria; ?>"><img src="images/galerias/fotos/<?php echo $xFoto; ?>" width="150" height="100"></a></li>
                                    <?php
                                        }
                                    ?>
								</ul>
							</div>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>