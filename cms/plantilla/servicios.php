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
            <div class="col-lg-12">
                <h1 class="page-header">Nuestros Servicios</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Servicios</li>
                </ol>
            </div>
        </div>
        <div class="row">
			<?php
				$consultarServicios = "SELECT * FROM servicios WHERE estado='Activo'";
				$resultadoServicios = mysqli_query($enlaces, $consultarServicios);
				$total_registros = mysqli_num_rows($resultadoServicios);
				$registros_por_paginas = 8;
				$total_paginas = ceil($total_registros/$registros_por_paginas);
				$pagina = intval($_GET['p']);
				if($pagina<1 or $pagina>$total_paginas){
					$pagina=1;
				}
				$posicion = ($pagina-1)*$registros_por_paginas;
				$limite = "LIMIT $posicion, $registros_por_paginas";
						
			    $consultarServicios = "SELECT * FROM servicios ORDER BY orden ASC $limite";
			    $resultadoServicios = mysqli_query($enlaces,$consultarServicios) or die('Consulta fallida: ' . mysqli_error($enlaces));
			    while($filaSer = mysqli_fetch_array($resultadoServicios)){
			        $xCodigo		= $filaSer['cod_servicio'];
					$xTitulo		= utf8_decode($filaSer['titulo']);
			        $xImagen		= $filaSer['imagen'];
					$xDescripcion	= utf8_decode($filaSer['descripcion']);
			?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 img-portfolio">
                <a href="servicio.php?cod_servicio=<?php echo $xCodigo; ?>">
                    <img class="img-responsive img-hover" src="cms/images/servicios/<?php echo $xImagen; ?>" alt="">
                </a>
                <h3><a href="servicio.php?cod_servicio=<?php echo $xCodigo; ?>"><?php echo $xTitulo; ?></a></h3>
                <p class="text-justify"><?php 
						$strCut = substr($xDescripcion,0,200);
						$xDescripcion = substr($strCut,0,strrpos($strCut, ' ')).'...';
						echo strip_tags($xDescripcion);
					?></p>
            </div>
			<?php 
				}
                mysqli_free_result($resultadoServicios);
			?>
        </div>
        <div class="clearfix"></div>
		<?php		
			$paginas_mostrar = 10;
			if ($total_paginas>1){
				echo "<div class='row text-center'>
					<div class='col-lg-12'>
						<ul class='pagination'>";
				if($pagina>1){
					echo "<li><a href='?p=1'>Inicio</a></li>";
					echo "<li><a href='?p=".($pagina-1)."'>&laquo;</a></li>";
				}
				for($i=$pagina; $i<=$total_paginas && $i<=($pagina+$paginas_mostrar); $i++){
					if($i==$pagina){
						echo "<li class='active'><a><strong>$i</strong></a></li>";
					}else{
						echo "<li><a href='?p=$i'>$i</a></li>";
					}
				}
				if(($pagina+$paginas_mostrar)<$total_paginas){
					echo "<li>...</li>";
				}
				if($pagina<$total_paginas){
					echo "<li><a href='?p=".($pagina+1)."'>&raquo;</a></li>";
					echo "<li><a href='?p=$total_paginas'>Fin</a></li>";
				}
				echo "	</ul>
					</div>
				</div>
	        <hr>";
			}
		?>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>
