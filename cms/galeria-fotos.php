<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
        td:nth-of-type(1):before { content: "Album"; }
        td:nth-of-type(2):before { content: "Imagen"; }
        td:nth-of-type(3):before { content: "Orden"; }
        td:nth-of-type(4):before { content: ""; }
      }
    </style>
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
    <?php $menu="galeria"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Galería</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="galeria-fotos"; include("module/menu-galeria.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Albums con Fotos</strong></h4>
              <div class="card-body">
                <form name="fcms" method="post" action="">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="40%" scope="col">Album</th>
                        <th width="50%" scope="col">Imagen</th>
                        <th width="5%" scope="col">Orden</th>
                        <th width="5%" scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarGal = "SELECT * FROM galerias ORDER BY orden";
                        $resultadoGal = mysqli_query($enlaces,$consultarGal) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaGal = mysqli_fetch_array($resultadoGal)){
                          $xCodigo    = $filaGal['cod_galeria'];
                          $xNomGal    = utf8_encode($filaGal['titulo']);
                          $xImagen    = $filaGal['imagen'];
                          $xOrden     = $filaGal['orden'];
                          $xEstado    = $filaGal['estado'];
                          //Número de fotos
                          $consultaFoto = "SELECT * FROM galerias_fotos WHERE cod_galeria=$xCodigo";
                          $resultadoFoto = mysqli_query($enlaces,$consultaFoto);
                          $numfotos = mysqli_num_rows($resultadoFoto);
                      ?>
                      <?php if($xImagen!=""){ ?>
                      <tr>
                        <td><?php echo $xNomGal; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/galerias/<?php echo $xImagen; ?>" width="148" height="98" /></td>
                        <td><?php echo $xOrden; ?></td>
                        <td><a class="boton-nuevo<?php if($xVisitante=="1"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="0"){ ?>galeria-fotos-nuevo.php?cod_galeria=<?php echo $xCodigo; ?>&titulo=<?php echo $xNomGal; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-search"></i></a></td>
                      </tr>
                      <?php }else{ ?><?php } ?>
                      <?php
                        }
                        mysqli_free_result($resultadoGal);
                      ?>
                    </tbody>
                  </table>
                </form>
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