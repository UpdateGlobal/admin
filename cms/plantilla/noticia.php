<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<?php $cod_noticia		= $_REQUEST['cod_noticia']; 
$num = "";?>
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
            <div class="col-lg-12">
                <h1 class="page-header">Noticias</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="noticias.php">Noticias</a></li>
					<?php 
						$consultaNoticia = "SELECT * FROM noticias WHERE cod_noticia='$cod_noticia'";
						$ejecutarNoticia = mysqli_query($enlaces,$consultaNoticia) or die('Consulta fallida: ' . mysqli_error($enlaces));
						$filaNot = mysqli_fetch_array($ejecutarNoticia);
							$cod_noticia = $filaNot['cod_noticia'];
							$imagen 		= $filaNot['imagen'];
							$titulo			= utf8_decode($filaNot['titulo']);
							$fecha			= $filaNot['fecha'];
							$noticia		= utf8_decode($filaNot['noticia']);
					?>
					<li class="active"><?php echo $titulo; ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $titulo; ?></h3>
                <p><i class="fa fa-clock-o"></i> Publicado el 
				<?php
					$mydate = strtotime($fecha);
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					echo utf8_decode($dias[date('w', $mydate)]." ".date('d', $mydate)." de ".$meses[date('n', $mydate)-1]. " del ".date('Y', $mydate));
				?>
                </p>
                <?php if($imagen!=""){ ?><img class="img-responsive imagen-noticia thumbnail" src="cms/images/noticias/<?php echo $imagen; ?>" alt=""><?php }else{ ?><?php } ?>
                <?php echo $noticia; ?>
                <a class="btn btn-default" href="noticias.php"><i class="fa fa-angle-double-left"></i> Volver</a>
            </div>
        </div>
        <hr>
        <?php include("includes/footer.php") ?>
    </div>
</body>
</html>
