<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];
if (isset($_REQUEST['proceso'])) {
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == ""){
  $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE cod_sub_categoria='$cod_sub_categoria'";
  $resultadoSubCat = mysqli_query($enlaces, $consultaSubCat);
  $filaSC = mysqli_fetch_array($resultadoSubCat);
  $cod_sub_categoria    = $filaSC['cod_sub_categoria'];
  $cod_categoria        = $filaSC['cod_categoria'];
  $subcategoria         = htmlspecialchars(utf8_encode($filaSC['subcategoria']));
  $imagen               = $filaSC['imagen'];
  $orden                = $filaSC['orden'];
  $estado               = $filaSC['estado'];
}
if($proceso == "Actualizar"){
  $cod_sub_categoria    = $_POST['cod_sub_categoria'];
  $cod_categoria        = $_POST['cod_categoria'];
  $subcategoria         = mysqli_real_escape_string($enlaces,utf8_decode($_POST['subcategoria']));
  $imagen               = $_POST['imagen'];
  $orden                = $_POST['orden'];
  $estado               = $_POST['estado'];
  
  $actualizarSubCategoria = "UPDATE productos_sub_categorias SET cod_sub_categoria='$cod_sub_categoria', cod_categoria='$cod_categoria', subcategoria='$subcategoria', imagen='$imagen', orden='$orden', estado='$estado' WHERE cod_sub_categoria='$cod_sub_categoria'";
  $resultadoActualizar = mysqli_query($enlaces, $actualizarSubCategoria);
  
  header("Location: productos-subcategorias.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.subcategoria.value==""){
          alert("Debe escribir un nombre para la Sub-Categoria");
          document.fcms.subcategoria.focus();
          return;
        }
        document.fcms.action = "productos-subcategorias-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      }
      function Imagen(codigo){
        url = "agregar-foto.php?id=" + codigo;
        AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
      }
      function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key==8))
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
            <strong>Productos</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="productossubcategorias"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar SubCategor&iacute;a</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="categoria">Categor&iacute;as:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php
                      $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                      $resultadoCat = mysqli_query($enlaces, $consultaCat);
                      while($filaCat = mysqli_fetch_array($resultadoCat)){
                        $xCodcate = $filaCat['cod_categoria'];
                        $xCategoria = utf8_encode($filaCat['categoria']);
                      ?>
                      <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?> (Actual)</option>
                      <?php } ?>
                      <?php
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
                        $resultadoCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultadoCat)){
                          $xCodcate = $filaCat['cod_categoria'];
                          $xCategoria = utf8_encode($filaCat['categoria']);
                      ?>
                      <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="subcetegoria">Subcategor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="subcategoria" type="text" id="subcategoria" value="<?php echo $subcategoria; ?>" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-7">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                  <input class="form-control" name="imagen" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" value="<?php echo $imagen; ?>" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-3">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('ISC');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" value="<?php echo $orden; ?>" onKeyPress="return soloNumeros(event)" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?> />
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="productos-subcategorias.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar SubCategor&iacute;a</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_sub_categoria" value="<?php echo $cod_sub_categoria; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>