<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<?php
$cod_categoria = $_REQUEST['cod_categoria'];
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];
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
					$categ = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'"; 
                    $rescat = mysqli_query($enlaces, $categ);
					$filact = mysqli_fetch_array($rescat);
					$codcat = $filact['cod_categoria'];
					$nomcat = $filact['categoria'];
					/*----------------------------------------*/
					$scateg = "SELECT * FROM productos_sub_categorias WHERE cod_sub_categoria='$cod_sub_categoria'"; 
                    $resscat = mysqli_query($enlaces, $scateg);
					$filasct = mysqli_fetch_array($resscat);
					$codscat = $filasct['cod_sub_categoria'];
					$nomscat = $filasct['subcategoria'];
				?>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php">Cat&aacute;logo</a></li>
                    <li><a href="sub-categoria.php?cod_categoria=<?php echo $codcat; ?>"><?php echo $nomcat; ?></a></li>
                    <li class="activo"><strong><?php echo $nomscat; ?></strong></li>
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
				$xnombre = utf8_decode($filab['nom_producto']);
		?>
		<a href="producto-detalle.php?cod_categoria=<?php echo $xcodcat; ?>&cod_sub_categoria=<?php echo $xcodscat; ?>&cod_producto=<?php echo $xcodigo; ?>">
			<img class="img-responsive" src="cms/images/productos/bannerc/<?php echo $ximagen; ?>" />
		</a>
	</div>
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
                <h2 class="page-header">Cat&aacute;logo : <?php echo $nomcat; ?> / <?php echo $nomscat; ?></h2>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<section class="regular slider">
					<?php 
						$productos="SELECT * FROM productos WHERE estado='Activo' AND cod_sub_categoria='$cod_sub_categoria'";
						$resultadop=mysqli_query($enlaces, $productos);
						$numfilas = mysqli_num_rows($resultadop);
						$maxslinea= ceil($numfilas/5);
						$numslide=1;
						$numitem=0;
						while($numslide<=$maxslinea){
					?>
                    
	                    <?php 
							while($filap=mysqli_fetch_array($resultadop)){
								$xCodPro=$filap['cod_producto'];
								$xImgPro=$filap['imagen'];
								$xNomPro=substr(utf8_decode($filap['nom_producto']),0,20);
								if($filap['precio_oferta']>=1){
									$pmostrar = number_format($filap['precio_oferta'],2);
								}else{
									$pmostrar = number_format($filap['precio_normal'],2);
								}
						?>
                        <div class="text-center">
                        	<a href="producto-detalle.php?cod_categoria=<?php echo $codcat; ?>&cod_sub_categoria=<?php echo $codscat; ?>&cod_producto=<?php echo $xCodPro; ?>"><img class="thumbnail" src="cms/images/productos/<?php echo $xImgPro; ?>"></a>
							<h4><?php echo $xNomPro; ?></h4>
	                    	<p class="precio"><strong>$. <?php echo $pmostrar; ?></strong></p>
                        	<p><a href="producto-detalle.php?cod_categoria=<?php echo $codcat; ?>&cod_sub_categoria=<?php echo $codscat; ?>&cod_producto=<?php echo $xCodPro; ?>" class="btn btn-primary">Ver Producto</a></p>
                        </div>
	                    <?php 
								$numitem++;
							}
						$numitem=0;
						$numslide++;
					}
				?>
				</section>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <a class="btn btn-default" href="sub-categoria.php?cod_categoria=<?php echo $codcat; ?>"><i class="fa fa-angle-double-left"></i> Volver</a>
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