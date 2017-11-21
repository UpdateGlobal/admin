<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == "Registrar"){
  $cod_categoria    = $_POST['cod_categoria'];
  $subcategoria   = mysqli_real_escape_string($enlaces,utf8_decode($_POST['subcategoria']));
  $imagen       = $_POST['imagen'];
  $orden        = $_POST['orden'];
  $estado       = $_POST['estado'];

  $insertarSubCategoria = "INSERT INTO productos_sub_categorias(cod_categoria, subcategoria, imagen, orden, estado)VALUE('$cod_categoria', '$subcategoria', '$imagen', '$orden', '$estado')";
  $resultadoInsertar = mysqli_query($enlaces, $insertarSubCategoria);
  $mensaje = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> La categor&iacute;a se registr&oacute; con exitosamente. <a href='productos-subcategorias.php'>Ir a Sub-Categorias de Productos</a>
          </div>";
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
        document.fcms.action = "productos-subcategorias-nuevo.php";
        document.fcms.proceso.value="Registrar";
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
          <h4 class="card-title"><strong>Nueva SubCategor&iacute;a</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="categoria">Categor&iacute;as:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php
                      $consultaCat = "SELECT * FROM productos_categorias ORDER BY categoria ASC";
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
                  <label>Subcategor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="subcategoria" type="text" id="subcategoria" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-7">
                  <input class="form-control" name="imagen" type="text" id="imagen" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-3">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('ISC');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" onKeyPress="return soloNumeros(event)" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" checked>
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="productos-subcategorias.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Publicar SubCategor&iacute;a</button>
              <input type="hidden" name="proceso">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>