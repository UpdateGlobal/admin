<!-- Sidebar -->
    <aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
      <header class="sidebar-header">
        <span class="logo">
          <a href="metatags.php">
            <img src="assets/img/logo_update.png" alt="logo">
          </a>
        </span>
        <span class="sidebar-toggle-fold"></span>
      </header>

      <nav class="sidebar-navigation">
        <ul class="menu">

          <li class="menu-category">Sitio web</li>

          <li class="menu-item <?php echo ($menu == "inicio" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "inicio" ? "open" : "")?>" href="#">
              <span class="icon fa fa fa-home"></span>
              <span class="title">Inicio</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "inicio" ? "style='display:block;'" : "")?> >
              <li class="menu-item">
                <a class="menu-link" href="metatags.php">
                  <span class="dot"></span>
                  <span class="title">Metatags</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="banners.php">
                  <span class="dot"></span>
                  <span class="title">Banners</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="carrusel.php">
                  <span class="dot"></span>
                  <span class="title">Carrusel</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item <?php echo ($menu == "nosotros" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "nosotros" ? "open" : "")?>" href="nosotros.php">
              <span class="icon fa fa-info"></span>
              <span class="title">Nosotros</span>
            </a>
          </li>

          <li class="menu-item <?php echo ($menu == "servicios" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "servicios" ? "open" : "")?>" href="#">
              <span class="icon fa fa-bars"></span>
              <span class="title">Servicios</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "servicios" ? "style='display:block;'" : "")?> >
              <li class="menu-item">
                <a class="menu-link" href="servicios.php">
                  <span class="dot"></span>
                  <span class="title">Servicios</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="servicios-fotos.php">
                  <span class="dot"></span>
                  <span class="title">Fotos</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="menu-item <?php echo ($menu == "noticias" ? "active" : "")?>">
            <a class="menu-link" href="noticias.php">
              <span class="icon fa fa-newspaper-o"></span>
              <span class="title">Noticias</span>
            </a>
          </li>

          <li class="menu-item <?php echo ($menu == "portafolio" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "portafolio" ? "open" : "") ?>"  href="#">
              <span class="icon fa fa-folder-open"></span>
              <span class="title">Portafolio</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "portafolio" ? "style='display:block;'" : "")?> >
              <li class="menu-item">
                <a class="menu-link" href="portafolio-categorias.php">
                  <span class="dot"></span>
                  <span class="title">Categor&iacute;as</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="portafolio.php">
                  <span class="dot"></span>
                  <span class="title">Trabajos</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="portafolio-fotos.php">
                  <span class="dot"></span>
                  <span class="title">Fotos Trabajos</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="menu-item <?php echo ($menu == "galeria" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "galeria" ? "open" : "") ?>" href="#" >
              <span class="icon fa fa-picture-o"></span>
              <span class="title">Galer&iacute;a</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "galeria" ? "style='display:block;'" : "")?>>
              <li class="menu-item">
                <a class="menu-link" href="galeria.php">
                  <span class="dot"></span>
                  <span class="title">Album</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="galeria-fotos.php">
                  <span class="dot"></span>
                  <span class="title">Fotos</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="galeria-videos.php">
                  <span class="dot"></span>
                  <span class="title">V&iacute;deos</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="menu-category">Tienda</li>

          <li class="menu-item <?php echo ($menu == "productos" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "productos" ? "open" : "") ?>" href="#">
              <span class="icon fa fa-cube"></span>
              <span class="title">Productos</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "productos" ? "style='display:block;'" : "")?>>
              <li class="menu-item">
                <a class="menu-link" href="productos-categorias.php">
                  <span class="dot"></span>
                  <span class="title">Categor&iacute;as</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="productos-subcategorias.php">
                  <span class="dot"></span>
                  <span class="title">Sub-categor&iacute;a</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="productos.php">
                  <span class="dot"></span>
                  <span class="title">Productos</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="productos-fotos.php">
                  <span class="dot"></span>
                  <span class="title">Fotos</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="productos-pedidos.php">
                  <span class="dot"></span>
                  <span class="title">Pedidos</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item <?php echo ($menu == "clientes" ? "active" : "")?>">
            <a class="menu-link" href="clientes.php">
              <span class="icon fa fa-users"></span>
              <span class="title">Clientes</span>
            </a>
          </li>

          <li class="menu-category">Contacto</li>

          <li class="menu-item <?php echo ($menu == "contacto" ? "active" : "")?>">
            <a class="menu-link <?php echo ($menu == "contacto" ? "open" : "") ?>" href="#">
              <span class="icon fa fa-map-o"></span>
              <span class="title">Contacto</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu" <?php echo ($menu == "contacto" ? "style='display:block;'" : "")?>>
              <li class="menu-item">
                <a class="menu-link" href="contacto.php">
                  <span class="dot"></span>
                  <span class="title">Contacto</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="mensajes.php">
                  <span class="dot"></span>
                  <span class="title">Mensajes</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item <?php echo ($menu == "social" ? "active" : "")?>">
            <a class="menu-link" href="sociales.php">
              <span class="icon fa fa-share-alt"></span>
              <span class="title">Redes Sociales</span>
            </a>
          </li>

        </ul>
      </nav>

    </aside>
    <!-- END Sidebar -->