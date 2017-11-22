<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php $num=""; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
        td:nth-of-type(1):before { content: "Nº"; }
        td:nth-of-type(2):before { content: "Orden de Compra"; }
        td:nth-of-type(3):before { content: "Nombre del Cliente"; }
        td:nth-of-type(4):before { content: "Fecha pedido"; }
        td:nth-of-type(5):before { content: "Total"; }
        td:nth-of-type(6):before { content: ""; }
      }
    </style>
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
    <?php $menu="productos"; include("module/menu.php"); ?>
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
        <?php $page="pedidos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Pedidos</strong></h4>
              <div class="card-body">
                <?php
                  $consultarCot = 'SELECT * FROM contacto';
                  $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                  while($filaCot = mysqli_fetch_array($resultadoCot)){
                    $xCodigo    = $filaCot['cod_contact'];
                    $xCartem    = $filaCot['cart_mail'];
                ?>
                <p><strong>Correo que recibe los pedidos:</strong> <u><?php echo $xCartem; ?></u> &nbsp; <strong><a href="pedidos-correo.php?cod_contact=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square-o"></i> (Editar Correo)</a></strong></p>
                <?php
                  }
                  mysqli_free_result($resultadoCot);
                ?>
                <form name="fcms" method="post" action="">
                  <table class="table" width="100%" border="0">
                    <thead>
                      <tr>
                        <th width="5%" scope="col">Nº</th>
                        <th width="25%" scope="col">Orden</th>
                        <th width="25%" scope="col">Cliente</th>
                        <th width="20%" scope="col">Fecha</th>
                        <th width="20%" scope="col">Total</th>
                        <th width="5%" scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <?php
                      $pedidos = "SELECT * FROM pedidos as p, clientes as c WHERE p.cod_cliente=c.cod_cliente ORDER BY p.fechapedido DESC";
                      $resultadoPedidos = mysqli_query($enlaces, $pedidos);
                      while($filaPedidos = mysqli_fetch_array($resultadoPedidos)){
                        $xCodOrden      = $filaPedidos['cod_orden'];
                        $xNombres       = utf8_encode($filaPedidos['nombres']);
                        $xFechaPedido   = $filaPedidos['fechapedido'];
                        $xBruto         = $filaPedidos['bruto'];
                        $xTotal         = $filaPedidos['total'];
                        $num++;
                    ?>
                    <tr>
                      <td><?php echo $num; ?></td>
                      <td><?php echo $xCodOrden; ?></td>
                      <td><?php echo $xNombres; ?></td>
                      <td><?php echo $xFechaPedido; ?></td>
                      <td><?php echo number_format($xTotal,2); ?></td>
                      <td><a class="boton-nuevo" href="pedidos-editar.php?codorden=<?php echo $xCodOrden; ?>"><i class="fa fa-search"></i></a></td>
                    </tr>
                    <?php
                      }
                      mysqli_free_result($resultadoPedidos);
                    ?>
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