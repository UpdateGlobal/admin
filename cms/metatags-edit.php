<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_meta = $_REQUEST['cod_meta'];
if (isset($_REQUEST['proceso'])){
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}

if($proceso==""){
  $consultaMet = "SELECT * FROM metatags WHERE cod_meta='$cod_meta'";
  $ejecutarMet = mysqli_query($enlaces,$consultaMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaMet = mysqli_fetch_array($ejecutarMet);
  $xCodigo  = $filaMet['cod_meta'];
  $xTitulo  = $filaMet['titulo'];
  $xSlogan  = $filaMet['slogan'];
  $xDes     = $filaMet['description'];
  $xKey     = $filaMet['keywords'];
  $xUrl     = $filaMet['url'];
  $xLogo    = $filaMet['logo'];
  $xFace1   = $filaMet['face1'];
  $xFace2   = $filaMet['face2'];
  $xIco     = $filaMet['ico'];
}

if($proceso == "Actualizar"){
  $cod_meta     = $_POST['cod_meta'];
  $titulo       = mysqli_real_escape_string($enlaces, $_POST['titulo']);
  $slogan       = mysqli_real_escape_string($enlaces, $_POST['slogan']);
  $description  = mysqli_real_escape_string($enlaces, $_POST['description']);
  $keywords     = mysqli_real_escape_string($enlaces, $_POST['keywords']);
  $url          = $_POST['url'];
  $logo         = $_POST['logo'];
  $face1        = $_POST['face1'];
  $face2        = $_POST['face2'];
  $ico          = $_POST['ico'];

  $ActualizarMeta = "UPDATE metatags SET cod_meta='$cod_meta', titulo='$titulo', slogan='$slogan', description='$description', keywords='$keywords', url='$url', logo='$logo', face1='$face1', face2='$face2', ico='$ico' WHERE cod_meta='$cod_meta'";
  $resultadoActualizar = mysqli_query($enlaces,$ActualizarMeta) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location:metatags.php");
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
          alert("Debes ingresar un título para la web");
          document.fcms.titulo.focus();
          return; 
        }
        if(document.fcms.logo.value==""){
          alert("Debes subir un logotipo");
          document.fcms.logo.focus();
          return; 
        }
        if(document.fcms.url.value==""){
          alert("¡La Url es obligatoria!");
          document.fcms.url.focus();
          return;
        }
        document.fcms.action="metatags-edit.php";
        document.fcms.proceso.value="Actualizar";
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
    <?php $menu="inicio"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Metatags</strong> 
            <small>Metatags son los nombres, descripci&oacute;n y palabras clave con las que apareceran su web para los buscadores y redes sociales</small>
          </h1>
        </div>
        <?php $page="metatags"; include("module/menu-inicio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Metatags</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="titulo">T&iacute;tulo de la web</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xTitulo; ?></p><?php } ?>
                  <input class="form-control" id="titulo" name="titulo" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo htmlspecialchars($xTitulo); ?>" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="slogan">Slogan</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xSlogan; ?></p><?php } ?>
                  <input class="form-control" id="slogan" name="slogan" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo htmlspecialchars($xSlogan); ?>">
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="logo">Logotipo:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xLogo; ?></p><?php } ?>
                  <input class="form-control" id="logo" name="logo" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xLogo; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('LOGO');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="description">Descripci&oacute;n</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xDes; ?></p><?php }else{ ?>
                  <textarea class="form-control" name="description" id="description"><?php echo $xDes; ?></textarea>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="key">Keywords</label><br>
                  <small>(Sep&aacute;relas con una coma)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xKey; ?></p><?php } ?>
                  <input class="form-control" id="keywords" name="keywords" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo htmlspecialchars($xKey); ?>">
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="url">Url</label><br>
                  <small>(ejem: www.susitio.com)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xUrl; ?></p><?php } ?>
                  <input class="form-control" id="url" name="url" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xUrl; ?>" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label for="social">Im&aacute;genes para redes sociales:</label><br>
                  <small>(470px x 246px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xFace1; ?></p><?php } ?>
                  <input name="face1" class="form-control" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xFace1; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('FIA');"><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
                <div class="clearfix"></div>
                <div class="col-4 col-lg-2">
                  &nbsp;
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xFace2; ?></p><?php } ?>
                  <input name="face2" class="form-control" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xFace2; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('FIB');"><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="ico">Favicon:</label>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xIco; ?></p><?php } ?>
                  <input class="form-control" id="ico" name="ico" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xIco; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('ICO');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <a href="metatags.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Guardar Cambios</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_meta" value="<?php echo $xCodigo; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>