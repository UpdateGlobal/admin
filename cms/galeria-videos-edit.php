<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_video  = $_REQUEST['cod_video'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaVideos = "SELECT * FROM videos WHERE cod_video='$cod_video'";
  $ejecutarVideos = mysqli_query($enlaces,$consultaVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaVid    = mysqli_fetch_array($ejecutarVideos);
  $cod_video    = $filaVid['cod_video'];
  $titulo       = htmlspecialchars($filaVid['titulo']);
  $descripcion  = htmlspecialchars($filaVid['descripcion']);
  $imagen       = $filaVid['imagen'];
  $video        = $filaVid['video'];
  $orden        = $filaVid['orden'];
  $estado       = $filaVid['estado'];
}

if($proceso=="Actualizar"){ 
  $cod_video      = $_POST['cod_video'];
  $titulo         = mysqli_real_escape_string($enlaces, $_POST['titulo']);
  $descripcion    = mysqli_real_escape_string($enlaces, $_POST['descripcion']);
  $imagen         = $_POST['imagen'];
  $video          = $_POST['video'];
  $orden          = $_POST['orden'];
  $estado         = $_POST['estado'];
  $actualizarVideos = "UPDATE videos SET cod_video='$cod_video', titulo='$titulo', descripcion='$descripcion', imagen='$imagen', video='$video', orden='$orden', estado='$estado' WHERE cod_video='$cod_video'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarVideos) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location:galeria-videos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.titulo.value==""){
          alert("Debe escribir un título");
          document.fcms.titulo.focus();
          return;
        }
        if(document.fcms.imagen.value==""){
          alert("Debe subir una imagen para la miniatura del vídeo");
          document.fcms.imagen.focus();
          return;
        }
        if(document.fcms.video.value==""){
          alert("Debe escribir un enlace para el vídeo");
          document.fcms.video.focus();
          return;
        }

        document.fcms.action = "galeria-videos-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      }
      function Imagen(codigo){
        url = "agregar-foto.php?id=" + codigo;
        AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
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
    <?php $menu="galeria"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Galer&iacute;a</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="videos"; include("module/menu-galeria.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar V&iacute;deo</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="titulo">T&iacute;tulo</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="titulo" type="text" id="titulo" value="<?php echo $titulo; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descripcion">Descripci&oacute;n</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $descripcion; ?></p><?php } ?>
                  <textarea name="descripcion" data-provide="summernote" data-min-height="150" <?php if($xVisitante=="1"){ ?> style="display:none;" <?php }else{ ?> <?php } ?> ><?php echo $descripcion; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="imagen">Imagen</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text" value="<?php echo $imagen; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('IV');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="video">V&iacute;deos</label><br>
                  <small>(Enlace)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="video" type="text" id="video" value="<?php echo $video; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <?php if($video!=""){ ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Vista previa del v&iacute;deo:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <a class="jackbox btn btn-outline btn-secondary" data-group="video" href="<?php echo $video; ?>" style="padding-top:10px; padding-bottom:10px;">
                    <i class="fa fa-play-circle" aria-hidden="true"></i> Reproducir
                  </a>
                </div>
              </div>
              <?php }else{ ?>
              <?php } ?>

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
              <a href="galeria-videos.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Guardar Cambios</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_video" value="<?php echo $cod_video; ?>">
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