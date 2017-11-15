<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$mensaje = "";
$cod_portafolio	= $_REQUEST['cod_portafolio'];

if (isset($_REQUEST['proceso'])) {
	$proceso 	= $_POST['proceso'];
} else {
	$proceso 	= "";
}

$consultaFotos = "SELECT * FROM portafolio_galerias WHERE cod_portafolio='$cod_portafolio'";
$resultadoFotos = mysqli_query($enlaces,$consultaFotos);

$consultaNombre = "SELECT * FROM portafolio WHERE cod_portafolio='$cod_portafolio'";
$resultadoNombre = mysqli_query($enlaces,$consultaNombre);

if($proceso == "Registrar"){
	$cod_portafolio		= $_POST['cod_portafolio'];
	$imagen				= $_POST['imagen'];
	$insertarGaleria = "INSERT INTO portafolio_galerias(cod_portafolio, imagen)VALUE('$cod_portafolio', '$imagen')";
	$resultadoInsertar = mysqli_query($enlaces,$insertarGaleria);
	$mensaje = "<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<p><strong>Nota:</strong> Se a&ntilde;adi&oacute; la imagen exitosamente. <a href='portafolio-galerias.php'>Ir a Galerias</a></p>
                </div>";
	header("Location: portafolio-galerias-nuevo.php?cod_portafolio=$cod_portafolio?nom_portafolio=$nom_portafolio");
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
			
            document.fcms.action = "portafolio-galerias-nuevo.php";
            document.fcms.proceso.value="Registrar";
            document.fcms.submit();
        }
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
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
				<i class="fa fa-home"></i> Portafolio <i class="fa fa-caret-right"></i> Galer&iacute;a <i class="fa fa-caret-right"></i> Editar galer&iacute;a
			</div>
			<div class="wrp clearfix">
            	<?php $page = "fotos"; include("includes/menu-portafolio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Editar Galer&iacute;a</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                            <div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> A&ntilde;ada fotos al trabajo que seleccion&oacute;. Si ha puesto el tipo de trabajo como vídeo (V) no se mostrar&aacute; la galer&iacute;a.</p>
			                </div>
                            <?php echo $mensaje; ?>
	                        <div class="form-int">
                            	<form class="fcms" name="fcms" method="post" action="">
	                            	<div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Galer&iacute;a:</label>
                                        </div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        	<?php
												while($filaNom = mysqli_fetch_array($resultadoNombre)){
													$xNomPorta = htmlspecialchars(utf8_encode($filaNom['nom_portafolio']));
		                                    ?>
                                            <strong><?php echo $xNomPorta; ?></strong>
                                            <?php
                                            }
											?>
                                        </div>
									</div>
									<div class="separador-20"></div>
									<div class="row">
    	                            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>A&ntilde;adir imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input name="imagen" type="text" id="imagen" />
                                        </div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IGPOR');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="portafolio-galerias.php" class="btn btn-pink"><i class="fa fa-reply"></i> Volver</a>
                                                <button class="btn btn-turquoise" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-plus-circle"></i> A&ntilde;adir Foto</button>
											</div>
							                <input type="hidden" name="proceso">
					                        <input type="hidden" name="cod_portafolio" value="<?php echo $cod_portafolio; ?>">
					                        <input type="hidden" name="nom_portafolio" value="<?php echo $nom_portafolio; ?>">
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
                                            $xCodigoGal		= $filaFoto['cod_galeria_portafolio'];
                                            $xCodportafolio	= $filaFoto['cod_portafolio'];
                                            $xFoto			= $filaFoto['imagen'];
                                    ?>
                                    <li class="thumbnail"><a href="portafolio-galerias-delete.php?cod_galeria_portafolio=<?php echo $xCodigoGal; ?>&cod_portafolio=<?php echo $xCodportafolio; ?>"><img src="images/portafolio/galeria/<?php echo $xFoto; ?>" width="150" height="100"></a></li>
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