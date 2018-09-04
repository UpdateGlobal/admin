<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_categoria = "";
$cod_sub_categoria = "";
$cod_producto = $_REQUEST['cod_producto'];
if (isset($_REQUEST['proceso'])){
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
$cod_producto = $_REQUEST['cod_producto'];

if($proceso == ""){
  $consultaPro        = "SELECT * FROM productos WHERE cod_producto='$cod_producto'";
  $resultadoPro       = mysqli_query($enlaces, $consultaPro);
  $filaPro            = mysqli_fetch_array($resultadoPro);
  $cod_producto       = $filaPro['cod_producto'];
  $cod_categoria      = $filaPro['cod_categoria'];
  $cod_sub_categoria  = $filaPro['cod_sub_categoria'];
  $nom_producto       = htmlspecialchars($filaPro['nom_producto']);
  $descripcion        = htmlspecialchars($filaPro['descripcion']);
  $oferta             = $filaPro['oferta'];
  $precio_oferta      = substr(utf8_decode($filaPro['precio_oferta']),0,20);
  $precio_normal      = substr(utf8_decode($filaPro['precio_normal']),0,20);
  $novedad            = $filaPro['novedad'];
  $fecha_ing          = $filaPro['fecha_ing'];
  $imagen             = $filaPro['imagen'];
  $ficha_tecnica      = $filaPro['ficha_tecnica'];
  $banner_grande      = $filaPro['banner_grande'];
  $banner_chico       = $filaPro['banner_chico'];
  $video              = $filaPro['video'];
  $orden              = $filaPro['orden'];
  $estado             = $filaPro['estado'];
}
if($proceso == "Filtrar"){
  $cod_categoria      = $_POST['cod_categoria'];
  $cod_sub_categoria  = $_POST['cod_sub_categoria'];
  $nom_producto       = htmlspecialchars($_POST['nom_producto']);
  $descripcion        = htmlspecialchars($_POST['descripcion']);
  $oferta             = $_POST['oferta'];
  $precio_oferta      = substr(utf8_decode($_POST['precio_oferta']),0,20);
  $precio_normal      = substr(utf8_decode($_POST['precio_normal']),0,20);
  $novedad            = $_POST['novedad'];
  if(isset($_POST['fecha_ing'])){$fecha_ing = $_POST['fecha_ing'];}else{$fecha_ing = date("Y-m-d");}
  $imagen             = $_POST['imagen'];
  $ficha_tecnica      = $_POST['ficha_tecnica'];
  $banner_grande      = $_POST['banner_grande'];
  $banner_chico       = $_POST['banner_chico'];
  $video              = $_POST['video'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
}

if($proceso == "Actualizar"){
  $cod_categoria      = $_POST['cod_categoria'];
  $cod_sub_categoria  = $_POST['cod_sub_categoria'];
  $nom_producto       = mysqli_real_escape_string($enlaces,$_POST['nom_producto']);
  $descripcion        = mysqli_real_escape_string($enlaces,$_POST['descripcion']);
  $oferta             = $_POST['oferta'];
  $precio_oferta      = substr(utf8_decode($_POST['precio_oferta']),0,20);
  $precio_normal      = substr(utf8_decode($_POST['precio_normal']),0,20);
  $novedad            = $_POST['novedad'];
  if(isset($_POST['fecha_ing'])){$fecha_ing = $_POST['fecha_ing'];}else{$fecha_ing = date("Y-m-d");}
  $imagen             = $_POST['imagen'];
  $ficha_tecnica      = $_POST['ficha_tecnica'];
  $banner_grande      = $_POST['banner_grande'];
  $banner_chico       = $_POST['banner_chico'];
  $video              = $_POST['video'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
  
  //Validar si el registro existe
  $actualizarProductos = "UPDATE productos SET
    cod_producto='$cod_producto', 
    cod_categoria='$cod_categoria', 
    cod_sub_categoria='$cod_sub_categoria', 
    nom_producto='$nom_producto', 
    descripcion='$descripcion', 
    oferta='$oferta', 
    precio_oferta='$precio_oferta', 
    precio_normal='$precio_normal', 
    novedad='$novedad', 
    fecha_ing='$fecha_ing', 
    imagen='$imagen', 
    ficha_tecnica='$ficha_tecnica', 
    banner_grande='$banner_grande', 
    banner_chico='$banner_chico', 
    video='$video', 
    orden='$orden', 
    estado='$estado' 
    WHERE cod_producto='$cod_producto'";
  
  $resultadoActualizar = mysqli_query($enlaces, $actualizarProductos);
  header("Location:productos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.nom_producto.value==""){
          alert("Debe escribir un título");
          document.fcms.nom_producto.focus();
          return; 
        }
        if(document.fcms.imagen.value==""){
          alert("Debe subir una imagen");
          document.fcms.imagen.focus();
          return; 
        }
        document.fcms.action = "productos-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      }
      function Filtrar(){
        document.fcms.action = "productos-edit.php";
        document.fcms.proceso.value="Filtrar";
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
    <link href="assets/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
    <link href="assets/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
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
        <?php $page="productos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Productos Nuevo</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="cod_categoria">Categor&iacute;as:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" name="cod_categoria" id="cod_categoria" onChange="Filtrar();">
                    <?php 
                      if($cod_categoria == ""){
                        $consultaCat = "SELECT * FROM productos_categorias WHERE estado='1'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = utf8_encode($filaCat['categoria']);
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }else{
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = utf8_encode($filaCat['categoria']);
                          echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                        }
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = utf8_encode($filaCat['categoria']);
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }
                    ?>
                    <option value="0">Sin categoria</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="cod_sub_categoria">Sub-categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" name="cod_sub_categoria" id="cod_sub_categoria">
                    <?php 
                      if($cod_categoria==""){
                        echo '<option value="0">Sin sub-categoria</option>';
                      }else{
                        if(($cod_sub_categoria=="")or($cod_sub_categoria=="0")){
                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = utf8_encode($fsb['subcategoria']);
                            echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                          }
                        }else{
                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria' AND cod_sub_categoria='$cod_sub_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = utf8_encode($fsb['subcategoria']);
                            echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                          }

                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria' AND cod_sub_categoria!='$cod_sub_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = utf8_encode($fsb['subcategoria']);
                            echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                          }
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="nom_producto">Nombre de producto:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="nom_producto" name="nom_producto" type="text" value="<?php echo $nom_producto; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descripcion">Descripci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea class="form-control" name="descripcion" id="descripcion" data-provide="summernote" data-min-height="150"><?php echo $descripcion; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Fecha de Ingreso:</label>
                </div>
                <div class="col-4 col-lg-2">
                  <input class="form-control" id="fecha_ing" name="fecha_ing" type="date" value="<?php echo $fecha_ing; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="imagen">Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text" value="<?php echo $imagen; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('IP');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Oferta:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="oferta" value="0" <?php if($oferta=="0"){echo "checked";} ?>>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> No</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="oferta" value="1" <?php if($oferta=="1"){echo "checked";} ?>>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> S&iacute;</span>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Precio Oferta:</label>
                </div>
                <div class="col-4 col-lg-2">
                  <input class="form-control" name="precio_oferta" type="text" id="precio_oferta" value="<?php echo $precio_oferta; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Precio Normal:</label>
                </div>
                <div class="col-4 col-lg-2">
                  <input class="form-control" name="precio_normal" type="text" id="precio_normal" value="<?php echo $precio_normal; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label>Novedad:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="novedad" value="0" <?php if($novedad=="0"){echo "checked";} ?>>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> No</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="novedad" value="1" <?php if($novedad=="1"){echo "checked";} ?>>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> S&iacute;</span>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="ficha_tecnica">Ficha T&eacute;cnica:</label><br>
                  <small>(Formato .pdf)</small>
                </div>
                <div class="col-4 col-lg-8">
                    <input class="form-control" name="ficha_tecnica" type="text" id="ficha_tecnica" value="<?php echo $ficha_tecnica; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('FT');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Banner Grande:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" name="banner_grande" id="banner_grande" type="text" value="<?php echo $banner_grande; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('BG');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="banner_chico">Banner Chico:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" name="banner_chico" id="banner_chico" type="text" value="<?php echo $banner_chico; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('BC');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="video">V&iacute;deo:</label>
                </div>
                <div class="col-2 col-lg-10">
                  <input class="form-control" name="video" type="text" id="video" value="<?php echo $video; ?>" />
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
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?>>
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="productos.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i>
 Editar Productos</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_producto" value="<?php echo $cod_producto; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
      <script type="text/javascript" src="assets/jackbox/js/libs/jquery.address-1.5.min.js"></script>
      <script type="text/javascript" src="assets/jackbox/js/libs/Jacked.js"></script>
      <script type="text/javascript" src="assets/jackbox/js/jackbox-swipe.js"></script>
      <script type="text/javascript" src="assets/jackbox/js/jackbox.js"></script>
      <script type="text/javascript" src="assets/jackbox/js/libs/StackBlur.js"></script>
      <script type="text/javascript">
        jQuery(document).ready(function() {
  //        jQuery(".jackbox[data-group]").jackBox("init");
          jQuery(".jackbox[data-group]").jackBox("init", {
            deepLinking: false,
            showInfoByDefault: false,       // show item info automatically when content loads, true/false
            preloadGraphics: true,          // preload the jackbox graphics for a faster jackbox
            fullscreenScalesContent: false,  // choose to always scale content up in fullscreen mode, true/false
   
            autoPlayVideo: false,           // video autoplay default, this can also be set per video in the data-attributes, true/false
            flashVideoFirst: false,         // choose which technology has first priority for video, HTML5 or Flash, true/false
       
            useThumbs: false,                // choose to use thumbnails, true/false
            thumbsStartHidden: false,       // choose to initially hide the thumbnail strip, true/false
            useThumbTooltips: false
          });
        });
      </script>
    </main>
    <!-- END Main container -->
  </body>
</html>