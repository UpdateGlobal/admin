<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<?php
$cod_categoria = $_REQUEST['cod_categoria'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <link rel="stylesheet" href="resources/slick/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="resources/slick/slick-theme.css" type="text/css" media="all">
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
                <?php 
					$categoria = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
					$resultCat = mysqli_query($enlaces, $categoria);
					$filaCat = mysqli_fetch_array($resultCat);
				?>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php">Cat&aacute;logo</a></li>
                    <li class="active"><strong><?php echo $filaCat['categoria']; ?></strong></li>
                </ol>
            </div>
        </div>
		<?php 
			$banners = "SELECT * FROM productos WHERE banner_chico<>'' AND estado='Activo' ORDER BY RAND() LIMIT 0,1";
			$ejecutarBanner = mysqli_query($enlaces, $banners);
			$filab=mysqli_fetch_array($ejecutarBanner);
				$xcodcat = $filab['cod_categoria'];
				$xcodscat = $filab['cod_sub_categoria'];
				$xcodigo = $filab['cod_producto'];
				$ximagen = $filab['banner_chico'];
		?>
		<a href="producto-detalle.php?cod_categoria=<?php echo $xcodcat; ?>&cod_sub_categoria=<?php echo $xcodscat; ?>&cod_producto=<?php echo $xcodigo; ?>">
			<img class="img-responsive" src="cms/images/productos/bannerc/<?php echo $ximagen; ?>" />
		</a>
	</div>
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
                <h2 class="page-header">Cat&aacute;logo : <?php echo $filaCat['categoria']; ?></h2>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<section class="regular slider">
					<?php 
						$subcategoria = "SELECT * FROM productos_sub_categorias WHERE estado='Activo' AND cod_categoria='$cod_categoria'";
						$resultadosc=mysqli_query($enlaces, $subcategoria);
						while($filasc=mysqli_fetch_array($resultadosc)){
							$xCodC=$filasc['cod_categoria'];
							$xCodSc=$filasc['cod_sub_categoria'];
							$xSubCa=$filasc['subcategoria'];
							$xImgSc=$filasc['imagen'];
					?>
                    <div class="text-center">
                        <a href="lista-productos.php?cod_categoria=<?php echo $xCodC; ?>&cod_sub_categoria=<?php echo $xCodSc; ?>"><img class="thumbnail" src="cms/images/productos/subcategoria/<?php echo $xImgSc; ?>"></a>
                        <h4><?php echo $xSubCa; ?></h4>
                        <p><a href="lista-productos.php?cod_categoria=<?php echo $xCodC; ?>&cod_sub_categoria=<?php echo $xCodSc; ?>" class="btn btn-primary">Ver Productos</a></p>
                    </div>
					<?php 
						}
					?>
				</section>            
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <a class="btn btn-default" href="productos.php"><i class="fa fa-angle-double-left"></i> Volver</a>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
    <script src="resources/slick/slick.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).on('ready', function() {
		  $(".regular").slick({
			dots: true,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 3,
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