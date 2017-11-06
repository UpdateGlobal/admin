<?php include("modulos/conexion.php"); ?>
<?php include("modulos/verificar.php"); ?>
<?php include "modulos/clean.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
</head>
<body>
	<div id="loading">
		<div>
			<div></div>
		    <div></div>
		    <div></div>
		</div>
	</div>
	<div id="wrapper">
        <?php include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">P&aacute;gina de Nosotros</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-info"></i> Nosotros 
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12" style="margin-top:0px;">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Nosotros</strong>
							</div>
						</div>
						<div class="widget-content">
                            <?php
								$consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='1'";
								$resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
								while($filaCon = mysqli_fetch_array($resultadoCon)){
									$xCodigo		= $filaCon['cod_contenido'];
									$xTitulo		= utf8_encode($filaCon['titulo_contenido']);
									$xImagen		= $filaCon['img_contenido'];
									$xContenido		= utf8_encode($filaCon['contenido']);
									$xEstado		= $filaCon['estado'];
							?>
							<div <?php if($xImagen!=""){?>class="grid8" <?php }else{ ?> class="grid12"<?php } ?>>
                                <p><strong><?php echo $xTitulo; ?></strong></p>
                                <p><?php 
								$strCut = substr($xContenido,0,800);
								$xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
								echo strip_tags($xContenido);
								?>
								</p>
                                <hr>
                                <div class="clearfix">
                                    <p><strong><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> [<?php echo $xEstado; ?>]</strong></p>
                                </div>
                            </div>
							<?php if($xImagen!=""){?>
							<div class="grid4">
            	                <p><img class="thumbnail img-admin" src="images/nosotros/<?php echo $xImagen; ?>" /></p>
                            </div>
							<?php }else{ ?>
							
							<?php } ?>
							<?php
								}
								mysqli_free_result($resultadoCon);
							?>
                            <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Descripci&oacute;n</a>
						</div>
                    </div>
                </div>
                <div class="fluid">
                    <div class="widget grid4">
						<?php
                            $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='2'";
                            $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                            while($filaCon = mysqli_fetch_array($resultadoCon)){
                                $xCodigo		= $filaCon['cod_contenido'];
                                $xTitulo		= utf8_encode($filaCon['titulo_contenido']);
                                $xImagen		= $filaCon['img_contenido'];
                                $xContenido		= utf8_encode($filaCon['contenido']);
                                $xEstado		= $filaCon['estado'];
                        ?>
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Misi&oacute;n</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<p><strong><?php echo $xTitulo; ?></strong></p>
                            <?php if($xImagen!=""){?>
                            <p><img class="thumbnail img-admin" src="images/nosotros/<?php echo $xImagen; ?>" /></p>
                            <?php }else{ ?>
                            <?php } ?>
                            <p><?php 
								$strCut = substr($xContenido,0,200);
								$xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
								echo strip_tags($xContenido);
							?></p>
                            <hr>
                            <div class="clearfix">
                            	<p><strong><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> [<?php echo $xEstado; ?>]</strong></p>
                            </div>
                            <?php
								}
								mysqli_free_result($resultadoCon);
							?>
	                        <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Misi&oacute;n</a>
                        </div>
                    </div>
                    <div class="widget grid4">
						<?php
                            $consultarCon = 'SELECT * FROM `contenidos` WHERE `cod_contenido` = 3';
                            $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                            while($filaCon = mysqli_fetch_array($resultadoCon)){
                                $xCodigo		= $filaCon['cod_contenido'];
                                $xTitulo		= utf8_encode($filaCon['titulo_contenido']);
                                $xImagen		= $filaCon['img_contenido'];
                                $xContenido		= utf8_encode($filaCon['contenido']);
                                $xEstado		= $filaCon['estado'];
                        ?>
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Visi&oacute;n</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<p><strong><?php echo $xTitulo; ?></strong></p>
                            <?php if($xImagen!=""){?>
                            <p><img class="thumbnail img-admin" src="images/nosotros/<?php echo $xImagen; ?>" /></p>
                            <?php }else{ ?>
                            <?php }?>
                            <p><?php 
								$strCut = substr($xContenido,0,200);
								$xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
								echo strip_tags($xContenido);
							?></p>
                            <hr>
                            <div class="clearfix">
                            	<p><strong><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> [<?php echo $xEstado; ?>]</strong></p>
                            </div>
							<?php
                                }
                                mysqli_free_result($resultadoCon);
                            ?>
                            <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Visi&oacute;n</a>
                        </div>
                    </div>
                    <div class="widget grid4">
						<?php
                            $consultarCon = 'SELECT * FROM `contenidos` WHERE `cod_contenido` = 4';
                            $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                            while($filaCon = mysqli_fetch_array($resultadoCon)){
                                $xCodigo		= $filaCon['cod_contenido'];
                                $xTitulo		= utf8_encode($filaCon['titulo_contenido']);
                                $xImagen		= $filaCon['img_contenido'];
                                $xContenido		= utf8_encode($filaCon['contenido']);
                                $xEstado		= $filaCon['estado'];
                        ?>
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Objetivos</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<p><strong><?php echo $xTitulo; ?></strong></p>
                            <?php if($xImagen!=""){?>
                            <p><img class="thumbnail img-admin" src="images/nosotros/<?php echo $xImagen; ?>" /></p>
                            <?php }else{ ?>
                            <?php } ?>
                            <p><?php 
								$strCut = substr($xContenido,0,200);
								$xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
								echo strip_tags($xContenido);
							?></p>
                            <hr>
                            <div class="clearfix">
                            	<p><strong><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> [<?php echo $xEstado; ?>]</strong></p>
                            </div>
							<?php
                                }
                                mysqli_free_result($resultadoCon);
                            ?>
                            <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Objetivos</a>
                        </div>                        
                    </div>
                </div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>