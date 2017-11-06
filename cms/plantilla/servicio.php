<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<?php $cod_servicio		= $_REQUEST['cod_servicio']; 
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
                <h1 class="page-header">Nuestros Servicios</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="servicios.php">Servicios</a></li>
					<?php 
						$consultaServicios = "SELECT * FROM servicios WHERE cod_servicio='$cod_servicio'";
						$ejecutarServicios = mysqli_query($enlaces,$consultaServicios) or die('Consulta fallida: ' . mysqli_error($enlaces));
						$filaSer = mysqli_fetch_array($ejecutarServicios);
						$cod_servicio = $filaSer['cod_servicio'];
						$imagen 		= $filaSer['imagen'];
						$titulo			= utf8_decode($filaSer['titulo']);
						$descripcion	= utf8_decode($filaSer['descripcion']);
					?>
					<li class="active"><?php echo $titulo; ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
						<?php 
							$galeria="SELECT * FROM servicios_fotos WHERE cod_servicio='$cod_servicio'";
							$ejecutag=mysqli_query($enlaces, $galeria);
							$total_fotos = mysqli_num_rows($ejecutag);
							if($total_fotos==0){
								
							}else{ ?>
	                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <?php } ?>
							<?php while($filagp=mysqli_fetch_array($ejecutag)){
								$num++;
							?>
							<li data-target="#carousel-example-generic" data-slide-to="<?php echo $num++; ?>"></li>
                        <?php
							}
						?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="cms/images/servicios/<?php echo $imagen; ?>" alt="">
                        </div>
						<?php 
							$galeria="SELECT * FROM servicios_fotos WHERE cod_servicio='$cod_servicio'";
							$ejecutag=mysqli_query($enlaces, $galeria);
							while($filagp=mysqli_fetch_array($ejecutag)){
								$xImgG = $filagp['imagen'];
						?>
							<div class="item">
								<img class="img-responsive" src="cms/images/servicios/fotos/<?php echo $xImgG; ?>" alt="">
							</div>
						<?php 
							}
						?>
                    </div>
                    <?php 
						if($total_fotos==0){	
						
						}else{ ?>
                        	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
							</a>
							<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
							</a>
					<?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <h3><?php echo $titulo; ?></h3>
                <?php echo $descripcion; ?>
                <div class="clearfix"></div>
				<a class="btn btn-default" href="servicios.php"><i class="fa fa-angle-double-left"></i> Volver</a>
            </div>
        </div>
        <hr>
        <?php include("includes/footer.php") ?>
    </div>
</body>
</html>
