<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
        td:nth-of-type(1):before { content: "Imagen"; }
        td:nth-of-type(2):before { content: "Título"; }
        td:nth-of-type(3):before { content: "Orden"; }
        td:nth-of-type(4):before { content: "Estado"; }
        td:nth-of-type(5):before { content: ""; }
        td:nth-of-type(6):before { content: ""; }
        td:nth-of-type(7):before { content: ""; }
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
    <?php $menu="servicios"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Servicios</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="servicios-fotos"; include("module/menu-servicios.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">

              <h4 class="card-title"><strong>Lista de Fotos para Servicios</strong></h4>
              <div class="card-body">
                <form name="fcms" method="post" action="">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="45%" scope="col">T&iacute;tulo</th>
                        <th width="45%" scope="col">Imagen</th>
                        <th width="5%" scope="col">Orden</th>
                        <th width="5%" scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $consultarSer = "SELECT * FROM servicios ORDER BY orden";
                        $resultadoSer = mysqli_query($enlaces,$consultarSer) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaSer = mysqli_fetch_array($resultadoSer)){
                          $xCodigo    = $filaSer['cod_servicio'];
                          $xNomSer    = mysqli_real_escape_string($enlaces, $filaSer['titulo']);
                          $xImagen    = $filaSer['imagen'];
                          $xOrden     = $filaSer['orden'];
                          $xEstado    = $filaSer['estado'];
                          //Número de fotos
                          $consultaFoto = "SELECT * FROM servicios_fotos WHERE cod_servicio=$xCodigo";
                          $resultadoFoto = mysqli_query($enlaces,$consultaFoto);
                          $numfotos = mysqli_num_rows($resultadoFoto);
                      ?>
                      <?php if($xImagen!=""){ ?>
                      <tr>
                        <td><?php echo $xNomSer; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/servicios/<?php echo $xImagen; ?>" /></td>
                        <td><?php echo $xOrden; ?></td>
                        <td><a class="boton-nuevo <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="Si"){ ?>javascript:visitante();<?php }else{ ?>servicios-fotos-nuevo.php?cod_servicio=<?php echo $xCodigo; ?>&titulo=<?php echo $xNomSer; ?><?php } ?>"><i class="fa fa-search"></i></a></td>
                      </tr>
                      <?php }else{ ?><?php } ?>
                      <?php
                        }
                        mysqli_free_result($resultadoSer);
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