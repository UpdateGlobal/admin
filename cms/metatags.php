<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    <?php include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Metatags</strong> 
            <small>Metatags son los nombres, descripción y palabras clave con las que apareceran su web para los buscadores y redes sociales</small>
          </h1>
        </div>
        <?php $menu="inicio"; $page = "metatags"; include("module/menu-inicio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Metatags</strong></h4>
              <div class="media-list">
                <?php
                  $consultarMet = 'SELECT * FROM metatags';
                  $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
                  while($filaMet = mysqli_fetch_array($resultadoMet)){
                    $xCodigo    = $filaMet['cod_meta'];
                    $xLogo      = $filaMet['logo'];
                    $xTitulo    = utf8_encode($filaMet['titulo']);
                    $xSlogan    = utf8_encode($filaMet['slogan']);
                    $xDes       = utf8_encode($filaMet['description']);
                    $xKey       = utf8_encode($filaMet['keywords']);
                    $xUrl       = $filaMet['url'];
                    $xFace1     = $filaMet['face1'];
                    $xFace2     = $filaMet['face2'];
                    $xIco       = $filaMet['ico'];
                ?>
                <ul class="list-group">
                  <li class="list-group-item">
                    <strong>Título de la web:</strong><br>
                    <?php echo $xTitulo; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Slogan:</strong><br>
                    <?php echo $xSlogan; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Logotipo de la web:</strong><br>
                    <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/<?php echo $xLogo; ?>" />
                  </li>
                  <li class="list-group-item">
                    <strong>Descripción:</strong><br>
                    <?php echo $xDes; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Palabras Clave:</strong><br>
                    <?php echo $xKey; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Url:</strong><br>
                    http://<?php echo $xUrl; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Imagenes para redes sociales:</strong><br>
                    <div id="listagaleria">
                      <ul>
                        <li><img class="d-block b-1 border-light hover-shadow-2 p-1" src="http://<?php echo $xUrl; ?>/cms/assets/img/<?php echo $xFace1; ?>" /></li>
                        <li><img class="d-block b-1 border-light hover-shadow-2 p-1" src="http://<?php echo $xUrl; ?>/cms/assets/img/<?php echo $xFace2; ?>" /></li>
                      </ul>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <strong>Favicon:</strong><br>
                    <img src="assets/img/<?php echo $xIco; ?>" />
                  </li>
                </ul>
                <?php
                  }
                  mysqli_free_result($resultadoMet);
                ?>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="metatags-edit.php?cod_meta=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Metatags</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>
