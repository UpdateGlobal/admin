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
	<div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Galer&iacute;as de Im&aacute;genes</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Galer&iacute;a de Im&aacute;genes</li>
                </ol>
            </div>
        </div>
        <div class="row">
			<?php
				$consultarGal = "SELECT * FROM galerias WHERE estado='Activo'";
				$resultadoGal = mysqli_query($enlaces, $consultarGal);
				$total_registros = mysqli_num_rows($resultadoGal);
				$registros_por_paginas = 10;
				$total_paginas = ceil($total_registros/$registros_por_paginas);
				$pagina = intval($_GET['p']);
				if($pagina<1 or $pagina>$total_paginas){
					$pagina=1;
				}
				$posicion = ($pagina-1)*$registros_por_paginas;
				$limite = "LIMIT $posicion, $registros_por_paginas";
						
			    $consultarGal = "SELECT * FROM galerias ORDER BY orden ASC $limite";
				$resultadoGal = mysqli_query($enlaces,$consultarGal) or die('Consulta fallida: ' . mysqli_error($enlaces));
				while($filaGal = mysqli_fetch_array($resultadoGal)){
					$xCodigo		= $filaGal['cod_galeria'];
					$xNomGal		= $filaGal['titulo'];
					$xImagen		= $filaGal['imagen'];
			?>
			<div class="col-md-4 img-portfolio">
				<a class="jackbox" data-group="images<?php echo $xCodigo; ?>" data-thumbnail="cms/images/galerias/<?php echo $xImagen; ?>" data-thumbTooltip="<?php echo $xNomGal; ?>" data-title="<?php echo $xNomGal; ?>" href="cms/images/galerias/<?php echo $xImagen; ?>">
					<div class="jackbox-hover jackbox-hover-black jackbox-hover-magnify">
						<p><?php echo $xNomGal; ?></p>
					</div>
					<img class="img-responsive img-hover" src="cms/images/galerias/<?php echo $xImagen; ?>" />
				</a>
				<h3 class="text-center"><?php echo $xNomGal; ?></h3>
				<ul class="jackbox-hidden-items">
					<?php 
						$galeria="SELECT * FROM galerias_fotos WHERE cod_galeria='$xCodigo'";
						$fotos=mysqli_query($enlaces,$galeria);
						while($filaf=mysqli_fetch_array($fotos)){
							$xCodigo	= $filaf['cod_galeria'];
							$xImgG 		= $filaf['imagen'];
					?>
					<li class="jackbox" data-group="images<?php echo $xCodigo; ?>" data-title="<?php echo $xNomGal; ?>" data-thumbnail="cms/images/galerias/fotos/<?php echo $xImgG; ?>" data-href="cms/images/galerias/fotos/<?php echo $xImgG; ?>"></li>
					<?php 
						}
						mysqli_free_result($fotos);
					?>
				</ul>
            </div>
			<?php
				}
                mysqli_free_result($resultadoGal);
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
			jQuery(document).ready(function() {
				jQuery(".jackbox[data-group]").jackBox("init");
			});
		</script>
    </div>
</body>
</html>
