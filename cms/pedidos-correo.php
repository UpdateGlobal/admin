<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_contact  = $_REQUEST['cod_contact'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso==""){
  $consultaContact = "SELECT * FROM contacto WHERE cod_contact='$cod_contact'";
  $ejecutarContact = mysqli_query($enlaces,$consultaContact) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCot = mysqli_fetch_array($ejecutarContact);
  $xCodigo = $filaCot['cod_contact'];
  $xCartem = $filaCot['cart_mail'];
}

if($proceso == "Actualizar"){
  $cod_contact  = $_POST['cod_contact'];
  $cartem       = $_POST['cart_mail'];

  $ActualizarContact = "UPDATE contacto SET cod_contact='$cod_contact', cart_mail='$cartem' WHERE cod_contact='$cod_contact'";
  $resultadoActualizar = mysqli_query($enlaces,$ActualizarContact);
  header("Location:productos-pedidos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.cart_mail.value==""){
          alert("¡El correo para los pedidos es obligatorio!");
          document.fcms.cart_mail.focus();
          return;
        }
        if (document.fcms.cart_mail.value.indexOf('@') == -1){
          alert ("La \"dirección de email\" no es correcta");
          document.fcms.cart_mail.focus();
          return;
        }
        document.fcms.action = "pedidos-correo.php";
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
        <?php $page="pedidos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <form class="fcms" name="fcms" method="post" action="">
          <div class="card">
            <h4 class="card-title"><strong>Editar Correo Pedido</strong></h4>
            <div class="card-body">
              <div class="form-group row">
                <div class="col-lg-2 col-4">
                  <label cclass="col-form-label" for="cart_mail">Correo que recibe los pedidos:</label>
                </div>
                <div class="col-lg-8 col-4">
                  <input class="form-control" type="text" name="cart_mail" value="<?php echo $xCartem; ?>" />
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <a href="productos-pedidos.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();"><i class="fa fa-refresh"></i> Actualizar Correo de Pedidos</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_contact" value="<?php echo $xCodigo; ?>">
            </footer>
          </div>
        </form>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>