<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<?php 
$cod_producto = $_REQUEST['cod_producto'];
$cod_categoria = $_REQUEST['cod_categoria'];
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];

$productos = "SELECT * FROM productos WHERE cod_producto='$cod_producto'";
$ejecutarp = mysqli_query($enlaces, $productos);
$filap = mysqli_fetch_array($ejecutarp);
$xCodPro = $filap['cod_producto'];
$xCodCat = $filap['cod_categoria'];
$xCodSCat = $filap['cod_sub_categoria'];
$xNombre = utf8_decode($filap['nom_producto']);
$xDescripcion = utf8_decode($filap['descripcion']);

$xPrecioOf = $filap['precio_oferta'];
$xPrecioNo = $filap['precio_normal'];
$xImagen = $filap['imagen'];
$xFicha = $filap['ficha_tecnica'];
$xVideo = $filap['video'];
/*--------------------------------------*/
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
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
    <link href="resources/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
	<link href="resources/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
    <script>
		function Agregar(){
			document.fcarrito.action="verificar.php";
			valor=document.fcarrito.cantidad.value;
			if(isNaN(valor)||(valor=="")||(valor==0)){
				alert("Insertar una cantidad valida");
				return;
			}
			document.fcarrito.submit();
		}
	</script>
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
                    <li><a href="productos.php">Cat&aacute;logo</a></li>
                    <li><a href="sub-categoria.php?cod_categoria=<?php echo $codcat; ?>"><?php echo $nomcat; ?></a></li>
                    <li><a href="lista-productos.php?cod_categoria=<?php echo $codcat; ?>&cod_sub_categoria=<?php echo $codscat; ?>"><?php echo $nomscat; ?></a></li>
                    <li class="active"><strong><?php echo $xNombre; ?></strong></li>
                </ol>
            </div>
        </div>
	</div>
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
				<h3 class="page-header">Cat&aacute;logo : <?php echo $nomcat; ?> / <?php echo $nomscat; ?> / <?php echo $xNombre; ?></h3>
            </div>
        </div>
		<div class="row">
        	<form name="fcarrito" action="" method="post">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div id="imagen-prod">
                	<a class="jackbox" data-group="grupo<?php echo $xCodPro; ?>" href="cms/images/productos/<?php echo $xImagen; ?>">
	             		<img class="img-responsive thumbnail" src="cms/images/productos/<?php echo $xImagen; ?>" />
                    </a>
					<ul class="jackbox-hidden-items">
                    	<?php 
							$galeria="SELECT * FROM productos_galeria WHERE cod_producto='$cod_producto'";
                            $ejecutag=mysqli_query($enlaces, $galeria);
                            while($filagp=mysqli_fetch_array($ejecutag)){
                            	$xImgG = $filagp['imagen'];
						?>
							<li class="jackbox img-responsive" data-group="grupo<?php echo $xCodPro; ?>" data-thumbnail="cms/images/productos/galeria/<?php echo $xImgG; ?>" data-href="cms/images/productos/galeria/<?php echo $xImgG; ?>"></li>
						<?php 
							}
						?>
					</ul>
				</div>
            </div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div id="detalles">
                	<h1><?php echo $xNombre; ?></h1>
                    <p class="preciodetalle">Normal : $. <?php echo number_format($xPrecioNo,2); ?></p>
                    <p class="preciodetalleoferta">Oferta : $. <?php echo number_format($xPrecioOf,2); ?></p>
                    <article id="texdetalles">
                    	<?php echo $xDescripcion; ?>
					</article>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <strong>Cantidad:</strong>
                            <input class="form-control" type="text" name="cantidad" id="cantidad" value="1">
                            <input type="hidden" name="cod_producto" id="cod_producto" value="<?php echo $xCodPro; ?>" />
                            <input type="hidden" name="cod_categoria" id="cod_categoria" value="<?php echo $xCodCat; ?>" />
                            <input type="hidden" name="cod_sub_categoria" id="cod_sub_categoria" value="<?php echo $xCodSCat; ?>" />
                        </div>
                    </div>
                    <div class="clearfix" style="height:20px;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="javascript:Agregar();" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> A&ntilde;adir al Carrito</a>
                            <?php 
                                if($xFicha<>""){
                            ?>
                            <a href="cms/archivos/<?php echo $xFicha; ?>" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver Ficha Tecnica</a>
                            <?php 						
                                }
                            ?>
                            <?php 
							if($xVideo<>""){
							?>
		                    <a class="jackbox btn btn-info" data-group="grupo" href="<?php echo $xVideo; ?>"><i class="fa fa-video-camera"></i> Ver video</a>
        		            <?php
								}
							?>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="height:10px;"></div>
                <a class="btn btn-default" href="lista-productos.php?cod_categoria=<?php echo $codcat; ?>&cod_sub_categoria=<?php echo $codscat; ?>"><i class="fa fa-angle-double-left"></i> Volver</a>
            </div>
            </form>
        </div>
		<div class="clearfix"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
    <script type="text/javascript" src="resources/jackbox/js/libs/jquery.address-1.5.min.js"></script>
	<script type="text/javascript" src="resources/jackbox/js/libs/Jacked.js"></script>
	<script type="text/javascript" src="resources/jackbox/js/jackbox-swipe.js"></script>
	<script type="text/javascript" src="resources/jackbox/js/jackbox.js"></script>
	<script type="text/javascript" src="resources/jackbox/js/libs/StackBlur.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".jackbox[data-group]").jackBox("init");
		});
	</script>
</body>
</html>