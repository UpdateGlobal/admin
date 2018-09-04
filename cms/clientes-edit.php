<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_cliente    = $_REQUEST['cod_cliente'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
  $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCli = mysqli_fetch_array($ejecutarClientes);
  $cod_cliente        = $filaCli['cod_cliente'];
  $nombres            = $filaCli['nombres'];
  $direccion          = $filaCli['direccion'];
  $telefono           = $filaCli['telefono'];
  $email              = $filaCli['email'];
  $clave              = $filaCli['clave'];
  $empresa            = $filaCli['empresa'];
  $fecha_nacimiento   = $filaCli['fecha_nacimiento'];
  $sexo               = $filaCli['sexo'];
  $estado             = $filaCli['estado'];
}

if($proceso=="Actualizar"){ 
  $cod_cliente        = $_POST['cod_cliente'];
  $nombres            = mysqli_real_escape_string($enlaces, $_POST['nombres']);
  $direccion          = mysqli_real_escape_string($enlaces, $_POST['direccion']);
  $telefono           = $_POST['telefono'];
  $email              = $_POST['email'];
  $clave              = $_POST['clave'];
  $empresa            = mysqli_real_escape_string($enlaces, $_POST['empresa']);
  $fecha_nacimiento   = $_POST['fecha_nacimiento'];
  $sexo               = $_POST['sexo'];
  $estado             = $_POST['estado'];
  $actualizarClientes = "UPDATE clientes SET cod_cliente='$cod_cliente', nombres='$nombres', direccion='$direccion', telefono='$telefono', email='$email', clave='$clave', empresa='$empresa', fecha_nacimiento='$fecha_nacimiento', sexo='$sexo', estado='$estado' WHERE cod_cliente='$cod_cliente'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location:clientes.php");
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
        document.fcms.action = "clientes-edit.php";
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
          <h4 class="card-title"><strong>Editar Cliente</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="nombres">Nombres:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="nombres" type="text" id="nombres" value="<?php echo $nombres; ?>" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="direccion">Direcci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="direccion" type="text" id="direccion" value="<?php echo $direccion; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="telefono">Tel&eacute;fono:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="telefono" type="text" id="telefono" value="<?php echo $telefono; ?>" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="email" type="text" id="email" value="<?php echo $email; ?>" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="clave">Clave:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="clave" type="text" id="clave" value="<?php echo $clave; ?>" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="empresa">Empresa:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="empresa" type="text" id="empresa" value="<?php echo $empresa; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="fecha_nacimiento">Fecha de Nacimiento:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="fecha_nacimiento" type="date" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="sexo">Sexo:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="sexo" value="M" <?php if (!(strcmp($sexo,"M"))) {echo "checked";} ?> >
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> Masculino</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="sexo" value="F" <?php if (!(strcmp($sexo,"F"))) {echo "checked";} ?> >
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
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?>>
                </div>
              </div>

            </div>

            <footer class="card-footer">
              <a href="clientes.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Cliente</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>