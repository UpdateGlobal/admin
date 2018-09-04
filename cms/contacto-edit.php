<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_contact  = $_REQUEST['cod_contact'];
if (isset($_REQUEST['proceso'])){
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso==""){
  $consultaContact = "SELECT * FROM contacto WHERE cod_contact='$cod_contact'";
  $ejecutarContact = mysqli_query($enlaces,$consultaContact) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCot = mysqli_fetch_array($ejecutarContact);
  $xCodigo    = $filaCot['cod_contact'];
  $xDirection = htmlspecialchars($filaCot['direction']);
  $xPhone     = htmlspecialchars($filaCot['phone']);
  $xMobile    = htmlspecialchars($filaCot['mobile']);
  $xEmail     = htmlspecialchars($filaCot['email']);
  $xMap       = htmlspecialchars($filaCot['map']);
  $xFormem    = $filaCot['form_mail'];
}

if($proceso == "Actualizar"){
  $cod_contact  = $_POST['cod_contact'];
  $direction    = mysqli_real_escape_string($enlaces, $_POST['direction']);
  $phone        = mysqli_real_escape_string($enlaces, $_POST['phone']);
  $mobile       = mysqli_real_escape_string($enlaces, $_POST['mobile']);
  $email        = mysqli_real_escape_string($enlaces, $_POST['email']);
  $map          = mysqli_real_escape_string($enlaces, $_POST['map']);
  $formem       = $_POST['form_mail'];

  $ActualizarContact = "UPDATE contacto SET cod_contact='$cod_contact', direction='$direction', phone='$phone', mobile='$mobile', email='$email', map='$map', form_mail='$formem' WHERE cod_contact='$cod_contact'";
  $resultadoActualizar = mysqli_query($enlaces,$ActualizarContact);
  header("Location:contacto.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.form_mail.value==""){
          alert("¡El correo para los mensajes del formulario es obligatorio!");
          document.fcms.form_mail.focus();
          return; 
        }
        if (document.fcms.form_mail.value.indexOf('@') == -1){
          alert ("La \"dirección de email\" no es correcta");
          document.fcms.form_mail.focus();
          return;
        }
        document.fcms.action = "contacto-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
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
    <?php $menu="contacto"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Contacto</strong>
            <small>Datos de contacto de su empresa</small>
          </h1>
        </div>
        <?php $page="contacto"; include("module/menu-contacto.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Contacto</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="direccion">Direcci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xDirection; ?></p><?php } ?>
                  <input class="form-control" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="direccion" name="direction" value="<?php echo $xDirection; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xEmail; ?></p><?php } ?>
                  <input class="form-control" id="email" name="email" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xEmail; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="phone">Tel&eacute;fono:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xPhone; ?></p><?php } ?>
                  <input class="form-control" id="phone" name="phone" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xPhone; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="mobile">Celular:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xMobile; ?></p><?php } ?>
                  <input class="form-control" id="mobile" name="mobile" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xMobile; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="map">Mapa de Contacto:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xMap; ?></p><?php } ?>
                  <input class="form-control" id="map" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="map" value="<?php echo $xMap; ?>" />
                  <div class="separador-10"></div>
                  <?php if($xMap!=""){ ?>
                  <iframe src="<?php echo $xMap; ?>" width="100%" frameborder="1" height="250"></iframe>
                  <?php }else{ ?>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="form_mail">Correo que recibe los mensajes del Formulario:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xFormem; ?></p><?php } ?>
                  <input class="form-control" id="form_mail" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="form_mail" value="<?php echo $xFormem; ?>" />
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <a href="contacto.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Contacto</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_contact" value="<?php echo $xCodigo; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>