<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_usuario = $_REQUEST['cod_usuario'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
  $chk    = $_POST['chk'];
} else {
  $proceso  = "";
  $chk    = "";
}
if($proceso == ""){
  $consultaUsuario = "SELECT * FROM usuarios WHERE cod_usuario='$cod_usuario'";
  $ejecutarUsuario = mysqli_query($enlaces,$consultaUsuario) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaUsuario = mysqli_fetch_array($ejecutarUsuario);
  $cod_usuario  = $filaUsuario['cod_usuario'];
  $nombres      = mysqli_real_escape_string($enlaces, $filaUsuario['nombres']);
  $email        = mysqli_real_escape_string($enlaces, $filaUsuario['email']);
  $imagen       = $filaUsuario['imagen'];
  $usuario      = mysqli_real_escape_string($enlaces, $filaUsuario['usuario']);
  $visitante    = $filaUsuario['visitante'];
  $estado       = $filaUsuario['estado'];
}
if($proceso == "Actualizar"){
  $cod_usuario  = $_POST['cod_usuario'];
  $nombres      = mysqli_real_escape_string($enlaces, $_POST['nombres']);
  $email        = mysqli_real_escape_string($enlaces, $_POST['email']);
  $imagen       = $_POST['imagen'];
  $usuario      = mysqli_real_escape_string($enlaces, $_POST['usuario']);
  if($_POST['clave']==""){
    $claveemail   = "- No de cambió -";
  }else{
    $claveemail = $_POST['clave'];
    $clave = password_hash(mysqli_real_escape_string($enlaces, $_POST['clave']), PASSWORD_BCRYPT);
  }
  if($_POST['visitante']==""){$visitante = 0;}else{$visitante = $_POST['visitante'];}
  if($_POST['estado']==""){$estado = 0;}else{$estado = $_POST['estado'];}
  
  $consultarMet = 'SELECT * FROM metatags';
  $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
  while($filaMet = mysqli_fetch_array($resultadoMet)){
    $xUrl     = mysqli_real_escape_string($enlaces, $filaMet['url']);
  }
  if($chk=="s") { 
    /*---- Mensaje para el correo electronico ----*/
    $emailDestino = $email;
    if($visitante==1){
      $visitanteM = "[Si]";
    }else{
      $visitanteM = "[No]";
    }

    if($estado==1){
      $estadoM = "[Si]";
    }else{
      $estadoM = "[No]";
    }
    $encabezado = "Datos de Usuario Actualizado";
    $mensaje = "
      <h3>Informaci&oacute;n del Usuario para el administrador actualizada</h3>
      <table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
        <tr>
          <td width='25%'><strong>Website : </strong></th>
          <td width='75%'>".$xUrl."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Nombre : </strong></th>
          <td width='75%'>".$nombres."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Usuario : </strong></th>
          <td width='75%'>".$usuario."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Email : </strong></th>
          <td width='75%'>".$email."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Clave : </strong></th>
          <td width='75%'>".$clave."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Visitante : </strong></th>
          <td width='75%'>".$visitante."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Estado : </strong></th>
          <td width='75%'>".$estado."</th>
        </tr>
      </table>
      <p>Para ingresar al administrador haga <a href='".$xUrl."/cms'>click aqu&iacute;</a>";
      
    $destino = $email;
    $mailCabecera = 'MIME-Version: 1.0'."\r\n";
    $mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
    $mailCabecera.= "FROM: ".$email;
    $mailCabecera.= "<".$email.">\r\n";
    $mailCabecera.= "Reply-To: ".$email;
    $mensajeEmail = $mensaje;
    mail($emailDestino,$encabezado,$mensajeEmail,$mailCabecera);
  }
  $actualizarUsuarios = "UPDATE usuarios SET cod_usuario='$cod_usuario', nombres='$nombres', email='$email', imagen='$imagen', usuario='$usuario', clave='$clave', visitante='$visitante', estado='$estado' WHERE cod_usuario='$cod_usuario'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location: usuarios.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.nombres.value==""){
          alert("Debes ingresar su nombre");
          document.fcms.nombres.focus();
          return; 
        }
        if(document.fcms.email.value==""){
          alert("Debes ingresar un email");
          document.fcms.email.focus();
          return; 
        }
        if (document.fcms.email.value.indexOf('@') == -1){
          alert ("La \"dirección de email\" no es correcta");
          document.fcms.email.focus();
          return;
        }
        if(document.fcms.usuario.value==""){
          alert("Debes ingresar un nombre de usuario");
          document.fcms.usuario.focus();
          return; 
        }
        if(document.fcms.clave.value==""){
          alert("Debes ingresar una clave");
          document.fcms.clave.focus();
          return; 
        }
        document.fcms.action = "usuario-edit.php";
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
    <?php $menu=""; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Usuarios</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Nuevo Usuario</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="nombres">Nombre:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="nombres" name="nombres" type="text" value="<?php echo $nombres; ?>" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="col-form-label"><?php echo $email; ?></label>
                  <input id="email" name="email" type="hidden" value="<?php echo $email; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Imagen:</label><br>
                  <small>(180px x 180px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text" value="<?php echo $imagen; ?>" />
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('USU');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
                <div class="clearfix"></div>
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">&nbsp;</label>
                </div>
                <div class="col-4 col-lg-8">
                  <img class="d-block b-1 border-light hover-shadow-2 p-1 img-admin" src="<?php if($imagen==""){ ?>assets/img/avatar/default.jpg<?php }else{ ?>assets/img/avatar/<?php echo $imagen; ?><?php } ?>" />
                </div>
                <div class="col-4 col-lg-2">&nbsp;</div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="usuario">Usuario:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="col-form-label"><?php echo $usuario; ?></label>
                  <input id="usuario" name="usuario" type="hidden" value="<?php echo $usuario; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="clave">Clave:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="clave" name="clave" type="text" value="" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <?php if($xVisitante=="0"){ ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="visitante">&iquest;Visitante?:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="visitante" data-size="small" data-provide="switchery" value="1" <?php if($visitante=="1"){echo "checked";} ?> />
                </div>
              </div>
              <?php }else{ ?>
              <input type="hidden" name="visitante" value="<?php echo $visitante; ?>" />
              <?php } ?>
              <?php if($xVisitante=="0"){ ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?> />
                </div>
              </div>
              <?php }else{ ?>
              <input type="hidden" name="estado" value="<?php echo $estado; ?>" />
              <?php } ?>
              <div class="form-group row">
                <div class="col-12 col-lg-12">
                  <label class="custom-control custom-control-lg custom-checkbox" for="chkbx-m">
                    <input type="checkbox" class="custom-control-input" id="chkbx-m" name="chk" value="s" />
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Enviar cambios al correo electr&oacute;nico</span>
                  </label>
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <a href="usuarios.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Usuario</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>