<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<link href="resources/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
	<link href="resources/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php
		$consultarVideos = "SELECT * FROM videos WHERE estado='Activo'";
		$resultadoVideos = mysqli_query($enlaces, $consultarVideos);
		$total_registros = mysqli_num_rows($resultadoVideos);
		$registros_por_paginas = 9;
		$total_paginas = ceil($total_registros/$registros_por_paginas);
		$pagina = intval($_GET['p']);
		if($pagina<1 or $pagina>$total_paginas){
			$pagina=1;
		}
		$posicion = ($pagina-1)*$registros_por_paginas;
		$limite = "LIMIT $posicion, $registros_por_paginas";

		$consultarVideos = "SELECT * FROM videos WHERE estado='Activo' ORDER BY orden ASC $limite";
		$resultadoVideos = mysqli_query($enlaces,$consultarVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaVid = mysqli_fetch_array($resultadoVideos)){
			$xCodigo		= $filaVid['cod_video'];
			$xTitulo		= utf8_decode($filaVid['titulo']);
			$xDescripcion	= utf8_decode($filaVid['descripcion']);
	?>
    <div class="jackbox-description" id="description_<?php echo $xCodigo; ?>">
    	<div class="titulo-grafica row-per">
        	<h3><?php echo $xTitulo; ?></h3>
            <div class="cl"></div>
		</div>
        <div class="row-per" style="margin-bottom:0px;">
    	    <strong>DESCRIPCI&Oacute;N:</strong>
        	<div class="cl"></div>
	        <p class="parrafo"><?php echo $xDescripcion; ?></p>
	        <div class="cl"></div>
		</div>
	</div>
	<?php
		}
        mysqli_free_result($resultadoVideos);
    ?>
	<div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Galer&iacute;as de Videos</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Galer&iacute;a de Videos</li>
                </ol>
            </div>
        </div>
        <div class="row">
			<?php
				$consultarVideos = "SELECT * FROM videos WHERE estado='Activo'";
				$resultadoVideos = mysqli_query($enlaces, $consultarVideos);
				$total_registros = mysqli_num_rows($resultadoVideos);
				$registros_por_paginas = 9;
				$total_paginas = ceil($total_registros/$registros_por_paginas);
				$pagina = intval($_GET['p']);
				if($pagina<1 or $pagina>$total_paginas){
					$pagina=1;
				}
				$posicion = ($pagina-1)*$registros_por_paginas;
				$limite = "LIMIT $posicion, $registros_por_paginas";

			    $consultarVideos = "SELECT * FROM videos WHERE estado='Activo' ORDER BY orden ASC $limite";
				$resultadoVideos = mysqli_query($enlaces,$consultarVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaVid = mysqli_fetch_array($resultadoVideos)){
					$xCodigo		= $filaVid['cod_video'];
					$xTitulo		= utf8_decode($filaVid['titulo']);
					$xImagen		= $filaVid['imagen'];
					$xVideo			= $filaVid['video'];
			?>
			<div class="col-md-4 img-portfolio">
				<a class="jackbox" data-group="videos<?php echo $xCodigo; ?>" data-thumbnail="cms/images/videos/<?php echo $xImagen; ?>" data-description="#description_<?php echo $xCodigo; ?>" data-thumbTooltip="<?php echo $xTitulo; ?>" data-title="<?php echo $xTitulo; ?>" href="<?php echo $xVideo; ?>">
					<div class="jackbox-hover jackbox-hover-black jackbox-hover-play">
						<p><?php echo $xTitulo; ?></p>
					</div>
					<img class="img-responsive img-hover" src="cms/images/videos/<?php echo $xImagen; ?>" />
				</a>
				<h3 class="text-center"><?php echo $xTitulo; ?></h3>
            </div>
			<?php
				}
                mysqli_free_result($resultadoVideos);
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
					echo "	<li><a href='?p=".($pagina+1)."'>&raquo;</a></li>";
					
				}
				echo "	</ul>
					</div>
				</div>
			<hr>";
			}
		?>
        <hr>
        <?php include("includes/footer.php") ?>
		<script type="text/javascript" src="resources/jackbox/js/libs/jquery.address-1.5.min.js"></script>
		<script type="text/javascript" src="resources/jackbox/js/libs/Jacked.js"></script>
		<script type="text/javascript" src="resources/jackbox/js/jackbox-swipe.js"></script>
		<script type="text/javascript" src="resources/jackbox/js/jackbox.js"></script>
		<script type="text/javascript" src="resources/jackbox/js/libs/StackBlur.js"></script>
		<script type="text/javascript">
			/*jQuery(document).ready(function() {
				jQuery(".jackbox[data-group]").jackBox("init");
				
			});*/
			jQuery(".jackbox[data-group]").jackBox("init", {
				
					deepLinking: false,              // choose to use the deep-linking feature ("true" will enhance social sharing!) true/false
					showInfoByDefault: false,       // show item info automatically when content loads, true/false
					autoPlayVideo: true,           // video autoplay default, this can also be set per video in the data-attributes, true/false
					
				});
		</script>
    </div>
</body>
</html>
