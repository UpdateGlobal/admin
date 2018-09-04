<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script src="assets/js/visitante-alert.js"></script>
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
    <?php $menu="nosotros"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Nosotros</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Acerca de Nosotros</strong></h4>
              <div class="card-body">
                <div class="row">
                  <?php
                    $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='1'";
                    $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                    while($filaCon = mysqli_fetch_array($resultadoCon)){
                      $xCodigo      = $filaCon['cod_contenido'];
                      $xTitulo      = $filaCon['titulo_contenido'];
                      $xImagen      = $filaCon['img_contenido'];
                      $xContenido   = $filaCon['contenido'];
                      $xEstado      = $filaCon['estado'];
                  ?>
                  <div <?php if($xImagen!=""){?> class="col-8 col-lg-8" <?php }else{ ?> class="col-12 col-lg-12" <?php } ?> >
                    <h4><?php echo $xTitulo; ?></h4>
                    <p><?php 
                      $strCut = substr($xContenido,0,800);
                      $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                      echo strip_tags($xContenido);
                    ?></p>
                    <hr>
                    <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                  </div>
                  <?php if($xImagen!=""){?>
                  <div class="col-4 col-lg-4">
                    <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                  </div>
                   <?php } ?>
                </div>
                <?php
                  }
                  mysqli_free_result($resultadoCon);
                ?>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Nosotros</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Misi&oacute;n</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='2'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = $filaCon['titulo_contenido'];
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = $filaCon['contenido'];
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Misi&oacute;n</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Visi&oacute;n</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='3'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = $filaCon['titulo_contenido'];
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = $filaCon['contenido'];
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Visión</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Objetivos</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='4'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = $filaCon['titulo_contenido'];
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = $filaCon['contenido'];
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Objetivos</a>
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