<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_social   = $_REQUEST['cod_social'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaSocial = "SELECT * FROM social WHERE cod_social='$cod_social'";
  $ejecutarSocial = mysqli_query($enlaces,$consultaSocial) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaSol = mysqli_fetch_array($ejecutarSocial);
  $cod_social = $filaSol['cod_social'];
  $type     = $filaSol['type'];
  $links    = $filaSol['links'];
  $orden    = $filaSol['orden'];
  $estado   = $filaSol['estado'];
}
if($proceso=="Actualizar"){
  $cod_social   = $_POST['cod_social'];
  $type         = $_POST['type'];
  $links        = $_POST['links'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
  $actualizarSocial = "UPDATE social SET cod_social='$cod_social', type='$type', links='$links', orden='$orden', estado='$estado' WHERE cod_social='$cod_social'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarSocial) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location:sociales.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.links.value==""){
          alert("Debe colocar el enlace de su cuenta");
          document.fcms.links.focus();
          return; 
        }
        document.fcms.action = "social-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
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
    <?php $menu="social"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Redes Sociales</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar red social</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="social">Bot&oacute;n de Red Social:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select name="type" id="type" class="form-control" id="social">
                    <option value="<?php echo $type; ?>"><?php echo $type; ?> (Actual)</option>
                    <option value="fa-facebook-square">Facebook</option>
                    <option value="fa-twitter-square">Twitter</option>
                    <option value="fa-google-plus-official">Google+</option>
                    <option value="fa-linkedin">Linkedin</option>
                    <option value="fa-behance">Behance</option>
                    <option value="fa-blogger">Blogger</option>
                    <option value="fa-youtube-play">Youtube</option>
                    <option value="fa-vimeo">Vimeo</option>
                    <option value="fa-wordpress">Wordpress</option>
                    <option value="fa-tumblr-square">Tumblr</option>
                    <option value="fa-pinterest">Pinterest</option>
                    <option value="fa-instagram">Instagram</option>
                    <option value="fa-flickr">Flickr</option>
                    <option value="fa-github">Github</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="links">Enlace:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="links" type="text" id="links" value="<?php echo $links; ?>" />
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
              <a href="sociales.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();"><i class="fa fa-refresh"></i> Guardar Cambios</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_social" value="<?php echo $cod_social; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>