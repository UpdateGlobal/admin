<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
</head>
<body>
    <div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
        <div class="row">
			<?php
				$consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='1' AND estado='Activo'";
				$resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaCon = mysqli_fetch_array($resultadoCon)){
					$xCodigo		= $filaCon['cod_contenido'];
					$xTitulo		= $filaCon['titulo_contenido'];
					$xImagen		= $filaCon['img_contenido'];
					$xContenido		= $filaCon['contenido'];
					$xEstado		= $filaCon['estado'];
			?>
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $xTitulo; ?></h1>
                <ol class="breadcrumb">
                    <li>
						<a href="index.php">Inicio</a>
                    </li>
                    <li class="active"><?php echo $xTitulo; ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="<?php if($xImagen!=""){ ?>col-lg-7 col-md-6 col-sm-12 col-xs-12<?php }else{ ?>col-lg-12 col-md-12 col-sm-12 col-xs-12<?php } ?>">
				<p><?php echo $xContenido; ?></p>
            </div>
            <?php if($xImagen!=""){ ?>
			<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
				<img class="thumbnail img-responsive" src="cms/images/nosotros/<?php echo $xImagen; ?>" />
            </div>
            <?php }else{ ?>
            <?php } ?>
			<?php
				}
				mysqli_free_result($resultadoCon);
			?>
        </div>
		<div class="clearfix" style="height:40px;" ></div>
		<div class="row">
			<?php
				$consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='2' AND estado='Activo'";
				$resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaCon = mysqli_fetch_array($resultadoCon)){
					$xCodigo		= $filaCon['cod_contenido'];
					$xTitulo		= $filaCon['titulo_contenido'];
					$xImagen		= $filaCon['img_contenido'];
					$xContenido		= $filaCon['contenido'];
					$xEstado		= $filaCon['estado'];
			?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-body text-justify">
						<?php if($xImagen!=""){ ?><img class="thumbnail img-responsive" src="cms/images/nosotros/<?php echo $xImagen; ?>" /><?php }else{ ?><?php } ?>
						<h4><?php echo $xTitulo; ?></h4>
						<p><?php echo $xContenido; ?></p>
					</div>
				</div>
			</div>
			<?php
				}
				mysqli_free_result($resultadoCon);
			?>
			<?php
				$consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='3' AND estado='Activo'";
				$resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaCon = mysqli_fetch_array($resultadoCon)){
					$xCodigo		= $filaCon['cod_contenido'];
					$xTitulo		= $filaCon['titulo_contenido'];
					$xImagen		= $filaCon['img_contenido'];
					$xContenido		= $filaCon['contenido'];
					$xEstado		= $filaCon['estado'];
			?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-body text-justify">
						<?php if($xImagen!=""){ ?><img class="thumbnail img-responsive" src="cms/images/nosotros/<?php echo $xImagen; ?>" /><?php }else{?><?php }?>
						<h4><?php echo $xTitulo; ?></h4>
						<p><?php echo $xContenido; ?></p>
					</div>
				</div>
			</div>
			<?php
				}
				mysqli_free_result($resultadoCon);
			?>
			<?php
				$consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='4' AND estado='Activo'";
				$resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaCon = mysqli_fetch_array($resultadoCon)){
					$xCodigo		= $filaCon['cod_contenido'];
					$xTitulo		= $filaCon['titulo_contenido'];
					$xImagen		= $filaCon['img_contenido'];
					$xContenido		= $filaCon['contenido'];
					$xEstado		= $filaCon['estado'];
			?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-body text-justify">
						<?php if($xImagen!=""){ ?><img class="thumbnail img-responsive" src="cms/images/nosotros/<?php echo $xImagen; ?>" /><?php }else{ ?><?php } ?>
						<h4><?php echo $xTitulo; ?></h4>
						<p><?php echo $xContenido; ?></p>
					</div>
				</div>
			</div>
			<?php
				}
				mysqli_free_result($resultadoCon);
			?>
		</div>
		
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>
