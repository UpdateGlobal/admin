<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == "Registrar"){
  $nombres    = mysqli_real_escape_string($enlaces, $_POST['nombres']);
  $email      = mysqli_real_escape_string($enlaces, $_POST['email']);
  $imagen     = $_POST['imagen'];
  $usuario    = mysqli_real_escape_string($enlaces, $_POST['usuario']);
  $claveemail = mysqli_real_escape_string($enlaces, $_POST['clave']);
  $clave      = password_hash(mysqli_real_escape_string($enlaces, $_POST['clave']), PASSWORD_BCRYPT);
  if(isset($_POST['visitante'])){$visitante = $_POST['visitante'];}else{$visitante = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
    
  $validarUsuarios = "SELECT * FROM usuarios WHERE email='$email' OR usuario='$usuario'";
  $ejecutarValidar = mysqli_query($enlaces,$validarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $numreg = mysqli_num_rows($ejecutarValidar);
  
  $consultarMet = 'SELECT * FROM metatags';
  $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
  while($filaMet = mysqli_fetch_array($resultadoMet)){
    $xUrl     = $filaMet['url'];
  }
  if($numreg==0){
  
    /*---- Mensaje para el correo electronico ----*/
    $emailDestino = $email;
    if($visitante==1){
      $visitanteM = "[Si]";
    }elseif($visitante==0){
      $visitanteM = "[No]";
    }

    if($estado==1){
      $estadoM = "[Si]";
    }elseif($estado==0){
      $estadoM = "[No]";
    }
    $encabezado = "Nuevo Usuario Registrado";
    $mensaje = "
      <h3>Informaci&oacute;n del Usuario para el administrador</h3>
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
          <td width='75%'>".$visitanteM."</th>
        </tr>
        <tr>
          <td width='25%'><strong>Estado : </strong></th>
          <td width='75%'>".$estadoM."</th>
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
    
    $insertarUsuarios = "INSERT INTO usuarios (nombres, email, imagen, usuario, clave, visitante, estado)VALUE('$nombres', '$email', '$imagen', '$usuario', '$clave', '$visitante', '$estado')";
    $resultadoInsertar = mysqli_query($enlaces,$insertarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
    $mensaje = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> Usuario se registr&oacute; con exitosamente. Un email con sus datos de usuario ha sido enviado al email registrado (de no verlo revise su carpeta de spam). <a href='usuarios.php'>Ir a Usuarios</a>
          </div>";
  }else{
    $mensaje = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> Ops, el usuario o el email ya existe...
          </div>";
  }
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

        document.fcms.action = "usuario-nuevo.php";
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
                  <input class="form-control" id="nombres" name="nombres" type="text" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="email" name="email" type="email" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Imagen:</label><br>
                  <small>(180px x 180px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text">
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('USU');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="usuario">Usuario:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="usuario" name="usuario" type="text" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="clave">Clave:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="clave" name="clave" type="text" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="visitante">&iquest;Visitante?:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="visitante" data-size="small" data-provide="switchery" value="1">
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
              <a href="usuarios.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Usuario</button>
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