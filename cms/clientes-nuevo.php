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
  $nombres      = mysqli_real_escape_string($enlaces, $_POST['nombres']);
  $direccion    = mysqli_real_escape_string($enlaces, $_POST['direccion']);
  $telefono     = $_POST['telefono'];
  $email        = mysqli_real_escape_string($enlaces, $_POST['email']);
  $clave        = $_POST['clave'];
  $empresa      = mysqli_real_escape_string($enlaces, $_POST['empresa']);
  $fecha        = $_POST['fecha_nacimiento'];
  $sexo         = $_POST['sexo'];
  $estado       = $_POST['estado'];
    
  $validarClientes = "SELECT * FROM clientes WHERE email='$email'";
  $ejecutarValidar = mysqli_query($enlaces,$validarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $numreg = mysqli_num_rows($ejecutarValidar);
  
  if($numreg==0){
    $insertarClientes = "INSERT INTO clientes(nombres, direccion, telefono, email, clave, empresa, fecha_nacimiento, sexo, estado)VALUE('$nombres', '$direccion', '$telefono', '$email', '$clave', '$empresa', '$fecha', '$sexo', '$estado')";
    $resultadoInsertar = mysqli_query($enlaces,$insertarClientes);
    $mensaje = "<div class='alert alert-success' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <strong>Nota:</strong> El clientes se registr&oacute; con exitosamente. <a href='clientes.php'>Ir a Clientes</a>
        </div>";
  }else{
    $mensaje = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> Ops, el Cliente ya existe...
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
        alert("Debe escribir un nombre");
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
      if(document.fcms.clave.value==""){
        alert("Ingrese una clave");
        document.fcms.clave.focus();
        return; 
      }
      document.fcms.action = "clientes-nuevo.php";
      document.fcms.proceso.value="Registrar";
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
    <?php $menu="inicio"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Clientes</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Registrar Cliente</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="nombres">Nombres:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="nombres" type="text" id="nombres" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="direccion">Direcci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="direccion" type="text" id="direccion" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="telefono">Tel&eacute;fono:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="telefono" type="text" id="telefono" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="email" type="text" id="email" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="clave">Clave:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="clave" type="text" id="clave" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="empresa">Empresa:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="empresa" type="text" id="empresa" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="fecha_nacimiento">Fecha de Nacimiento:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="fecha_nacimiento" type="date" id="fecha_nacimiento" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="sexo">Sexo:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="sexo" value="M" checked>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> Masculino</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="sexo" value="F">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> Femenino</span>
                  </label>
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
              <a href="clientes.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Cliente</button>
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