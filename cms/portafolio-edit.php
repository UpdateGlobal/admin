<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_categoria = "";
$cod_portafolio = $_REQUEST['cod_portafolio'];
if (isset($_REQUEST['proceso'])) {
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == ""){
  $consultaPor="SELECT * FROM portafolio WHERE cod_portafolio='$cod_portafolio'";
  $resultadoPor=mysqli_query($enlaces,$consultaPor);
  $filaPor = mysqli_fetch_array($resultadoPor);
  $cod_portafolio   = $filaPor['cod_portafolio'];
  $cod_categoria    = $filaPor['cod_categoria'];
  $nom_portafolio   = $filaPor['nom_portafolio'];
  $descripcion      = $filaPor['descripcion'];
  $type             = $filaPor['type'];
  $video            = $filaPor['video'];
  $imagen           = $filaPor['imagen'];
  $orden            = $filaPor['orden'];
  $estado           = $filaPor['estado'];
}
if($proceso == "Actualizar"){
  $cod_categoria    = $_POST['cod_categoria'];
  $nom_portafolio   = mysqli_real_escape_string($enlaces, $_POST['nom_portafolio']);
  $descripcion      = mysqli_real_escape_string($enlaces, $_POST['descripcion']);
  $type             = $_POST['type'];
  $video            = $_POST['video'];
  $imagen           = $_POST['imagen'];
  $orden            = $_POST['orden'];
  $estado           = $_POST['estado'];
  
  //Validar si el registro existe
  $actualizarPortafolio = "UPDATE portafolio SET
    cod_portafolio='$cod_portafolio', 
    cod_categoria='$cod_categoria', 
    nom_portafolio='$nom_portafolio', 
    descripcion='$descripcion', 
    type='$type', 
    video='$video', 
    imagen='$imagen', 
    orden='$orden', 
    estado='$estado' 
    WHERE cod_portafolio='$cod_portafolio'";
  
  $resultadoActualizar = mysqli_query($enlaces,$actualizarPortafolio);
  header("Location:portafolio.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
    function Filtrar(){
      document.fcms.action = "portafolio-edit.php";
      document.fcms.proceso.value="Filtrar";
      document.fcms.submit();
    }
    function Validar(){
      if(document.fcms.nom_portafolio.value==""){
        alert("Debe escribir un título");
        document.fcms.nom_portafolio.focus();
        return;
      }
      if(document.fcms.imagen.value==""){
        alert("Debe subir una imagen");
        document.fcms.imagen.focus();
        return;
      }
      
      document.fcms.action = "portafolio-edit.php";
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
        <?php $page="portafolio"; include("module/menu-portafolio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Trabajo</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="nom_portafolio">Título:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="nom_portafolio" type="text" id="nom_portafolio" value="<?php echo $nom_portafolio; ?>" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="categoria">Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php 
                      //Al cargar la pagina debe listar todas las categorias existentes
                      if($cod_categoria == ""){
                        $consultaCat = "SELECT * FROM portafolio_categorias WHERE estado='Activo'";
                        $resultaCat = mysqli_query($enlaces,$consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = utf8_encode($filaCat['categoria']);
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }else{
                        // Al recargar la pagina que seleccione el elemento escogido
                        $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces,$consultaCat);
                          while($filaCat = mysqli_fetch_array($resultaCat)){
                            $xcodCat = $filaCat['cod_categoria'];
                            $xnomCat = utf8_encode($filaCat['categoria']);
                            echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                          }
                        //Cargar todas las categorias menos la escogida
                        $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria!='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces,$consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = utf8_encode($filaCat['categoria']);
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descripcion">Descripci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea data-provide="summernote" id="descripcion" name="descripcion" data-min-height="150"><?php echo $descripcion; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="tipo">Tipo:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){?>
                    <p><?php if($type=="I"){ echo "Imagen";} if($type=="V"){echo "Video";}?></p>
                    <input name="type" type="hidden" value="<?php echo $type; ?>" />
                      <?php } ?>
                  <?php if($xVisitante=="0"){?>
                    <label class="custom-control custom-radio">
                      <input <?php if (!(strcmp($type,"I"))) {echo "checked=\"checked\"";} ?> type="radio" class="custom-control-input" name="type" value="I">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"> Imagen</span>
                    </label>
                    <label class="custom-control custom-radio">
                      <input <?php if (!(strcmp($type,"V"))) {echo "checked=\"checked\"";} ?> type="radio" class="custom-control-input" name="type" value="V">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"> Vídeo</span>
                    </label>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="video">Vídeo:</label><br>
                  <small>(Enlace)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $video; ?></p><?php } ?>
                  <input class="form-control" name="video" id="video" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $video; ?>" />
                </div>
              </div>

              <?php if($video!=""){ ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="video">Vista previa del v&iacute;deo:</label><br>
                  <small>(Enlace)</small>
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
                  <label class="col-form-label require" for="imagen">Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                  <input class="form-control" id="imagen" name="imagen" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $imagen; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('IPR');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" onKeyPress="return soloNumeros(event)" value="<?php echo $orden; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?> >
                </div>
              </div>

            </div>

            <footer class="card-footer">
              <a href="portafolio.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Registrar Trabajo</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_portafolio" value="<?php echo $cod_portafolio; ?>">
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