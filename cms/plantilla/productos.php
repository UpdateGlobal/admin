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
    <div class="container">
	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nuestros Productos</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Cat&aacute;logo</strong></li>
                </ol>
            </div>
        </div>
	</div>
    <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
		<?php
			$consultarBanner = "SELECT * FROM productos WHERE banner_grande<>'' AND estado='Activo' ORDER BY RAND() LIMIT 0,3";
			$resultadoBanner = mysqli_query($enlaces,$consultarBanner) or die('Consulta fallida: ' . mysqli_error($enlaces));
			while($filab = mysqli_fetch_array($resultadoBanner)){
				$xcodcat = $filab['cod_categoria'];
				$xcodscat = $filab['cod_sub_categoria'];
				$xcodigo = $filab['cod_producto'];
				$ximagen = $filab['banner_chico'];
				$xnombre = utf8_decode($filab['nom_producto']);
				$xdescripcion = $filab['descripcion'];
		?>
		<div data-thumb="cms/images/productos/bannerg/<?php echo $ximagen; ?>" data-src="cms/images/productos/bannerg/<?php echo $ximagen; ?>">
			<div class="camera_caption fadeFromBottom">
				<div class="row">
					<div class="container">
						<div class="col-lg-12">
							<h4><a href="detalle-productos.php?cod_categoria=<?php echo $xcodcat; ?>&cod_sub_categoria=<?php echo $xcodscat; ?>&cod_producto=<?php echo $xcodigo; ?>"><?php echo $xnombre; ?></a></h4>
							<?php 
								$strCut = substr($xdescripcion,0,200);
								$xdescripcion = substr($strCut,0,strrpos($strCut, ' ')).'...';
							?>
							<p><?php echo strip_tags($xdescripcion); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
			mysqli_free_result($resultadoBanner);
		?>
	</div>
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
                <h2 class="page-header">Cat&aacute;logo</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<section class="regular slider">
					<?php 
                        $categoria = "SELECT * FROM productos_categorias WHERE estado='Activo'";
                        $resultadoCat=mysqli_query($enlaces,$categoria);
                        while($filacat=mysqli_fetch_array($resultadoCat)){
                            $xCodCat = $filacat['cod_categoria'];
                            $xCat = $filacat['categoria'];
                            $xImgCat = $filacat['imagen'];
                    ?>
                    <div class="text-center">
                        <a href="sub-categoria.php?cod_categoria=<?php echo $xCodCat; ?>"><img class="thumbnail" src="cms/images/productos/categorias/<?php echo $xImgCat; ?>"></a>
                        <h4><?php echo $xCat; ?></h4>
                        <p><a href="sub-categoria.php?cod_categoria=<?php echo $xCodCat; ?>" class="btn btn-primary">Ver Categoria</a></p>
                    </div>
					<?php
                        }
                    ?>
				</section>            
            </div>
        </div>
		<div class="clearfix"></div>
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
	<script src="resources/slick/slick.js" type="text/javascript" charset="utf-8"></script>
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
							slidesToScroll: 1
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