<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>
	<link rel='stylesheet' id='camera-css' href='resources/cameraslider/css/camera.css' type='text/css' media='all'>
	<link rel='stylesheet' href='resources/slick/slick.css' type='text/css' media='all'>
	<link rel='stylesheet' href='resources/slick/slick-theme.css' type='text/css' media='all'>
</head>
<body>
	<div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
	<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
		<?php
			$consultarBanner = "SELECT * FROM banners WHERE estado='activo' ORDER BY orden";
			$resultadoBanner = mysqli_query($enlaces,$consultarBanner) or die('Consulta fallida: ' . mysqli_error($enlaces));
			while($filaBan = mysqli_fetch_array($resultadoBanner)){
				$xTitulo		= utf8_decode($filaBan['titulo']);
				$xDescripcion	= utf8_decode($filaBan['texto']);
				$xImagen		= $filaBan['imagen'];
		?>
        <div data-thumb="cms/images/banner/<?php echo $xImagen; ?>" data-src="cms/images/banner/<?php echo $xImagen; ?>">
        	<?php if ($xTitulo!="" & $xDescripcion!="" ){ ?>
			<div class="camera_caption fadeFromBottom">
				<div class="row">
					<div class="container">
						<div class="col-lg-12">
							<h4><?php echo $xTitulo; ?></h4>
							<p><?php echo $xDescripcion; ?></p>
						</div>
					</div>
				</div>
			</div>
            <?php }else{ ?>
            <?php } ?>
		</div>
		<?php
			}
			mysqli_free_result($resultadoBanner);
		?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Nuestros Servicios
                </h1>
            </div>
			<?php
			    $consultarServicio = "SELECT * FROM servicios WHERE estado='Activo' ORDER BY orden  LIMIT 3";
			    $resultadoServicio = mysqli_query($enlaces,$consultarServicio) or die('Consulta fallida: ' . mysqli_error($enlaces));
			    while($filaSer = mysqli_fetch_array($resultadoServicio)){
					$xCodigoS		= $filaSer['cod_servicio'];
					$xTitulo		= utf8_decode($filaSer['titulo']);
			        $xDescripcion	= $filaSer['descripcion'];
			?>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><i class="fa fa-fw fa-check"></i> <?php echo $xTitulo; ?></h4>
						</div>
						<div class="panel-body text-justify">
							<p><?php 
								$strCut = substr($xDescripcion,0,350);
								$xDescripcion = substr($strCut,0,strrpos($strCut, ' ')).'...';
								echo strip_tags($xDescripcion);
							?></p>
							<div class="clearfix"></div>
							<a href="servicio.php?cod_servicio=<?php echo $xCodigoS; ?>" class="btn btn-default">Ver m&aacute;s</a>
						</div>
					</div>
				</div>
			<?php
				}
				mysqli_free_result($resultadoServicio);
			?>
        </div>
        <!-- /.row -->
        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Productos Recientes</h2>
            </div>
			<?php
				$consultarPro = "SELECT * FROM productos WHERE estado='activo' ORDER BY cod_producto ASC LIMIT 8";
			    $resultadoPro = mysqli_query($enlaces, $consultarPro);
			    while($filaPro = mysqli_fetch_array($resultadoPro)){
					$xCodigo		= $filaPro['cod_producto'];
					$xCodcat		= $filaPro['cod_categoria'];
					$xCodscat		= $filaPro['cod_sub_categoria'];
					$xProducto		= substr(utf8_decode($filaPro['nom_producto']),0,20);
			        $xImagen		= $filaPro['imagen'];
					$xPrecio		= $filaPro['precio_normal'];
					if($filaPro['precio_oferta']>=1){
						$pmostrar = number_format($filaPro['precio_oferta'],2);
					}else{
						$pmostrar = number_format($filaPro['precio_normal'],2);
					}
			?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            	<div class="thumbnail">
					<a href="producto-detalle.php?cod_categoria=<?php echo $xCodcat; ?>&cod_sub_categoria=<?php echo $xCodscat; ?>&cod_producto=<?php echo $xCodigo; ?>"><img class="img-responsive" src="cms/images/productos/<?php echo $xImagen; ?>" /></a>
                    
                    <div class="caption">
                        <h4><a href="producto-detalle.php?cod_categoria=<?php echo $xCodcat; ?>&cod_sub_categoria=<?php echo $xCodscat; ?>&cod_producto=<?php echo $xCodigo; ?>"><?php echo $xProducto; ?></a></h4>
                    	<button href="producto-detalle.php?cod_categoria=<?php echo $xCodcat; ?>&cod_sub_categoria=<?php echo $xCodscat; ?>&cod_producto=<?php echo $xCodigo; ?>" class="btn btn-default" type="button">Ver m&aacute;s</button> <h4 class="pull-right">$ <?php echo $pmostrar ?></h4>
					</div>
				</div>
			</div>
			<?php
				}
				mysqli_free_result($resultadoPro);
			?>
        </div>
        <hr>
        <div class="well">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a class="btn btn-lg btn-default btn-block" href="contacto.php">Cont&aacute;ctenos</a>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<section class="regular slider">
					<?php
			            $consultarCarrusel = "SELECT * FROM carrusel WHERE estado='activo' ORDER BY orden";
			            $resultadoCarrusel = mysqli_query($enlaces,$consultarCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
			            while($filaCar = mysqli_fetch_array($resultadoCarrusel)){
			                $xImagen		= $filaCar['imagen'];
				    ?>   
					<div><img src="cms/images/carrusel/<?php echo $xImagen ?>"></div>
					<?php
                        }
                        mysqli_free_result($resultadoCarrusel);
                    ?>
				</section>
			</div>
		</div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
    <script type='text/javascript' src='resources/cameraslider/scripts/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='resources/cameraslider/scripts/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='resources/cameraslider/scripts/camera.min.js'></script>
    <script>
		jQuery(function(){
			jQuery('#camera_wrap_1').camera({
				thumbnails: true,
				height: '40%'
			});
		});
	</script>
	<script src="resources/slick/slick.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).on('ready', function() {
			$(".regular").slick({
				dots: true,
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
	</script>
</body>
</html>