<!-- Topbar -->
<header class="topbar">
  <div class="topbar-left">
    <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
    <a class="topbar-btn d-none d-md-block" href="#" data-provide="fullscreen tooltip" title="Fullscreen">
      <i class="material-icons fullscreen-default">fullscreen</i>
      <i class="material-icons fullscreen-active">fullscreen_exit</i>
    </a>
    <div class="dropdown d-none d-md-block">
      <span class="topbar-btn" data-toggle="dropdown">
        <i class="ti-layout-grid3-alt"></i>
      </span>
      <div class="dropdown-menu dropdown-grid">
        <a class="dropdown-item" href="metatags.php">
          <span class="icon fa fa-home"></span>
          <span class="title">Inicio</span>
        </a>
        <a class="dropdown-item" href="nosotros.php">
          <span class="icon fa fa-info"></span>
          <span class="title">Nosotros</span>
        </a>
        <a class="dropdown-item" href="servicios.php">
          <span class="icon fa fa-bars"></span>
          <span class="title">Servicios</span>
        </a>
        <a class="dropdown-item" href="noticias.php">
          <span class="icon fa fa-newspaper-o"></span>
          <span class="title">Noticias</span>
        </a>
        <a class="dropdown-item" href="portafolio.php">
          <span class="icon fa fa-folder-open"></span>
          <span class="title">Portafolio</span>
        </a>
        <a class="dropdown-item" href="productos.php">
          <span class="icon fa fa-cube"></span>
          <span class="title">Productos</span>
        </a>
        <a class="dropdown-item" href="clientes.php">
          <span class="icon fa fa-users"></span>
          <span class="title">Clientes</span>
        </a>
        <a class="dropdown-item" href="contacto.php">
          <span class="icon fa fa-map-o"></span>
          <span class="title">Contacto</span>
        </a>
        <a class="dropdown-item" href="sociales.php">
          <span class="icon fa fa-share-alt"></span>
          <span class="title">Redes Sociales</span>
        </a>
      </div>
    </div>
    <div class="topbar-divider d-none d-md-block"></div>
    </div>
    <div class="topbar-right">
    <ul class="topbar-btns">
      <li class="dropdown">
        <span class="topbar-btn" data-toggle="dropdown">
          <?php
            $consultaUsu  = "SELECT * FROM usuarios WHERE cod_usuario='$xCodigo'";
            $ejecutarUsu  = mysqli_query($enlaces,$consultaUsu) or die('Consulta fallida: ' . mysqli_error($enlaces));
            $filaUsu      = mysqli_fetch_array($ejecutarUsu);
              $Uimagen    = $filaUsu['imagen'];
          ?>
          <?php if($Uimagen==null){ ?>
          <img class="avatar" src="assets/img/avatar/default.jpg" />
          <?php }else{ ?>
          <img class="avatar" src="assets/img/avatar/<?php echo $Uimagen; ?>" />
          <?php } ?>
        </span>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item"><i class="ti-user"></i> <?php echo $xAlias; ?></a>
          <a class="dropdown-item" href="usuarios.php"><i class="ti-settings"></i> Usuarios</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="cerrar_sesion.php"><i class="ti-power-off"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</header>
<!-- END Topbar -->