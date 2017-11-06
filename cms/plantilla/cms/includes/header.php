		<div id="top">
			<div class="main-logo">
				<a href="index.php" onclick="return false;"><img src="images/meta/<?php echo $xLogo; ?>"></a>
			</div>
			<div class="m-nav"><i class="fa fa-bars"></i></div>
			<div class="profile-nav">
				<ul>
					<li class="profile-user-info">
						<a href="#" onclick="return false;">
							<b>Bienvenido, </b><span><?php echo $xAlias; ?></span> <i class="fa fa-user"></i>
						</a>
					</li>
					<li>
						<a href="usuarios.php">
							<i class="fa fa-gear"></i> Usuarios
						</a>
					</li>
					<li>
						<a href="cerrar_sesion.php">
							<i class="fa fa-times-circle"></i> Logout
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="sidebar">
			<ul class="main-nav">
				<li class="<?php echo ($menu == "inicio" ? "active open" : ""); ?> collapsible">
					<a href="#" onclick="return false;"><i class="fa fa-home"></i> Inicio</a>
					<ul class="sub-menu">
						<li class="<?php echo ($page == "metatags" ? "activo" : ""); ?>"><a href="inicio.php"><i class="fa fa-align-justify"></i> Meta tags</a></li>
						<li class="<?php echo ($page == "banners" ? "activo" : ""); ?>"><a href="banners.php"><i class="fa fa-picture-o"></i> Banners</a></li>
						<li class="<?php echo ($page == "carrusel" ? "activo" : ""); ?>"><a href="carrusel.php"><i class="fa fa-tags"></i> Carrusel</a></li>
					</ul>
				</li>
				<li class="<?php echo ($menu == "nosotros" ? "active" : ""); ?>"><a href="nosotros.php"><i class="fa fa-info"></i> Nosotros</a></li>
				<li class="<?php echo ($menu == "servicios" ? "active open" : ""); ?> collapsible">
                	<a href="#"><i class="fa fa-bars"></i> Servicios</a>
                    <ul class="sub-menu">
                    	<li class="<?php echo ($page == "servicios" ? "activo" : ""); ?>"><a href="servicios.php"><i class="fa fa-tasks"></i> Servicios</a></li>
                    	<li class="<?php echo ($page == "serviciosfotos" ? "activo" : ""); ?>"><a href="servicios-fotos.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
                    </ul>
                </li>
				<li class="<?php echo ($menu == "noticias" ? "active" : ""); ?>"><a href="noticias.php"><i class="fa fa-newspaper-o"></i> Noticias</a></li>
                <li class="<?php echo ($menu == "portafolio" ? "active open" : ""); ?> collapsible">
					<a href="#" onclick="return false;"><i class="fa fa-folder"></i> Portafolio</a>
                    <ul class="sub-menu">
						<li class="<?php echo ($page == "portafoliocategorias" ? "activo" : ""); ?>"><a href="portafolio-categorias.php"><i class="fa fa-window-restore"></i> Categor&iacute;as</a></li>
						<li class="<?php echo ($page == "portafolio" ? "activo" : ""); ?>"><a href="portafolio.php"><i class="fa fa-folder-open"></i> Trabajos</a></li>
						<li class="<?php echo ($page == "portafoliogalerias" ? "activo" : ""); ?>"><a href="portafolio-galerias.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
					</ul>
                </li>
                <li class="<?php echo ($menu == "galeria" ? "active open" : ""); ?> collapsible">
					<a href="#" onclick="return false;"><i class="fa fa-object-group"></i> Galer&iacute;a</a>
                    <ul class="sub-menu">
						<li class="<?php echo ($page == "galerias" ? "activo" : ""); ?>"><a href="galerias.php"><i class="fa fa-calendar"></i> Album</a></li>
						<li class="<?php echo ($page == "galeriasalbums" ? "activo" : ""); ?>"><a href="galerias-albums.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
                        <li class="<?php echo ($page == "videos" ? "activo" : ""); ?>"><a href="videos.php"><i class="fa fa-video-camera"></i> V&iacute;deos</a></li>
					</ul>
                </li>
				<li class="<?php echo ($menu == "productos" ? "active open" : ""); ?> collapsible">
					<a href="#" onclick="return false;"><i class="fa fa-cube"></i> Productos</a>
                    <ul class="sub-menu">
						<li class="<?php echo ($page == "productoscategorias" ? "activo" : ""); ?>"><a href="productos-categorias.php"><i class="fa fa-window-maximize"></i> Categor&iacute;a</a></li>
						<li class="<?php echo ($page == "productossubcategorias" ? "activo" : ""); ?>"><a href="productos-subcategorias.php"><i class="fa fa-window-restore"></i> Sub-categor&iacute;a</a></li>
						<li class="<?php echo ($page == "productos" ? "activo" : ""); ?>"><a href="productos.php"><i class="fa fa-cube"></i> Productos</a></li>
						<li class="<?php echo ($page == "productosgaleria" ? "activo" : ""); ?>"><a href="productos-galeria.php"><i class="fa fa-picture-o"></i> Fotos</a></li>
						<li class="<?php echo ($page == "pedidos" ? "activo" : ""); ?>"><a href="pedidos.php"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
					</ul>
                </li>
				<li class="<?php echo ($menu == "clientes" ? "active" : ""); ?>"><a href="clientes.php"><i class="fa fa-users"></i> Clientes</a></li>
				<li class="<?php echo ($menu == "contacto" ? "active" : ""); ?>"><a href="contacto.php"><i class="fa fa-map-o"></i> Contacto</a></li>
				<li class="<?php echo ($menu == "sociales" ? "active" : ""); ?>"><a href="social.php"><i class="fa fa-share-alt"></i> Redes Sociales</a></li>
			</ul>
		</div> <!-- /sidebar -->