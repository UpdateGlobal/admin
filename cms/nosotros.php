<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
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
            <strong>Banners</strong>
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
                <?php
                  $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='1'";
                  $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                  while($filaCon = mysqli_fetch_array($resultadoCon)){
                    $xCodigo      = $filaCon['cod_contenido'];
                    $xTitulo      = utf8_encode($filaCon['titulo_contenido']);
                    $xImagen      = $filaCon['img_contenido'];
                    $xContenido   = utf8_encode($filaCon['contenido']);
                    $xEstado      = $filaCon['estado'];
                ?>
                <div <?php if($xImagen!=""){?> class="col-8 col-lg-8" <?php }else{ ?> class="col-12 col-lg-12" <?php } ?>>
                <p><strong><?php echo $xTitulo; ?></strong></p>
                <p><?php 
                  $strCut = substr($xContenido,0,800);
                  $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                  echo strip_tags($xContenido);
                ?></p>
                <hr>
                <div class="clearfix">
                  <p><strong><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                </div>

                </div>
              <?php if($xImagen!=""){?>

                <img class="thumbnail img-admin" src="images/nosotros/<?php echo $xImagen; ?>" />
              <?php }else{ ?>
              
              <?php } ?>
              <?php
                }
                mysqli_free_result($resultadoCon);
              ?>
              <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary">
                <i class="fa fa-refresh"></i> Editar Descripci&oacute;n
              </a>


                
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