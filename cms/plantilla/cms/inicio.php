<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
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
        <?php $menu = "inicio"; $page = "metatags"; include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">P&aacute;gina de Inicio</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Metatags
			</div>
			<div class="wrp clearfix">
            	<?php $page = "metatags"; include("includes/menu-inicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Metatags</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<div class="alert alert-info alert-dismissible" role="alert">
                            	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Metatags son los nombres, descripción y palabras clave con las que apareceran su web para los buscadores y redes sociales
							</div>
                            <?php
								$consultarMet = 'SELECT * FROM metatags';
								$resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
								while($filaMet = mysqli_fetch_array($resultadoMet)){
									$xCodigo		= $filaMet['cod_meta'];
									$xLogo			= $filaMet['logo'];
									$xTitulo		= utf8_encode($filaMet['title']);
									$xDes			= utf8_encode($filaMet['description']);
									$xKey			= utf8_encode($filaMet['keywords']);
									$xUrl			= $filaMet['url'];
									$xFace1			= $filaMet['face1'];
									$xFace2			= $filaMet['face2'];
									$xIco			= $filaMet['ico'];
							?>
							<ul class="list-group">
                               	<li class="list-group-item">
                                    <p><strong>Título de la web:</strong></p>
                                    <p><?php echo $xTitulo; ?></p>
								</li>
                               	<li class="list-group-item">
                                    <p><strong>Logotipo de la web:</strong></p>
                                    <p><img class="thumbnail img-admin" src="images/meta/<?php echo $xLogo; ?>" />
                                    </p>
								</li>
                                <li class="list-group-item">
                                    <p><strong>Descripción:</strong></p>
                                    <p><?php echo $xDes; ?></p>
								</li>
								<li class="list-group-item">
									<p><strong>Palabras Clave:</strong></p>
									<p><?php echo $xKey; ?></p>
								</li>
								<li class="list-group-item">
									<p><strong>Url:</strong></p>
									<p>http://<?php echo $xUrl; ?></p>
								</li>
								<li class="list-group-item">
									<p><strong>Imagenes para redes sociales:</strong></p>
                                    <div id="listagaleria">
										<ul>
											<li><img class="thumbnail img-admin" src="http://<?php echo $xUrl; ?>/cms/images/meta/<?php echo $xFace1; ?>" /></li>
                                            <li><img class="thumbnail img-admin" src="http://<?php echo $xUrl; ?>/cms/images/meta/<?php echo $xFace2; ?>" /></li>
                                        </ul>
                                    </div>
								</li>
								<li class="list-group-item">
									<p><strong>Favicon:</strong></p>
									<p><img src="images/meta/<?php echo $xIco; ?>" /></p>
								</li>
							</ul>
                            <a href="metatags-edit.php?cod_meta=<?php echo $xCodigo; ?>" class="btn btn-green"><i class="fa fa-refresh"></i> Editar Metatags</a> 
							<?php
								}
								mysqli_free_result($resultadoMet);
							?>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>