<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
        td:nth-of-type(1):before { content: "Categoria"; }
        td:nth-of-type(2):before { content: "Sub-categoria"; }
        td:nth-of-type(3):before { content: "Producto"; }
        td:nth-of-type(4):before { content: "Imagen"; }
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
    <?php $menu="galeria"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Productos</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="productosfotos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Productos con Fotos</strong></h4>
              <div class="card-body">
                <form name="fcms" method="post" action="">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="20%" scope="col">Categor&iacute;a</th>
                        <th width="20%" scope="col">Sub Categor&iacute;a</th>
                        <th width="20%" scope="col">Producto</th>
                        <th width="35%" scope="col">Imagen
                          <input type="hidden" name="proceso">
                          <input type="hidden" name="eliminar" value="false">
                        </th>
                        <th width="5%" scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarPro = "SELECT cp.cod_categoria, cp.categoria, scp.cod_sub_categoria, scp.subcategoria, p.* FROM productos_categorias as cp, productos_sub_categorias as scp, productos as p WHERE p.cod_categoria=cp.cod_categoria AND p.cod_sub_categoria=scp.cod_sub_categoria ORDER BY orden ASC";
                        $resultadoPro = mysqli_query($enlaces, $consultarPro);
                        while($filaPro = mysqli_fetch_array($resultadoPro)){
                          $xCodigo      = $filaPro['cod_producto'];
                          $xCategoria   = utf8_encode($filaPro['categoria']);
                          $xSCategoria  = utf8_encode($filaPro['subcategoria']);
                          $xProducto    = $filaPro['nom_producto'];
                          $xImagen      = $filaPro['imagen'];
                          //Número de fotos
                          $consultaFoto = "SELECT * FROM productos_galeria WHERE cod_producto=$xCodigo";
                          $resultadoFoto = mysqli_query($enlaces,$consultaFoto);
                          $numfotos = mysqli_num_rows($resultadoFoto);
                      ?>
                      <?php if($xImagen!=""){ ?>
                      <tr>
                        <td><?php echo $xCategoria; ?></td>
                        <td><?php echo $xSCategoria; ?></td>
                        <td><?php echo $xProducto; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1 img-admin" src="assets/img/productos/<?php echo $xImagen; ?>" /></td>
                        <td><a class="boton-nuevo" href="<?php if($xVisitante=="0"){ ?>productos-fotos-nuevo.php?cod_producto=<?php echo $xCodigo; ?>&titulo=<?php echo $xProducto; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-search"></i></a></td>
                      </tr>
                      <?php }else{ ?><?php } ?>
                      <?php
                        }
                        mysqli_free_result($resultadoPro);
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