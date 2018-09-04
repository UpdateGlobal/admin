<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$num = "";
$xGeneral = "";
$codorden = $_REQUEST['codorden'];
$clientes = "SELECT * FROM pedidos as p, clientes as c WHERE p.cod_orden='$codorden' AND p.cod_cliente=c.cod_cliente";
$resultadoC = mysqli_query($enlaces, $clientes);
$filacli = mysqli_fetch_array($resultadoC);
$codigoorden    = $filacli['cod_orden'];
$nombres        = $filacli['nombres'];
$direccion      = $filacli['direccion'];
$telefono       = $filacli['telefono'];
$email          = $filacli['email'];
$bruto          = $filacli['bruto'];
$igv            = $filacli['igv'];
$total          = $filacli['total'];
$observaciones  = $filacli['observaciones'];
?>
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
          <div class="col-lg-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Editando Pedido</strong></h4>
              <form name="fcms" method="post" action="">
                <div class="card-body">
                  <p><strong>Nº de Orden de Compra : </strong><?php echo $codigoorden; ?></p>
                  <table class="table" width="100%" border="0">
                    <tr>
                      <th width="5%" scope="col">Nº</th>
                      <th width="45%" scope="col">Producto</th>
                      <th width="10%" scope="col">Cantidad</th>
                      <th width="20%" scope="col">Precio</th>
                      <th width="20%" scope="col">Total</th>
                    </tr>
                    <?php
                      $detalles = "SELECT * FROM pedidodetalle as d, productos as p WHERE d.cod_orden='$codorden' AND d.cod_producto=p.cod_producto";
                      $resultade = mysqli_query($enlaces,$detalles);
                      while($filaDetalle = mysqli_fetch_array($resultade)){
                        $xCodOrden    = $filaDetalle['cod_orden'];
                        $xNomPro      = $filaDetalle['nom_producto'];
                        $xCantidad    = $filaDetalle['cantidad'];
                        $xPrecio      = $filaDetalle['precio'];
                        $xTotal       = ($xCantidad*$xPrecio);
                        $xGeneral     = ($xGeneral+$xTotal);
                        $num++;
                    ?>
                    <tr>
                      <td><?php echo $num; ?></td>
                      <td><?php echo $xNomPro; ?></td>
                      <td><?php echo $xCantidad; ?></td>
                      <td>$. <?php echo number_format($xPrecio,2); ?></td>
                      <td>$. <?php echo number_format($xTotal,2); ?></td>
                    </tr>
                    <?php
                      }
                    ?>
                  </table>
                  <table class="table-custom-monto" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td width="5%" scope="col">&nbsp;</td>
                        <td width="45%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><strong>Monto Bruto : </strong></td>
                        <td width="20%" scope="col">$. <?php echo number_format($bruto,2); ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>+ IGV (10%) : </strong></td>
                        <td>$. <?php echo number_format($igv,2); ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>Neto a Pagar : </strong></td>
                        <td>$. <?php echo number_format($total,2); ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <hr>

                  <table class="table" width="100%" border="0">
                    <thead>
                      <tr>
                        <th colspan="2" width="100%" bgcolor="#26e6e8" scope="col"><strong style="color:#fff;">DATOS DEL CLIENTE</strong></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td width="30%"><strong>Nombres :</strong></td>
                        <td width="70%"><?php echo utf8_encode($nombres); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Direcci&oacute;n :</strong></td>
                        <td><?php echo utf8_encode($direccion); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Tel&eacute;fono :</strong></td>
                        <td><?php echo $telefono; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email :</strong></td>
                        <td><?php echo $email; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Observaciones :</strong></td>
                        <td><?php echo $observaciones; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <label><span><strong>Nota:</strong> Cancele el pedido para borrarlo, <u>una vez se haya realizado el pago</u>.</span></label>
                </div>
                <footer class="card-footer">
                  <a href="productos-pedidos.php" class="btn btn-secondary"><i class="fa fa-reply"></i> Volver a Pedidos</a>
                  <a href="<?php if($xVisitante=="0"){ ?>pedidos-delete.php?cod_orden=<?php echo $xCodOrden; ?><?php }else{ ?>javascript:visitante();<?php } ?>" class="btn btn-bold btn-danger"><i class="fa fa-trash"></i> Cancelar Pedido</a>
                </footer>
              </div>
            </form>  
            </div>
          </div>
        </div>
      </div>
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>