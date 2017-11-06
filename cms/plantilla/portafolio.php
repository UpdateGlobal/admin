<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<link href="css/isotope-buttons.css" rel="stylesheet" type="text/css" />
	<link href="resources/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
	<link href="resources/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
</head>
<body class="index-page" data-page="index">
	<?php
    	$consultarPor = "SELECT cp.cod_categoria, cp.categoria, p.* FROM portafolio_categorias as cp, portafolio as p WHERE p.cod_categoria=cp.cod_categoria AND p.estado='Activo' ORDER BY orden";
		$resultadoPor = mysqli_query($enlaces,$consultarPor) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaPor = mysqli_fetch_array($resultadoPor)){
			$xCodigo		= $filaPor['cod_portafolio'];
			$xCategoria		= $filaPor['categoria'];
			$xNomPorta		= $filaPor['nom_portafolio'];
			$xDescripcion	= $filaPor['descripcion'];
	?>
    <div class="jackbox-description" id="description_<?php echo $xCodigo; ?>">
    	<div class="titulo-grafica row-per">
        	<h3><?php echo $xNomPorta; ?></h3>
            <div class="clearfix"></div>
		</div>
        <div class="row-per" style="margin-bottom:0px;">
	        <p class="parrafo"><?php echo $xDescripcion; ?></p>
	        <div class="clearfix"></div>
		</div>
	</div>
	<?php
    	};
	    mysqli_free_result($resultadoPor);
	?>
    <div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Portafolio</h1>
				<ol class="breadcrumb">
					<li><a href="index.php">Inicio</a></li>
					<li class="active">Portafolio</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div id="filters" class="button-group">
					<button class="btn btn-primary button margin-bottom-20 is-checked" data-filter="*">Mostrar todos</button>
					<?php
						$consultarCategoria = "SELECT * FROM portafolio_categorias WHERE estado='Activo' ORDER BY orden";
						$resultadoCategoria = mysqli_query($enlaces,$consultarCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));
						while($filaCat = mysqli_fetch_array($resultadoCategoria)){
							$xCodigo		= $filaCat['cod_categoria'];
							$xCategoria		= $filaCat['categoria'];
					?>
					<?php if($xCodigo!="0"){?>
					<button class="btn btn-primary button margin-bottom-20" data-filter=".<?php 
					$Cadena_principal=$xCategoria;
					$valorinicial=array("[\s+]","[\']","[\"]");
					$valornuevo="_";
					$Cadena_nueva=preg_replace($valorinicial,$valornuevo,$Cadena_principal);
					echo $Cadena_nueva;
					?>"><?php echo $xCategoria; ?></button><?php }; ?>
					<?php
						}
						mysqli_free_result($resultadoCategoria);
					?>
				</div>
                <div class="clearfix" style="height:20px;"></div>
				<div class="grid">
					<?php
						$consultarPor = "SELECT cp.cod_categoria, cp.categoria, p.* FROM portafolio_categorias as cp, portafolio as p WHERE p.cod_categoria=cp.cod_categoria AND p.estado='Activo' ORDER BY orden";
						$resultadoPor = mysqli_query($enlaces,$consultarPor) or die('Consulta fallida: ' . mysqli_error($enlaces));
						while($filaPor = mysqli_fetch_array($resultadoPor)){
							$xCodigo		= $filaPor['cod_portafolio'];
							$xCategoria		= $filaPor['categoria'];
							$xNomPorta		= $filaPor['nom_portafolio'];
							$xType			= $filaPor['type'];
							$xImagen		= $filaPor['imagen'];
							$xVideo			= $filaPor['video'];
							$xOrden			= $filaPor['orden'];
					?>
					<div class="element-item <?php 
					$Cadena_principal=$xCategoria;
					$valorinicial=array("[\s+]","[\']","[\"]");
					$valornuevo="_";
					$Cadena_nueva=preg_replace($valorinicial,$valornuevo,$Cadena_principal); 
					echo $Cadena_nueva;
					?>">
						<div class="img-portfolio text-center">
							<a class="jackbox" data-group="grupo<?php echo $xCodigo; ?>" data-title="<?php echo $xNomPorta; ?>" href="<?php if($xType=="I"){?>cms/images/portafolio/<?php echo $xImagen; ?><?php }?><?php if($xType=="V"){?><?php echo $xVideo; ?><?php }?>" data-description="#description_<?php echo $xCodigo; ?>">
								<div class="jackbox-hover jackbox-hover-black <?php if($xType=="I"){?>jackbox-hover-magnify<?php } ?><?php if($xType=="V"){?>jackbox-hover-play<?php } ?>"></div>
								<img class="img-responsive img-hover" src="cms/images/portafolio/<?php echo $xImagen; ?>" alt="">
							</a>
							<h6><strong><?php echo $xNomPorta; ?></strong></h6>
						</div>
						<?php if($xType=="I"){?> 
							<ul class="jackbox-hidden-items">
								<?php 
									$galeria="SELECT * FROM portafolio_galerias WHERE cod_portafolio='$xCodigo'";
									$ejecutag=mysqli_query($enlaces,$galeria);
									while($filagp=mysqli_fetch_array($ejecutag)){
										$xCodigo	= $filagp['cod_portafolio'];
										$xImgG 		= $filagp['imagen'];
								?>
								<li class="jackbox" data-group="grupo<?php echo $xCodigo; ?>" data-title="<?php echo $xNomPorta; ?>" data-thumbnail="cms/images/portafolio/galeria/<?php echo $xImgG; ?>" data-href="cms/images/portafolio/galeria/<?php echo $xImgG; ?>"></li>
								<?php
									}
									mysqli_free_result($ejecutag);
								?>
							</ul>
						<?php } ?>
					</div>
					<?php
						}
						mysqli_free_result($resultadoPor);
					?>
				</div>
			</div>
		</div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
	<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <script>
		var $grid = $('.grid').isotope({
		  itemSelector: '.element-item',
		  layoutMode: 'fitRows',
		  getSortData: {
			name: '.name',
			symbol: '.symbol',
			number: '.number parseInt',
			category: '[data-category]',
			weight: function( itemElem ) {
			  var weight = $( itemElem ).find('.weight').text();
			  return parseFloat( weight.replace( /[\(\)]/g, '') );
			}
		  }
		});
		
		// filter functions
		var filterFns = {
		  // show if number is greater than 50
		  numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		  },
		  // show if name ends with -ium
		  ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
		  }
		};
		
		// bind filter button click
		$('#filters').on( 'click', 'button', function() {
		  var filterValue = $( this ).attr('data-filter');
		  // use filterFn if matches value
		  filterValue = filterFns[ filterValue ] || filterValue;
		  $grid.isotope({ filter: filterValue });
		});
		
		// bind sort button click
		$('#sorts').on( 'click', 'button', function() {
		  var sortByValue = $(this).attr('data-sort-by');
		  $grid.isotope({ sortBy: sortByValue });
		});
		
		// change is-checked class on buttons
		$('.button-group').each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		  });
		});
	</script>
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
