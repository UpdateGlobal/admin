<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Start Bootstrap</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php"><i class="fa fa-cog"></i> Inicio</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info"></i> Sobre empresa <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="nosotros.php">Nosotros</a></li>
						<li><a href="servicios.php">Servicios</a></li>
						<li><a href="noticias.php">Noticias</a></li>
						<li class="divider"></li>
						<li><a href="portafolio.php">Portafolio</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-picture-o"></i> Galer&iacute;as <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="galerias-imagenes.php">Galer&iacute;a de Im&aacute;genes</a></li>
						<li><a href="galerias-videos.php">Galer&iacute;a de Videos</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> Productos <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="productos.php">Cat&aacute;logo</a></li>
						<li><a href="novedades.php">Novedades</a></li>
						<li><a href="ofertas.php">Ofertas</a></li>
					</ul>
				</li>
				<li><a href="contacto.php"><i class="fa fa-map-marker"></i> Contacto</a></li>
				<li><a href="buscar.php"><i class="fa fa-search"></i> Buscar</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-power-off"></i> Ingreso <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php if($xAlias!=""){ ?>
						<li><a>Bienvenido:</a></li>
						<li><a href="perfil.php"><?php echo utf8_decode($xAlias); ?></a></li>
						<li class="divider"></li>
						<li><a href="carrito-compras.php">Carrito de Compras</a></li>
						<li><a href="pedidos-en-linea.php">Pedidos en línea</a></li>
						<li class="divider"></li>
						<li><a href="cerrar-ingreso.php">Cerrar Sesi&oacute;n</a></li>
						<?php }else{ ?>
						<li><a href="ingreso.php">Ingresar</a></li>
						<li><a href="registrar.php">Registro</a></li>
						<?php } ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>