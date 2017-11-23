<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_producto = $_REQUEST['cod_producto'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}

$consultaFotos = "SELECT * FROM productos_galeria WHERE cod_producto='$cod_producto'";
$resultadoFotos = mysqli_query($enlaces, $consultaFotos);

$consultaNombre   = "SELECT * FROM productos WHERE cod_producto='$cod_producto'";
$resultadoNombre  = mysqli_query($enlaces,$consultaNombre);

if($proceso == "Registrar"){
  $cod_producto   = $_POST['cod_producto'];
  $imagen         = $_POST['imagen'];
  $insertarGaleria = "INSERT INTO productos_galeria(cod_producto, imagen)VALUE('$cod_producto', '$imagen')";
  $resultadoInsertar = mysqli_query($enlaces, $insertarGaleria);
  header("Location: productos-fotos-nuevo.php?cod_producto=$cod_producto?nom_producto=$nom_producto");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.imagen.value==""){
          alert("Debe subir una imagen");
          document.fcms.imagen.focus();
          return; 
        }
      
        document.fcms.action = "productos-fotos-nuevo.php";
        document.fcms.proceso.value="Registrar";
        document.fcms.submit();
      }
      function Imagen(codigo){
        url = "agregar-foto.php?id=" + codigo;
        AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
      }
    </script>
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
            <strong>Fotos para Producto</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="productosfotos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Fotos Productos</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="producto">Producto:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php
                    while($filaNom = mysqli_fetch_array($resultadoNombre)){
                      $titulo = utf8_encode($filaNom['nom_producto']);
                  ?>
                  <strong><?php echo $titulo; ?></strong>
                  <?php
                    }
                  ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">A&ntilde;adir Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p></p><?php } ?>
                  <input class="form-control" id="imagen" name="imagen" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('IGP');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12 col-lg-12">
                  <a href="productos-fotos.php" class="btn btn-secondary"><i class="fa fa-reply"></i> Volver</a>
                  <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-plus-circle"></i> A&ntilde;adir Foto</button>
                  <input type="hidden" name="proceso">
                  <input type="hidden" name="cod_producto" value="<?php echo $cod_producto; ?>">
                  <input type="hidden" name="nom_producto" value="<?php echo $nom_producto; ?>">
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <p>Im&aacute;genes dentro de esta galer&iacute;a, <strong>haga clic en las im&aacute;genes para borrar/quitar.</strong></p>
              <div id="listagaleria">
                <ul>
                  <?php
                    while($filaFoto = mysqli_fetch_array($resultadoFotos)){
                      $xCodigoGal = $filaFoto['cod_galeria_producto'];
                      $xCodProducto = $filaFoto['cod_producto'];
                      $xFoto = $filaFoto['imagen'];
                  ?>
                  <li class="thumbnail">
                    <a href="productos-fotos-delete.php?cod_galeria_producto=<?php echo $xCodigoGal; ?>&cod_producto=<?php echo $xCodProducto; ?>&imagen=<?php echo $xFoto; ?>">
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/productos/galeria/<?php echo $xFoto; ?>" width="150" height="100" />
                    </a>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </footer>
          </form>
        </div>
      </div>
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>