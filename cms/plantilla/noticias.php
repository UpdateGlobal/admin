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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-header">Noticias</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active">Noticias</li>
                </ol>
            </div>
        </div>
        <div class="row">
			<?php
				$consultarNoticias = "SELECT * FROM noticias WHERE estado='Activo'";
				$resultadoNoticias = mysqli_query($enlaces, $consultarNoticias);
				$total_registros = mysqli_num_rows($resultadoNoticias);
				$registros_por_paginas = 10;
				$total_paginas = ceil($total_registros/$registros_por_paginas);
				$pagina = intval($_GET['p']);
				if($pagina<1 or $pagina>$total_paginas){
					$pagina=1;
				}
				$posicion = ($pagina-1)*$registros_por_paginas;
				$limite = "LIMIT $posicion, $registros_por_paginas";
						
			    $consultarNoticias = "SELECT * FROM noticias ORDER BY fecha ASC $limite";
			    $resultadoNoticias = mysqli_query($enlaces,$consultarNoticias) or die('Consulta fallida: ' . mysqli_error($enlaces));
			    while($filaNot = mysqli_fetch_array($resultadoNoticias)){
			        $xCodigo		= $filaNot['cod_noticia'];
					$xTitulo		= utf8_decode($filaNot['titulo']);
			        $xImagen		= $filaNot['imagen'];
					$xNoticia		= $filaNot['noticia'];
					$xFecha			= $filaNot['fecha'];
			?>
            <?php if($xImagen!=""){ ?>
            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                <a href="noticia.php?cod_noticia=<?php echo $xCodigo; ?>">
                    <img class="img-responsive thumbnail img-hover" src="cms/images/noticias/<?php echo $xImagen; ?>" />
                </a>
            </div>
            <?php }else{ ?>
            <?php } ?>
            <div class="<?php if($xImagen!=""){ ?>col-lg-10 col-md-9 col-sm-12 col-xs-12<?php }else{ ?>col-lg-12 col-md-12 col-sm-12 col-xs-12<?php } ?> descripcion">
                <h3><a href="noticia.php?cod_noticia=<?php echo $xCodigo; ?>"><?php echo $xTitulo; ?></a></h3>
				<p><i class="fa fa-clock-o"></i> Publicado el 
                <?php
					$mydate = strtotime($xFecha);
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					echo utf8_decode($dias[date('w', $mydate)]." ".date('d', $mydate)." de ".$meses[date('n', $mydate)-1]. " del ".date('Y', $mydate));
				?>
                </p>
                <p class="text-justify"><?php 
						$strCut = substr($xNoticia,0,320);
						$xNoticia = substr($strCut,0,strrpos($strCut, ' ')).'...';
						echo strip_tags($xNoticia);
					?>
				</p>
				<div class="clearfix"></div>
                <a class="btn btn-primary" href="noticia.php?cod_noticia=<?php echo $xCodigo; ?>">Leer m&aacute;s <i class="fa fa-angle-right"></i></a>
				<div class="clearfix"></div>
            </div>
			<div class="clearfix" style="height:30px;"></div>
			<?php 
				}
                mysqli_free_result($resultadoNoticias);
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
        <!-- Footer -->
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>
