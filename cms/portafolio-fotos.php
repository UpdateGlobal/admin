<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
        td:nth-of-type(1):before { content: "Trabajo"; }
        td:nth-of-type(2):before { content: "Categoria"; }
        td:nth-of-type(3):before { content: "Imagen"; }
        td:nth-of-type(4):before { content: "Orden"; }
        td:nth-of-type(5):before { content: ""; }
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
    <?php $menu="portafolio"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Portafolio</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="portafoliogalerias"; include("module/menu-portafolio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">

              <h4 class="card-title"><strong>Lista de Fotos Trabajo</strong></h4>
              <div class="card-body">
                <form name="fcms" method="post" action="">
                  <table class="table" data-provide="datatables">
                    <thead>
                      <tr>
                        <th width="20%" scope="col">Trabajo</th>
                        <th width="20%" scope="col">Categoria</th>
                        <th width="40%" scope="col">Imagen</th>
                        <th width="5%" scope="col">Orden</th>
                        <th width="5%" scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarPor = "SELECT cp.cod_categoria, cp.categoria, p.* FROM portafolio_categorias as cp, portafolio as p WHERE p.cod_categoria=cp.cod_categoria AND p.type='I' ORDER BY p.orden";
                        $resultadoPor = mysqli_query($enlaces,$consultarPor);
                        while($filaPor = mysqli_fetch_array($resultadoPor)){
                          $xCodigo      = $filaPor['cod_portafolio'];
                          $xCategoria   = $filaPor['categoria'];
                          $xPortafolio  = $filaPor['nom_portafolio'];
                          $xImagen      = $filaPor['imagen'];
                          $xOrden       = $filaPor['orden'];
                          //Número de fotos
                          $consultaFoto = "SELECT * FROM portafolio_galerias WHERE cod_portafolio=$xCodigo";
                          $resultadoFoto = mysqli_query($enlaces,$consultaFoto);
                          $numfotos = mysqli_num_rows($resultadoFoto);
                      ?>
                      <?php if($xImagen!=""){ ?>
                      <tr>
                        <td><?php echo $xPortafolio; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                        <td><?php echo $xCategoria; ?></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/portafolio/<?php echo $xImagen; ?>" /></td>
                        <td><?php echo $xOrden; ?></td>
                        <td><a class="boton-nuevo <?php if($xVisitante=="1"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="1"){ ?>javascript:visitante();<?php }else{ ?>portafolio-fotos-nuevo.php?cod_portafolio=<?php echo $xCodigo; ?>&nom_portafolio=<?php echo $xPortafolio; ?><?php } ?>"><i class="fa fa-search"></i></a></td>
                      </tr>
                      <?php }else{ ?><?php } ?>
                      <?php
                        }
                        mysqli_free_result($resultadoPor);
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